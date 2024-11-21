<?php
defined( 'ABSPATH' ) || exit;
/*
 * Class responsible for create paypal button order.
 */
class Angelleye_Paypal_Wp_Button_Manager_Order{

    public $plugin_name;

	public function __construct(){
        $this->plugin_name = 'angelleye-paypal-wp-button-manager';
		add_action('rest_api_init', array( $this, 'register_order_create_route' ) );
        add_action( 'init', array( $this, 'register_custom_endpoints' ) );
        add_action( 'template_redirect', array( $this, 'custom_endpoint_templates' ) );
        add_action('wp_ajax_get_state', array( $this, 'get_state') );
        add_action('wp_ajax_nopriv_get_state', array( $this, 'get_state') );
	}
 	
    /**
     * Registers the API route to create order
     * 
     */
 	public function register_order_create_route(){
        register_rest_route( 'angelleye-paypal-button-manager', 'create-order', array(
            'methods' => 'POST',
            'callback' => array( $this, 'create_order' ),
            'permission_callback' => '__return_true'
        ));
    }

    /**
     * Adds the rewrite endpoints for capture order and thank you page
     * 
     */
    public function register_custom_endpoints(){
        add_rewrite_endpoint( 'angelleye-capture-order', EP_ROOT );
        add_rewrite_endpoint( 'angelleye-order-received', EP_ROOT );
    }

    /**
     * Provides the template or calls the applicable functions on template redirect
     * 
     */
    public function custom_endpoint_templates() {
        global $wp;
        if ( isset( $wp->query_vars['angelleye-capture-order'] ) ) {
            $payment = $this->capture_order();
            if( is_wp_error( $payment['payment'] ) ){
                wp_redirect( get_site_url() . '/angelleye-order-received?success=false&message=' . $payment['payment']->get_error_message() );
            } else {
                $this->send_emails( $payment['button_id'], $payment['payment'] );
                wp_redirect( get_site_url() . '/angelleye-order-received?success=true&order_id=' . $payment['payment']->body->id . '&button_id=' . $payment['button_id'] . '&subscription=' . $payment['subscription'] . '&vaulted=' . $payment['vaulted'] );
            }
            exit;
        }
        if( isset( $wp->query_vars['angelleye-order-received'] ) ){
            wp_enqueue_style( $this->plugin_name . '-thankyou' );
            $success = ( isset( $_GET['success'] ) && $_GET['success'] == 'true' ) ? true : false;
            if( !$success ){
                $message = $_GET['message'];
            } else {
                $order_id = sanitize_text_field( $_GET['order_id'] );
                $button_id = sanitize_text_field( $_GET['button_id'] );
                $subscription =  ( isset( $_GET['subscription'] ) && $_GET['subscription'] == 'true' ) ? true : false;
                $vaulted =  ( isset( $_GET['vaulted'] ) && $_GET['vaulted'] == 'true' ) ? true : false;

                $button = new Angelleye_Paypal_Wp_Button_Manager_Button( $button_id );
            }
            include( ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_PATH . '/public/partials/angelleye-paypal-wp-button-manager-public-thankyou.php' );
            exit;
        }
    }

