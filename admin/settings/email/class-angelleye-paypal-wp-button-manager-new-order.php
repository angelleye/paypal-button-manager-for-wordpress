<?php
defined( 'ABSPATH' ) || exit;
/*
 * Class responsible for PayPal Order Emails
 */
class Angelleye_Paypal_Wp_Button_Manager_New_Order_Email extends Angelleye_Paypal_Wp_Button_Manager_Order_Email {

	/**
	 * The template path of this email setting.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $template_path    The template path of this email setting.
	 */
	public $template_path = ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_PATH . '/templates/emails/angelleye-paypal-wp-button-manager-new-order.php';

	/**
	 * The base slug of this email setting.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $base_slug    The base slug of this email setting.
	 */
	public $base_slug = 'angelleye_email_new_order';

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
		parent::__construct();
		$this->title =  __('New Order','angelleye-paypal-wp-button-manager');
		$this->subtitle = __('New order emails are sent to chosen recipient(s) when a new order is received.','angelleye-paypal-wp-button-manager');
		$this->sent_to_customer = false;
		$this->load_fields();
	}

	/**
	 * Loads the fields.
	 *
	 * @since    1.0.0
	 */
	public function load_fields(){
		$field = array(
			'type' => 'text',
			'name' => 'recipients',
			'label' => __('Recipient(s)','angelleye-paypal-wp-button-manager'),
			'tooltip' => __('Enter recipient (coma seperated) for this email.','angelleye-paypal-wp-button-manager'),
		);
		array_splice($this->fields, 1, 0, [$field]);
	}
}