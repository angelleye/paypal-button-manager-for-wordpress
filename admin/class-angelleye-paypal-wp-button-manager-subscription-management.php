<?php
defined( 'ABSPATH' ) || exit;
/*
 * Class responsible for paypal subscription management.
 */
class Angelleye_Paypal_Wp_Button_Manager_Subscription_Management {

	private $plugin_name;
	private $version;
	private $paypal_subscriptions;
	public static $paypal_button_subscription_slug = 'paypal_subscription';

	public function __construct( $plugin_name, $version ){
		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_action( 'admin_menu', array( $this, 'admin_menu') );
		add_filter( 'set-screen-option', array($this, 'save_listing_page_option' ), 10, 3 );
		add_action('admin_post_angelleye_paypal_wp_button_manager_admin_update_subscription', array( $this, 'update_subscription') );
		add_action('admin_post_angelleye_paypal_wp_button_manager_admin_delete_subscription', array( $this, 'renew_subscription') );
	}

	/**
     * Adds the menu page
     * 
     * @return void
     */
	public function admin_menu(){
		$subscriptions_page = add_submenu_page( 'edit.php?post_type=paypal_button', __('Subscriptions','angelleye-paypal-wp-button-manager'), __('Subscriptions','angelleye-paypal-wp-button-manager'), 'manage_options', self::$paypal_button_subscription_slug, array( $this, 'paypal_button_manager_admin_subscriptions') );
        add_action("load-$subscriptions_page", array( $this, 'subscriptions_screen_options') );
	}

	/**
	 * Shows the subscriptions list page
	 * 
	 * @return void
	 */
	public function paypal_button_manager_admin_subscriptions(){
		if( isset( $_GET['action'] ) ){
			if( $_GET['action'] == 'edit' ){
				$subscription_id = $_GET['subscription_id'];
				if( empty( $subscription_id ) ){
					wp_die( 'Invalid Subscription ID.');
				}
				$subscription = new Angelleye_Paypal_Wp_Button_Manager_Subscription( $subscription_id );
				$button_id = $subscription->get_button_id();
				if( empty( $button_id ) ){
					wp_die( 'Invalid Subscription ID.');
				}

				$button = new Angelleye_Paypal_Wp_Button_Manager_Button( $button_id );

				$statuses = Angelleye_Paypal_Wp_Button_Manager_Subscription::get_available_statuses();

				include_once( ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_PATH . '/admin/partials/angelleye-paypal-wp-button-manager-admin-subscription-edit.php');
			} else if ( $_GET['action'] == 'delete' ){
				$this->delete_subscription();
			}
		} else {
			if( isset( $_GET['subscription_updated'] ) && $_GET['subscription_updated'] == 'true' ){
				echo '<div class="notice notice-success"><p>' . __('Subscription updated successfully.', 'angelleye-paypal-wp-button-manager') . '</p></div>';
			} else if ( isset( $_GET['subscription_renewed'] ) && $_GET['subscription_renewed'] == 'true' ) {
				echo '<div class="notice notice-success"><p>' . __('Subscription renewed successfully.', 'angelleye-paypal-wp-button-manager') . '</p></div>';
			} else if ( isset( $_GET['subscription_deleted'] ) && $_GET['subscription_deleted'] == 'true' ) {
				echo '<div class="notice notice-success"><p>' . __('Subscription deleted successfully.', 'angelleye-paypal-wp-button-manager') . '</p></div>';
			}
			include_once( ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_PATH .'/admin/partials/angelleye-paypal-wp-button-manager-admin-subscription-list.php');
		}
	}

	/**
     * Creates the screen options for the subscriptions listings
     * 
     * @return void
     */
	public function subscriptions_screen_options(){
		$option = 'per_page';
        $args   = [
            'label'   => __('Subscriptions','angelleye-paypal-wp-button-manager'),
            'default' => 20,
            'option'  => 'paypal_subscriptions_per_page'
        ];

        add_screen_option( $option, $args );

        $this->paypal_subscriptions = new Angelleye_Paypal_Wp_Button_Manager_Subscription_Management_List_Table();
	}

	/**
     * Allows the users to set the pagination records per page
     *
     * @param string $status current status of the option
     * @param string $option option
     * @param mixed $value value of the option
     * 
     * @return mixed
     */
    public function save_listing_page_option( $status, $option, $value ) {
        if( $option == 'paypal_subscriptions_per_page' ){
            return $value;
        }
        return $status;
    }

    /**
     * Allows to update the subscription.
     * 
     * @return void
     */
    public function update_subscription(){

    	$subscription_id = sanitize_text_field( $_POST['subscription_id'] );

    	if( empty( $subscription_id ) ){
			wp_die( 'Invalid Subscription ID.');
		}

    	$subscription = new Angelleye_Paypal_Wp_Button_Manager_Subscription( $subscription_id );

    	$button_id = $subscription->get_button_id();
		if( empty( $button_id ) ){
			wp_die( 'Invalid Subscription ID.');
		}

    	if( isset( $_POST['next_payment_due_date'] ) && !empty( $_POST['next_payment_due_date'] ) ){
    		$subscription->set_next_payment_due_date( sanitize_text_field( $_POST['next_payment_due_date'] ) );
    	}

    	if( isset( $_POST['status'] ) && !empty( $_POST['status'] ) ){
    		$subscription->set_status( sanitize_text_field( $_POST['status'] ) );
    	}

    	$subscription->save();

    	wp_redirect( admin_url('edit.php?post_type=' . Angelleye_Paypal_Wp_Button_Manager_Post::$post_type . '&page=' . self::$paypal_button_subscription_slug . '&subscription_updated=true' ) );
    }

    /**
     * Allows to renew the subscription.
     * 
     * @return void
     */
    public function renew_subscription(){
    	$subscription_id = sanitize_text_field( $_POST['subscription_id'] );

    	if( empty( $subscription_id ) ){
			wp_die( 'Invalid Subscription ID.');
		}

    	$subscription = new Angelleye_Paypal_Wp_Button_Manager_Subscription( $subscription_id );

    	$button_id = $subscription->get_button_id();
		if( empty( $button_id ) ){
			wp_die( 'Invalid Subscription ID.');
		}

		$subscription_renewal = new Angelleye_Paypal_Wp_Button_Manager_Subscription_Renewal();
		$subscription_renewal->renew_subscription( $subscription_id );
		wp_redirect( admin_url('edit.php?post_type=' . Angelleye_Paypal_Wp_Button_Manager_Post::$post_type . '&page=' . self::$paypal_button_subscription_slug . '&subscription_renewed=true' ) );
    }

    /**
     * Allows to delete the subscription.
     * 
     * @return void
     */
    public function delete_subscription(){
    	$subscription_id = sanitize_text_field( $_GET['subscription_id'] );

    	if( empty( $subscription_id ) ){
			wp_die( 'Invalid Subscription ID.');
		}

    	$subscription = new Angelleye_Paypal_Wp_Button_Manager_Subscription( $subscription_id );

    	$button_id = $subscription->get_button_id();
		if( empty( $button_id ) ){
			wp_die( 'Invalid Subscription ID.');
		}

    	$subscription->delete();

    	wp_redirect( admin_url('edit.php?post_type=' . Angelleye_Paypal_Wp_Button_Manager_Post::$post_type . '&page=' . self::$paypal_button_subscription_slug . '&subscription_deleted=true' ) );
    }
}