<?php
defined( 'ABSPATH' ) || exit;
/*
 * Class responsible for PayPal Order Emails
 */
class Angelleye_Paypal_Wp_Button_Manager_Order_Email {

	/**
	 * The fields of the settings.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      array    $fields    The array of the fields.
	 */
	public $fields = array();

	/**
	 * The base slug of this email setting.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $base_slug    The base slug of this email setting.
	 */
	public $base_slug = '';

	/**
	 * The template path of this email setting.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $template_path    The template path of this email setting.
	 */
	public $template_path = '';

	/**
	 * The title of this email setting.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $title    The title of this email setting.
	 */
	public $title = '';

	/**
	 * The subtitle of this email setting.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $subtitle    The subtitle of this email setting.
	 */
	public $subtitle = '';

	/**
	 * Whether to send this email to customer or not
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $sent_to_customer    Whether to send this email to customer or not.
	 */
	public $sent_to_customer = true;

	/**
	 * Whether the template is overriden
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $overridden_template    Whether the template is overriden.
	 */
	public $overridden_template = false;

	/**
	 * Template overriden path if it is overriden
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $overridden_template_path    Template overriden path if it is overriden
	 */
	public $overridden_template_path = '';

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since      1.0.0
	 */
	public function __construct(){
		add_action("admin_post_angelleye_paypal_wp_button_manager_admin_{$this->base_slug}", array( $this, 'save_settings') );
		add_action("admin_post_angelleye_paypal_wp_button_manager_admin_{$this->base_slug}_copy_template", array( $this, 'copy_template' ) );
		add_action("admin_post_angelleye_paypal_wp_button_manager_admin_{$this->base_slug}_delete_template", array( $this, 'delete_template' ) );
		add_action("admin_post_angelleye_paypal_wp_button_manager_admin_email_settings", array( $this, 'save_email_settings') );
		self::load_fields();
		self::set_overridden_template();
	}

	/**
	 * Loads the fields.
	 *
	 * @since    1.0.0
	 */
	public function load_fields(){
		$this->fields = array(
			array(
				'type' => 'checkbox',
				'name' => 'enable',
				'label' => __('Enable/Disable','angelleye-paypal-wp-button-manager'),
			),
			array(
				'type' => 'text',
				'name' => 'subject',
				'label' => __('Subject','angelleye-paypal-wp-button-manager'),
				'tooltip' => __('Available placeholders: {order_date}, {order_number}, {site_url}','angelleye-paypal-wp-button-manager'),
				'placeholder' => __('New Order: #{order_number}','angelleye-paypal-wp-button-manager'),
			)
		);
	}

	/**
	 * Loads the template.
	 *
	 * @since    1.0.0
	 */
	public function load_template(){
		$template = file_get_contents( $this->overridden_template_path ? $this->overridden_template_path : $this->template_path, 'r');
		include ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_PATH . '/admin/partials/settings/angelleye-paypal-wp-button-manager-order-email.php';
	}

	/**
	 * Saves the settings
	 *
	 * @since    1.0.0
	 */
	public function save_settings(){
		if( isset( $_POST['save_' . $this->base_slug ] ) ){
			foreach ($this->fields as $field ) {
				if( $field['type'] == 'checkbox' ){
					if( isset( $_POST[$this->base_slug . '_' . $field['name'] ] ) ){
						update_option( $this->base_slug . '_' . $field['name'], 'yes' );
					} else {
						update_option( $this->base_slug . '_' . $field['name'], 'no' );
					}
				} else {
					update_option( $this->base_slug . '_' . $field['name'], esc_sql( $_POST[$this->base_slug . '_' . $field['name'] ] ) );
				}
			}

			if( $this->overridden_template ){
				unlink( $this->overridden_template_path );
				file_put_contents( $this->overridden_template_path, $_POST['template_code']);
			}
		}
		wp_redirect(admin_url('edit.php?post_type=' . Angelleye_Paypal_Wp_Button_Manager_Post::$post_type ) . '&page=' . Angelleye_Paypal_Wp_Button_Manager_Settings::$slug);
	}

	/**
	 * Copies the template
	 *
	 * @since    1.0.0
	 */
	public function copy_template(){
		$template = file_get_contents( $this->template_path, 'r');
		$new_template = trailingslashit( get_stylesheet_directory() ) . str_replace( 'templates/', '', plugin_basename( $this->template_path ) );
		$dir = dirname( $new_template );
		if( !file_exists($dir) ){
			wp_mkdir_p( $dir );
		}

		if( !file_exists( $new_template ) ){
			file_put_contents( $new_template, $template);
		}
		wp_redirect(admin_url('edit.php?post_type=' . Angelleye_Paypal_Wp_Button_Manager_Post::$post_type ) . '&page=' . Angelleye_Paypal_Wp_Button_Manager_Settings::$slug . '&section=' . $this->base_slug );
	}

	/**
	 * Sets whether template is overriden or not
	 *
	 * @since    1.0.0
	 */
	public function set_overridden_template(){
		$this->overridden_template = file_exists( trailingslashit( get_stylesheet_directory() ) . str_replace( 'templates/', '', plugin_basename( $this->template_path ) ) );
		if( $this->overridden_template ){
			$this->overridden_template_path = trailingslashit( get_stylesheet_directory() ) . str_replace( 'templates/', '', plugin_basename( $this->template_path ) );
		}
	}

	/**
	 * Deletes the template
	 *
	 * @since    1.0.0
	 */
	public function delete_template(){
		if( $this->overridden_template ){
			unlink( $this->overridden_template_path );
		}
		wp_redirect(admin_url('edit.php?post_type=' . Angelleye_Paypal_Wp_Button_Manager_Post::$post_type ) . '&page=' . Angelleye_Paypal_Wp_Button_Manager_Settings::$slug . '&section=' . $this->base_slug );
	}

	/**
	 * Saves the email settings.
	 *
	 * @since    1.0.0
	 */
	public function save_email_settings(){
		update_option( 'angelleye_paypal_wp_button_manager_admin_email_from_name', esc_sql( $_POST['angelleye_paypal_wp_button_manager_admin_email_from_name'] ) );
		update_option( 'angelleye_paypal_wp_button_manager_admin_email_from_email', esc_sql( $_POST['angelleye_paypal_wp_button_manager_admin_email_from_email'] ) );
		update_option( 'angelleye_paypal_wp_button_manager_admin_email_body_background_color', esc_sql( $_POST['angelleye_paypal_wp_button_manager_admin_email_body_background_color'] ) );
		update_option( 'angelleye_paypal_wp_button_manager_admin_email_body_text_color', esc_sql( $_POST['angelleye_paypal_wp_button_manager_admin_email_body_text_color'] ) );
		wp_redirect(admin_url('edit.php?post_type=' . Angelleye_Paypal_Wp_Button_Manager_Post::$post_type ) . '&page=' . Angelleye_Paypal_Wp_Button_Manager_Settings::$slug );
	}
}