    /**
     * Creates the order
     * 
     * @param WP_REST_Request   request     request object
     * 
     * @return mixed
     */
    public function create_order(WP_REST_Request $request){
    	$params = $request->get_body();
        $params = json_decode( $params );

        if( !isset( $params->button_id ) || empty( $params->button_id ) ){
            return rest_ensure_response( array('status' => 'Failed', 'message' => __('Button ID is required field','angelleye-paypal-wp-button-manager') ) );
        }
        $button_id = $params->button_id;

        $button = new Angelleye_Paypal_Wp_Button_Manager_Button( $button_id );
        if( !$button->is_valid_button() ){
            return rest_ensure_response( array('status' => 'Failed', 'message' => __('Invalid button ID','angelleye-paypal-wp-button-manager') ) );
        }

        $amount = $button->get_total();
        if( $amount <= 0 ){
            return rest_ensure_response( array('status' => 'Failed', 'message' => __('Item cost should be more than zero','angelleye-paypal-wp-button-manager') ) );
        }

        $testmode = $button->is_company_test_mode();
        $api = new Angelleye_Paypal_Wp_Button_Manager_Paypal_API( $button->get_company_merchant_id(), $testmode );
        $api->set_method('POST');

        $paypal_body = array(
            'purchase_units' => array(
                array(
                    'items' => array(
                        array(
                            'name' => $button->get_item_name(),
                            'sku' => $button->get_item_id(),
                            'quantity' => 1,
                            'unit_amount' => array(
                                'currency_code' => $button->get_currency(),
                                'value' => round( $button->get_price(), 2)
                            ),
                        )
                    ),
                    'amount' => array(
                        'currency_code' => $button->get_currency(),
                        'value' => round( $amount, 2),
                        'breakdown' => array(
                            'item_total' => array(
                                'currency_code' => $button->get_currency(),
                                'value' => round( $button->get_price(), 2)
                            )
                        )
                    ),
                    'payee' => array(
                        'merchant_id' => $button->get_company_merchant_id()
                    ),
                )
            ),
            'intent' => 'CAPTURE',
        );

        if( $button->get_button_type() == 'subscription' ){
            $paypal_body['payment_source'] = array(
                'paypal' => array(
                   'attributes' => array(
                        'vault' => array(
                            'store_in_vault' => 'ON_SUCCESS',
                            'usage_type' => 'MERCHANT',
                            'customer_type' => 'CONSUMER'
                        )
                    ),
                   'experience_context' => array(
                        'shipping_preference' => 'GET_FROM_FILE',
                        'return_url' => get_site_url(),
                        'cancel_url' => get_site_url()
                   )
                )
            );
        }

        if( !empty( $button->get_shipping_amount() ) ){
            $paypal_body['purchase_units'][0]['amount']['breakdown']['shipping'] = array(
                'currency_code' => $button->get_currency(),
                'value' => round( $button->get_shipping_amount(), 2),
            );
        }

        if( !empty( $button->get_tax_total() ) ){
            $paypal_body['purchase_units'][0]['items'][0]['tax'] = array(
                'currency_code' => $button->get_currency(),
                'value' => round( $button->get_tax_total(), 2)
            );
            $paypal_body['purchase_units'][0]['amount']['breakdown']['tax_total'] = array(
                'currency_code' => $button->get_currency(),
                'value' => round( $button->get_tax_total(), 2)
            );
        }

        if (!empty($params->shipping_address)) {
            $paypal_body['purchase_units'][0]['shipping'] = array(
                'name' => array(
                    'full_name' => $params->payer->first_name . ' ' . $params->payer->last_name
                ),
                'address' => array(
                    'address_line_1' => $params->shipping_address->line1 ?? '',
                    'address_line_2' => $params->shipping_address->line2 ?? '',
                    'admin_area_1' => $params->shipping_address->state ?? '',
                    'admin_area_2' => $params->shipping_address->city ?? '',
                    'postal_code' => $params->shipping_address->postal_code ?? '',
                    'country_code' => $params->shipping_address->country ?? ''
                )
            );
        } else {
            if (!empty($params->billing_address)) {
                $paypal_body['purchase_units'][0]['shipping'] = array(
                    'name' => array(
                        'full_name' => $params->payer->first_name . ' ' . $params->payer->last_name
                    ),
                    'address' => array(
                        'address_line_1' => $params->billing_address->addressLine1 ?? '',
                        'address_line_2' => $params->billing_address->addressLine2 ?? '',
                        'admin_area_1' => $params->billing_address->adminArea1 ?? '',
                        'admin_area_2' => $params->billing_address->adminArea2 ?? '',
                        'postal_code' => $params->billing_address->postalCode ?? '',
                        'country_code' => $params->billing_address->countryCode ?? ''
                    )
                );
            }
        }

        if( !empty($params->payer) ){
            $paypal_body['payer'] = array(
                'name' => array(
                    'given_name' => $params->payer->first_name ?? '',
                    'surname' => $params->payer->last_name ?? ''
                ),
                'email_address' => $params->payer->email ?? '',
                'phone' => array(
                    'phone_type' => 'MOBILE',
                    'phone_number' => array(
                        'national_number' => $params->payer->phone ?? ''
                    )
                ),
            );
        }

        if (!empty($params->billing_address)) {
            $paypal_body['payer']['address'] = array(
                'address_line_1' => $params->billing_address->addressLine1 ?? '',
                'address_line_2' => $params->billing_address->addressLine2 ?? '',
                'admin_area_1' => $params->billing_address->adminArea1 ?? '',
                'admin_area_2' => $params->billing_address->adminArea2 ?? '',
                'postal_code' => $params->billing_address->postalCode ?? '',
                'country_code' => $params->billing_address->countryCode ?? ''
            );
        }

        $api->set_body( $paypal_body );
        $api->set_action('create_order');
        $payment = $api->submit();
        if( is_wp_error( $payment ) ){
            return $payment;
        }

        wp_send_json(array('orderID' => $payment->body->id), 200);
    }

