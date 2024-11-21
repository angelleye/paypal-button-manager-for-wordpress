<?php
defined( 'ABSPATH' ) || exit;
/*
 * Class responsible for PayPal Order Emails
 */
class Angelleye_Paypal_Wp_Button_Manager_Processing_Order_Email extends Angelleye_Paypal_Wp_Button_Manager_Order_Email {

	/**
	 * The template path of this email setting.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $template_path    The template path of this email setting.
	 */
	public $template_path = ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_PATH . '/templates/emails/angelleye-paypal-wp-button-manager-processing-order.php';

	/**
	 * The base slug of this email setting.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $base_slug    The base slug of this email setting.
	 */
	public $base_slug = 'angelleye_email_processing_order';

	/**
	 * Instance of the class
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $instance    The instance of the class.
	 */
	private static $instance;

	/**
	 * Provides the instance of the class.
	 *
	 * @since      1.0.0
	 * @return    Angelleye_Paypal_Wp_Button_Manager_New_Order_Email    Instance of the class.
	 */
    public static function get_instance() {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 */
	public function __construct(){
		$this->title =  __('Processing Order','angelleye-paypal-wp-button-manager');
		$this->subtitle = __('This is an order notification sent to customers containing order details after payment.','angelleye-paypal-wp-button-manager');
		parent::__construct();
	}
}