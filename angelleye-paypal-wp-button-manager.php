<?php

/**
 * @link              https://angelleye.com
 * @since             1.0.0
 * @package           Angelleye_Paypal_Wp_Button_Manager
 *
 * @wordpress-plugin
 * Plugin Name:       PayPal WP Button Manager
 * Plugin URI:        https://angelleye.com
 * Description:       Easily create and manage secure PayPal buttons for WordPress
 * Version:           1.0.0
 * Author:            Angell Eye
 * Author URI:        https://angelleye.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       angelleye-paypal-wp-button-manager
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-angelleye-paypal-wp-button-manager-activator.php
 */
function activate_angelleye_paypal_wp_button_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-angelleye-paypal-wp-button-manager-activator.php';
	Angelleye_Paypal_Wp_Button_Manager_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-angelleye-paypal-wp-button-manager-deactivator.php
 */
function deactivate_angelleye_paypal_wp_button_manager() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-angelleye-paypal-wp-button-manager-deactivator.php';
	Angelleye_Paypal_Wp_Button_Manager_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_angelleye_paypal_wp_button_manager' );
register_deactivation_hook( __FILE__, 'deactivate_angelleye_paypal_wp_button_manager' );

if ( ! defined( 'ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_FILE' ) ) {
    define( 'ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_URL') ) {
    define( 'ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if( !defined( 'ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_PATH') ) {
    define('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_PATH', __DIR__ );
}

if( !defined('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_IMAGE_PATH' ) ){
    define('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_IMAGE_PATH', ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_URL . 'admin/images/' );
}

if( !defined('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_API_LINK') ){
    define('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_API_LINK', 'https://zpyql2kd39.execute-api.us-east-2.amazonaws.com/production/PayPalMerchantIntegration/' );
}

if( !defined('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PPCP_LINK') ){
    define('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PPCP_LINK', 'https://zpyql2kd39.execute-api.us-east-2.amazonaws.com/production/PayPalMerchantIntegration/' );
}

if( !defined('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_AWS_ID_TOKEN') ){
    define('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_AWS_ID_TOKEN', 'https://zpyql2kd39.execute-api.us-east-2.amazonaws.com/production/PayPalMerchantIntegration/' );
}

if( !defined( 'ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_SANDBOX_PARTNER_MERCHANT_ID') ){
    define('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_SANDBOX_PARTNER_MERCHANT_ID', 'B82TS7QWRJ6TS');
}

if( !defined( 'ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_LIVE_PARTNER_MERCHANT_ID') ){
    define('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_LIVE_PARTNER_MERCHANT_ID', 'J9L24TCUDZ6ZS');
}

if (!defined('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_SANDBOX_PARTNER_CLIENT_ID')) {
    define('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_SANDBOX_PARTNER_CLIENT_ID', 'AaYsUf4lXeKOnLmKhDWbak0YYWNk5SW0Lt1lk22gFvsgu74h1Vawg1y6rcmt60f8JIx-x81J5bMA-q7O');
}

if (!defined('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_LIVE_PARTNER_CLIENT_ID')) {
    define('ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_LIVE_PARTNER_CLIENT_ID', 'AaYsUf4lXeKOnLmKhDWbak0YYWNk5SW0Lt1lk22gFvsgu74h1Vawg1y6rcmt60f8JIx-x81J5bMA-q7O');
}

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-angelleye-paypal-wp-button-manager.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_angelleye_paypal_wp_button_manager() {

	$plugin = new Angelleye_Paypal_Wp_Button_Manager();
	$plugin->run();

}
run_angelleye_paypal_wp_button_manager();

add_action( 'in_plugin_update_message-paypal-wp-button-manager/paypal-wp-button-manager.php', 'angelleye_custom_plugin_update_message', 10, 2 );
function angelleye_custom_plugin_update_message( $plugin_data, $response ) {
    // Check if the plugin has an update available
    if ( isset( $response->upgrade_notice ) && ! empty( $response->upgrade_notice ) ) {
        echo '<div style="margin-top: 10px; padding: 5px; background-color: #fff9c4; border: 1px solid #f1c40f;">';
        echo '<p><strong>' . __('Important Update Notice:','angelleye-paypal-wp-button-manager') . '</strong></p>';
        echo '<p>' . sprintf( __('If you\'re using an existing payment button do not update the plugin to the newest version, instead please create a new button <a href="%s">Here</a>', 'angelleye-paypal-wp-button-manager' ), admin_url('post-new.php?post_type=paypal_buttons') ) . '</p>';
        echo '</div>';
    }
}