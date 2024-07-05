<div class="wrap">
    <h1><?php _e('Edit Subscription', 'angelleye-paypal-wp-button-manager'); ?></h1>
    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
        <input type="hidden" name="action" value="angelleye_paypal_wp_button_manager_admin_update_subscription">
        <input type="hidden" name="subscription_id" value="<?php echo $subscription->get_id(); ?>">
        <table class="form-table">
            <tr>
                <th><?php _e('First Name', 'angelleye-paypal-wp-button-manager'); ?></th>
                <td><?php echo esc_html( $subscription->get_first_name() ); ?></td>
            </tr>
            <tr>
                <th><?php _e('Last Name', 'angelleye-paypal-wp-button-manager'); ?></th>
                <td><?php echo esc_html($subscription->get_last_name()); ?></td>
            </tr>
            <tr>
                <th><?php _e('Subscription Item Name', 'angelleye-paypal-wp-button-manager'); ?></th>
                <td><?php echo esc_html($button->get_item_name() ); ?></td>
            </tr>
            <tr>
                <th><?php _e('Item ID', 'angelleye-paypal-wp-button-manager'); ?></th>
                <td><?php echo esc_html($button->get_item_id()); ?></td>
            </tr>
            <tr>
                <th><?php _e('Price', 'angelleye-paypal-wp-button-manager'); ?></th>
                <td><?php echo angelleye_paypal_button_manager_get_price_html( $button->get_total(), $button->get_currency() ); ?></td>
            </tr>
            <tr>
                <th><?php _e('Frequency', 'angelleye-paypal-wp-button-manager'); ?></th>
                <td><?php echo esc_html( $button->get_frequency_count() . " " . $button->get_frequency() ); ?></td>
            </tr>
            <tr>
                <th><?php _e('Next Due Date', 'angelleye-paypal-wp-button-manager'); ?></th>
                <td><input type="date" name="next_payment_due_date" value="<?php echo date( 'Y-m-d', strtotime( $subscription->get_next_due_date() ) ); ?>" /></td>
            </tr>
            <tr>
                <th><?php _e('Status', 'angelleye-paypal-wp-button-manager'); ?></th>
                <td>
                    <select name="status">
                        <?php foreach ($statuses as $status): ?>
                            <option value="<?php echo esc_attr($status); ?>" <?php selected($subscription->get_status(), $status); ?>><?php echo ucfirst($status); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
        </table>
        <p>
            <button type="submit" class="button button-primary"><?php _e('Save Changes', 'angelleye-paypal-wp-button-manager'); ?></button>
        </p>
    </form>
    <form method="post" action="<?php echo admin_url('admin-post.php'); ?>">
        <input type="hidden" name="action" value="angelleye_paypal_wp_button_manager_admin_delete_subscription">
        <input type="hidden" name="subscription_id" value="<?php echo $subscription->get_id(); ?>">
        <p>
            <button type="submit" class="button button-secondary"><?php _e('Renew Subscription Now', 'angelleye-paypal-wp-button-manager'); ?></button>
        </p>
    </form>
</div>