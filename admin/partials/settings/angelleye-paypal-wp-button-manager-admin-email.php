<div class="tab-container">
    <input type="radio" id="email_tab" name="tabs" checked>
    <label for="email_tab" class="tab"><?php _e('Emails','angelleye-paypal-wp-button-manager'); ?></label>

    <div class="tab-content">
        <div class="tab-pane" id="email_content">
            <div class="email-notifications-wrap">
                <h2 class="email-title"><?php _e('Email Notifications','angelleye-paypal-wp-button-manager'); ?></h2>
                <table class="email-settings-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th><?php _e('Email','angelleye-paypal-wp-button-manager'); ?></th>
                            <th><?php _e('Recipient(s)','angelleye-paypal-wp-button-manager'); ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody><?php
                        foreach( $emails as $email ){
                            ?><tr>
                                <td class="email-table-status">
                                    <span class="status-<?php echo get_option( $email->base_slug . '_enable' ) == 'yes' ? 'enabled' : 'disabled'; ?> tips"><?php echo ucfirst( get_option( $email->base_slug . '_enabled' ) ); ?></span>
                                </td>
                                <td>
                                    <a href="<?php echo admin_url('edit.php?post_type=' . Angelleye_Paypal_Wp_Button_Manager_Post::$post_type ) . '&page=' . self::$slug . '&section=' . $email->base_slug; ?>"><?php echo $email->title; ?></a>
                                    <span class="help-tip-before help-tip-info">    <span class="tooltiptext"><?php echo $email->subtitle; ?></span>
                                    </span>
                                </td>
                                <td><?php echo $email->sent_to_customer ? __('Customer','angelleye-paypal-wp-button-manager') : get_option( $email->base_slug . '_recipients'); ?></td>
                                <td><a href="<?php echo admin_url('edit.php?post_type=' . Angelleye_Paypal_Wp_Button_Manager_Post::$post_type ) . '&page=' . self::$slug . '&section=' . $email->base_slug; ?>" class="manage-btn"><?php _e('Manage','angelleye-paypal-wp-button-manager'); ?></a></td>
                            </tr><?php
                        }
                    ?></tbody>
                </table>
                <form method="POST" action="<?php echo admin_url('admin-post.php'); ?>">
                    <input type="hidden" name="action" value="angelleye_paypal_wp_button_manager_admin_email_settings">
                    <div class="email-options">
                        <h2><?php _e('Email sender options','angelleye-paypal-wp-button-manager'); ?></h2> 
                        <div class="form-list">
                            <label><?php _e('"From" name','angelleye-paypal-wp-button-manager'); ?></label>
                            <input name="angelleye_paypal_wp_button_manager_admin_email_from_name" type="text" placeholder="<?php _e('AngellEye PayPal Button Manager','angelleye-paypal-wp-button-manager'); ?>" value="<?php echo get_option('angelleye_paypal_wp_button_manager_admin_email_from_name'); ?>">
                        </div>
                        <div class="form-list">
                            <label><?php _e('"From" address','angelleye-paypal-wp-button-manager'); ?></label>
                            <input name="angelleye_paypal_wp_button_manager_admin_email_from_email" type="email" placeholder="<?php echo get_option( 'admin_email'); ?>" value="<?php echo get_option('angelleye_paypal_wp_button_manager_admin_email_from_email'); ?>">
                        </div>
                    </div>
                    <div class="email-template">
                        <h2><?php _e('Email template','angelleye-paypal-wp-button-manager'); ?></h2>
                        <div class="form-list">
                            <label><?php _e('Background color','angelleye-paypal-wp-button-manager'); ?></label>
                            <input type="text" name="angelleye_paypal_wp_button_manager_admin_email_body_background_color" class="angelleye-color-picker" value="<?php echo get_option('angelleye_paypal_wp_button_manager_admin_email_body_background_color'); ?>" />
                        </div>
                        <div class="form-list">
                            <label><?php _e('Text color','angelleye-paypal-wp-button-manager'); ?></label>
                            <input type="text" name="angelleye_paypal_wp_button_manager_admin_email_body_text_color" class="angelleye-color-picker" value="<?php echo get_option('angelleye_paypal_wp_button_manager_admin_email_body_text_color'); ?>" />
                        </div>
                    </div>
                    <button class="save-btn"><?php _e('Save changes','angelleye-paypal-wp-button-manager'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>