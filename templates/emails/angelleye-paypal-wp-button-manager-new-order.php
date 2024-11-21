<table style="width: 600px;margin: 20px auto; background-color: #ffffff; border: 1px solid #ddd; border-spacing: 0;">
    <tr>
        <td style="background-color: <?php echo $background_color; ?>;color: #ffffff; padding: 20px; text-align: center; font-size: 18px; font-weight: bold;"><?php echo $subject; ?></td>
    </tr>
    <tr>
        <td style="padding: 20px;">
        	<p style="color: <?php echo $text_color; ?>"><?php echo sprintf( __('You\'ve received the following order from %s:','angelleye-paypal-wp-button-manager'), $customer_name ); ?></p>
            <h4 style="margin: 0; font-size: 16px; color: <?php echo $background_color; ?>;"><?php echo sprintf( __('[Order #%s] (%s)','angelleye-paypal-wp-button-manager'), $order_number, $order_date ); ?></h4>
            <table style="width: 100%; margin-top: 10px; border: 1px solid #E2E8F0; border-collapse: collapse; text-align: left;">
                <thead>
                    <tr style="background-color: #f4f4f4;">
                        <th style="padding: 8px; border: 1px solid #E2E8F0; color: <?php echo $text_color; ?>"><?php _e('Product','angelleye-paypal-wp-button-manager'); ?></th>
                        <th style="padding: 8px; border: 1px solid #E2E8F0; color: <?php echo $text_color; ?>"><?php _e('Quantity','angelleye-paypal-wp-button-manager'); ?></th>
                        <th style="padding: 8px; border: 1px solid #E2E8F0; color: <?php echo $text_color; ?>"><?php _e('Price','angelleye-paypal-wp-button-manager'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding: 8px; border: 1px solid #E2E8F0; color: <?php echo $text_color; ?>"><?php echo $button->get_item_name(); ?></td>
                        <td style="padding: 8px; border: 1px solid #E2E8F0; color: <?php echo $text_color; ?>">1</td>
                        <td style="padding: 8px; border: 1px solid #E2E8F0; color: <?php echo $text_color; ?>"><?php echo angelleye_paypal_button_manager_get_price_html( $button->get_price(), $button->get_currency() ); ?></td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 100%; margin-top: 10px; text-align: left;border: 1px solid #E2E8F0;margin: 0;border-collapse: collapse;">
                <tr>
                    <td style="width: 69.5%;border-bottom: 1px solid #E2E8F0; padding: 8px; color: <?php echo $text_color; ?>;"><?php _e('Subtotal:','angelleye-paypal-wp-button-manager'); ?></td>
                    <td style="border-bottom: 1px solid #E2E8F0; padding: 8px; color: <?php echo $text_color; ?>;"><?php echo angelleye_paypal_button_manager_get_price_html( $button->get_price(), $button->get_currency() ); ?></td>
                </tr><?php
                if( !empty( $button->get_shipping_amount() ) ){
                	?><tr>
	                    <td style="border-bottom: 1px solid #E2E8F0; padding: 8px; color: <?php echo $text_color; ?>;"><?php _e('Shipping Rate:','angelleye-paypal-wp-button-manager'); ?></td>
	                    <td style="border-bottom: 1px solid #E2E8F0; padding: 8px; color: <?php echo $text_color; ?>;"><?php echo angelleye_paypal_button_manager_get_price_html( $button->get_shipping_amount(), $button->get_currency() ); ?></td>
	                </tr><?php
                }

                if( !empty( $button->get_tax_rate() ) ){
                	?><tr>
	                    <td style="border-bottom: 1px solid #E2E8F0; padding: 8px; color: <?php echo $text_color; ?>;"><?php echo sprintf( __("%s (%s%%): ", "angelleye-paypal-wp-button-manager"), $button->get_tax_name(), $button->get_tax_rate() ); ?></td>
	                    <td style="border-bottom: 1px solid #E2E8F0; padding: 8px; color: <?php echo $text_color; ?>;"><?php echo angelleye_paypal_button_manager_get_price_html( $tax, $button->get_currency() ); ?></td>
	                </tr><?php
                }
                
                ?><tr>
                    <td style="padding: 8px; font-weight: bold; color: <?php echo $text_color; ?>;"><?php _e('Total Amount:','angelleye-paypal-wp-button-manager'); ?></td>
                    <td style="padding: 8px; font-weight: bold; color: <?php echo $text_color; ?>;"><?php echo angelleye_paypal_button_manager_get_price_html($button->get_total(), $button->get_currency() ) ?></td>
                </tr>
            </table>
        </td>
    </tr>
</table>