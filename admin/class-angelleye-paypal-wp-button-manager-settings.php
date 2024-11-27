<?php
defined( 'ABSPATH' ) || exit;
/*
 * Class responsible for PayPal settings
 */
class Angelleye_Paypal_Wp_Button_Manager_Settings {

	/**
	 * The slug of this setting.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $slug    The slug of this setting.
	 */
	public static $slug = 'angelleye-paypal-settings';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 */
	public function __construct(){
		add_action( 'admin_menu', array( $this, 'admin_menu') );
	}

	/**
	 * Adds the admin menu for settings
	 *
	 * @since      1.0.0
	 */
	public function admin_menu(){
        add_submenu_page( 'edit.php?post_type=paypal_button', __('Settings','angelleye-paypal-wp-button-manager'), __('Settings','angelleye-paypal-wp-button-manager'), 'manage_options', self::$slug, array( $this, 'paypal_button_manager_settings') );
    }

    /**
	 * Loads the appropriate setting partial.
	 *
	 * @since      1.0.0
	 */
    public function paypal_button_manager_settings(){
    	$emails = self::get_emails();

    	if( !isset( $_GET['section'] ) ){
	    	include_once( ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_PATH .'/admin/partials/settings/angelleye-paypal-wp-button-manager-admin-settings.php');
    	} else {
    		foreach( $emails as $email ){
    			if( $email->base_slug == $_GET['section'] ){
    				$email->load_template();
    				break;
    			}
    		}
    	}
    }

    /**
     * Gives the array of current email settings
     * 
     * @return array
     * */
    public static function get_emails(){
    	return array(
			Angelleye_Paypal_Wp_Button_Manager_New_Order_Email::get_instance(),
			Angelleye_Paypal_Wp_Button_Manager_Processing_Order_Email::get_instance()
		);
    }
}