    /**
     * Allows to capture order
     * 
     * @return array
     */
    public function capture_order(){
        $paypal_order_id = sanitize_text_field( $_GET['paypal_order_id'] );
        $button_id = sanitize_text_field( $_GET['button_id'] );

        $button = new Angelleye_Paypal_Wp_Button_Manager_Button( $button_id );
        if( !$button->is_valid_button() ){
            return rest_ensure_response( array('status' => 'Failed', 'message' => __('Invalid button ID','angelleye-paypal-wp-button-manager') ) );
        }

        $testmode = $button->is_company_test_mode();
        $api = new Angelleye_Paypal_Wp_Button_Manager_Paypal_API( $button->get_company_merchant_id(), $testmode );
        $api->set_method('POST');
        $api->set_action('capture_order');
        $api->set_paypal_url( $paypal_order_id . '/capture', true );
        $payment = $api->submit();

        if( $button->get_button_type() == 'subscription' && isset( $payment->body->payment_source->paypal->attributes->vault->id ) ){
            $subscription = new Angelleye_Paypal_Wp_Button_Manager_Subscription();
            $subscription->set_button_id( $button_id );
            $subscription->set_user_id( get_current_user_id() );
            $subscription->set_email_address( $payment->body->payment_source->paypal->email_address );
            if( isset( $payment->body->payment_source->paypal->name->given_name ) && !empty( $payment->body->payment_source->paypal->name->given_name ) ){
                $subscription->set_first_name( $payment->body->payment_source->paypal->name->given_name );
            }

            if( isset( $payment->body->payment_source->paypal->name->surname ) && !empty( $payment->body->payment_source->paypal->name->surname ) ){
                $subscription->set_last_name( $payment->body->payment_source->paypal->name->surname );
            }

            $subscription->set_payment_source( 'paypal' ); // can be changed in future.
            $subscription->set_vault_id( $payment->body->payment_source->paypal->attributes->vault->id );
            $subscription->set_status( 'active' );
            $subscription_id = $subscription->save();
            if( is_wp_error( $subscription_id ) ){
                return array( 'payment' => $subscription_id, 'button_id' => $button_id );
            }
        }
        return array( 'payment' => $payment, 'button_id' => $button_id, 'subscription' => $button->get_button_type() == 'subscription' ? 'true' : 'false', 'vaulted' => isset( $payment->body->payment_source->paypal->attributes->vault->id ) ? 'true' : 'false' );
    }

    /**
     * Allows to get the states
     * 
     * @return void
     */
    public function get_state(){
        echo json_encode( angelleye_payapl_wp_button_manager_get_states( esc_sql( $_REQUEST['country'] ) ) );
        die();
    }

    /**
     * Sends the emails
     * 
     * @param button_id     int     Button ID of the order
     * @param order         object  Payment object
     * 
     * @return void
     * */
    public function send_emails( $button_id, $order ){
        $text_color = get_option('angelleye_paypal_wp_button_manager_admin_email_body_text_color','#000');
        $background_color = get_option('angelleye_paypal_wp_button_manager_admin_email_body_background_color','#2271b1');

        $order_number = $order->body->id;
        $order_date = date('F j, Y', strtotime( $order->body->create_time ) );
        $site_url = get_site_url();

        if (isset($order->body->payer) && isset($order->body->payer->name)) {
            $customer_name = trim(($order->body->payer->name->given_name ?? '') . ' ' . ($order->body->payer->name->surname ?? ''));
        } else {
            $customer_name = '';
        }

        $button = new Angelleye_Paypal_Wp_Button_Manager_Button( $button_id );
        $tax = !empty( $button->get_tax_rate() ) ? $button->get_tax_total() : 0;

        $from_name = get_option( 'angelleye_paypal_wp_button_manager_admin_email_from_name', __('AngellEye PayPal Button Manager', 'angelleye-paypal-wp-button-manager') );
        $admin_email = get_option( 'admin_email');
        $from_address = get_option('angelleye_paypal_wp_button_manager_admin_email_from_email', $admin_email );
        if( empty( $from_address ) ){
            $from_address = $admin_email;
        }

        $headers = array('Content-Type: text/html; charset=UTF-8', "From: $from_name <$from_address>");

        foreach( Angelleye_Paypal_Wp_Button_Manager_Settings::get_emails() as $email ){
            if( get_option( $email->base_slug . '_enable' ) == 'yes' ){
                if( $email->sent_to_customer ){
                    if (!property_exists($order->body, 'payer') || empty($order->body->payer->email_address)) {
                        continue;
                    } else {
                        $send_mail_to = $order->body->payer->email_address;
                    }
                } else {
                    $send_mail_to = get_option( $email->base_slug . '_recipients' );
                }

                
                $subject = get_option( $email->base_slug . '_subject' );
                if( empty( $subject ) ){
                    $subject = __('New Order: #{order_number}', 'angelleye-paypal-wp-button-manager');
                }
                $subject = str_replace( array('{order_date}', '{order_number}', '{site_url}'), array( $order_date, $order_number, $site_url), $subject );

                ob_start();
                if( $email->overridden_template ){
                    include $email->overridden_template_path;
                } else {
                    include $email->template_path;
                }
                $html = ob_get_clean();

                wp_mail( $send_mail_to, $subject, $html, $headers );
            }
        }
    }
}