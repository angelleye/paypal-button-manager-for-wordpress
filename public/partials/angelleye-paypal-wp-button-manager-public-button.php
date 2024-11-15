<div id="form-<?php echo $button_id; ?>" data-id="<?php echo $button_id; ?>" class="wbp-form"><?php
	if($button->is_data_fields_hidden() !== 'yes') {
		?><div class="item-image">
			<img src="<?php echo wp_get_attachment_url($button->get_image_id() ); ?>">			
		</div>

		<div class="item-name-details" style="<?php echo (!empty($button->right_background_color())) ? 'background: '.$button->right_background_color() : '' ?>; <?php echo (!empty($button->right_foreground_color())) ? 'color: '.$button->right_foreground_color() : ''; ?>">
			<label class="item-name-label" style="<?php echo (!empty($button->left_background_color())) ? 'background: '.$button->left_background_color() : '' ?>; <?php echo (!empty($button->left_foreground_color())) ? 'color: '.$button->left_foreground_color() : ''; ?>"><?php _e("Item Name:", "angelleye-paypal-wp-button-manager") ?></label>
			<p class="item-name" style="<?php echo (!empty($button->right_background_color())) ? 'background: '.$button->right_background_color() : '' ?>; <?php echo (!empty($button->right_foreground_color())) ? 'color: '.$button->right_foreground_color() : ''; ?>"><?php echo $button->get_item_name(); ?></p>
		</div>
		
		<div class="price-currency" style="<?php echo (!empty($button->right_background_color())) ? 'background: '.$button->right_background_color() : '' ?>; <?php echo (!empty($button->right_foreground_color())) ? 'color: '.$button->right_foreground_color() : ''; ?>">
			<div class="price">
				<label class="item-price-label" style="<?php echo (!empty($button->left_background_color())) ? 'background: '.$button->left_background_color() : '' ?>; <?php echo (!empty($button->left_foreground_color())) ? 'color: '.$button->left_foreground_color() : ''; ?>"><?php _e("Price: ", "angelleye-paypal-wp-button-manager"); ?></label>
				<p class="item-price"><?php echo angelleye_paypal_button_manager_get_price_html( $button->get_price(), $button->get_currency() ); ?></p>
			</div>
		</div><?php

		if( !empty( $button->get_shipping_amount() ) ){
			?><div class="shipping-rate" style="<?php echo (!empty($button->right_background_color())) ? 'background: '.$button->right_background_color() : '' ?>; <?php echo (!empty($button->right_foreground_color())) ? 'color: '.$button->right_foreground_color() : ''; ?>">
				<label class="shipping-rate-label" style="<?php echo (!empty($button->left_background_color())) ? 'background: '.$button->left_background_color() : '' ?>; <?php echo (!empty($button->left_foreground_color())) ? 'color: '.$button->left_foreground_color() : ''; ?>"><?php _e("Shipping Rate:", "angelleye-paypal-wp-button-manager"); ?></label>
				<p class="shipping"><?php echo angelleye_paypal_button_manager_get_price_html( $button->get_shipping_amount(), $button->get_currency() ); ?></p>
			</div><?php 
		} 

		$tax = !empty( $button->get_tax_rate() ) ? $button->get_tax_total() : 0;
		$total_amount = $button->get_total();

		if( !empty( $button->get_tax_rate() ) ){
			?><div class="tax-rate" style="<?php echo (!empty($button->right_background_color())) ? 'background: '.$button->right_background_color() : '' ?>; <?php echo (!empty($button->right_foreground_color())) ? 'color: '.$button->right_foreground_color() : ''; ?>">
				<label class="tax-rate-label" style="<?php echo (!empty($button->left_background_color())) ? 'background: '.$button->left_background_color() : '' ?>; <?php echo (!empty($button->left_foreground_color())) ? 'color: '.$button->left_foreground_color() : ''; ?>"><?php echo sprintf( __("%s (%s%%): ", "angelleye-paypal-wp-button-manager"), $button->get_tax_name(), $button->get_tax_rate() ); ?></label>
				<p class="tax-amount"><?php echo angelleye_paypal_button_manager_get_price_html( $tax, $button->get_currency() ); ?></p>
			</div><?php 
		}

		?><div style="<?php echo (!empty($button->right_background_color())) ? 'background: '.$button->right_background_color() : '' ?>; <?php echo (!empty($button->right_foreground_color())) ? 'color: '.$button->right_foreground_color() : ''; ?>">
			<label class="total-amount-label" style="<?php echo (!empty($button->left_background_color())) ? 'background: '.$button->left_background_color() : '' ?>; <?php echo (!empty($button->left_foreground_color())) ? 'color: '.$button->left_foreground_color() : ''; ?>"><?php _e("Total Amount:", "angelleye-paypal-wp-button-manager"); ?></label>
			<p class="total-amount"><?php echo angelleye_paypal_button_manager_get_price_html($total_amount, $button->get_currency() ) ?></p>
		</div><?php
	}
	?><div id="wbp-button-<?php echo $button_id; ?>" class="wbp-button" data-button_id="<?php echo $button_id; ?>"></div><?php
	if( !in_array( 'card', $button->get_hide_funding_method() ) ){
		?><div class="or-line" id="or-line-<?php echo $button_id; ?>"><?php _e('or','angelleye-paypal-wp-button-manager'); ?></div>
	    <div id="card-form-<?php echo $button_id; ?>" class="card_container">
	        <div id="card-name-field-container"></div>
	        <div id="card-number-field-container"></div>
	        <div id="card-expiry-field-container"></div>
	        <div id="card-cvv-field-container"></div>
	        <div class="card-form-address-billing">
	            <label class="b-address-heading"><?php _e('Billing address','angelleye-paypal-wp-button-manager'); ?></label>
	            <div class="d-flex">
	                <input type="text" id="billing_first_name" name="billing_first_name" class="css-1kezamb-FloatingLabelInputElement-FloatingLabelInput eticpaj2" placeholder="<?php _e('First name','angelleye-paypal-wp-button-manager'); ?>">
	                <input type="text" id="billing_last_name" name="billing_last_name" class="css-1kezamb-FloatingLabelInputElement-FloatingLabelInput eticpaj2" placeholder="<?php _e('Last name','angelleye-paypal-wp-button-manager'); ?>">
	            </div>
	            <input type="text" id="billing_address_line_1" name="billing_address_line_1" placeholder="<?php _e('Street address','angelleye-paypal-wp-button-manager'); ?>">
	            <input type="text" id="billing_address_line_2" name="billing_address_line_2" placeholder="<?php _e('Apt., ste., bldg.','angelleye-paypal-wp-button-manager'); ?>">
	            <input type="text" id="billing_city" name="billing_city" placeholder="<?php _e('City','angelleye-paypal-wp-button-manager'); ?>">
	            <select id="billing_country" name="billing_country" data-id="<?php echo $button_id; ?>"><?php
	                ?><option value=""><?php _e('Please Select Country','angelleye-paypal-wp-button-manager'); ?></option><?php
	                foreach (angelleye_paypal_wp_button_manager_get_countries() as $country_id => $country) {
                        ?><option value="<?php echo $country_id; ?>"><?php echo $country; ?></option><?php
                    }
	            ?></select>
	            <select id="billing_state" name="billing_state"><option value=""><?php _e('Please Select State','angelleye-paypal-wp-button-manager'); ?></select>
	            <input type="text" id="billing_postcode" name="billing_postcode" placeholder="<?php _e('ZIP code','angelleye-paypal-wp-button-manager'); ?>">
	            <input type="tel" id="billing_phone" name="billing_phone" placeholder="<?php _e('Phone','angelleye-paypal-wp-button-manager'); ?>">
	            <input type="email" id="billing_email" placeholder="<?php _e('Email','angelleye-paypal-wp-button-manager'); ?>">
	            <div class="checkbox"><input name="shipToBillingAddress" id="shipToBillingAddress" type="checkbox" checked="checked"><label for="shipToBillingAddress"><?php _e('Ship to billing address','angelleye-paypal-wp-button-manager'); ?></label></div>
	        </div>
	        <div class="card-form-address-shipping card-form-address-billing" style="display: none;">
	            <label class="b-address-heading"><?php _e('Shipping address','angelleye-paypal-wp-button-manager'); ?></label>
	            <input type="text" id="shipping_address_line_1" name="shipping_address_line_1" placeholder="<?php _e('Street address','angelleye-paypal-wp-button-manager'); ?>">
	            <input type="text" id="shipping_address_line_2" name="shipping_address_line_2" placeholder="<?php _e('Apt., ste., bldg.','angelleye-paypal-wp-button-manager'); ?>">
	            <input type="text" id="shipping_city" name="shipping_city" placeholder="<?php _e('City','angelleye-paypal-wp-button-manager'); ?>">
	            <select id="shipping_country" name="shipping_country" data-id="<?php echo $button_id; ?>"><?php
	                ?><option value=""><?php _e('Please Select Country','angelleye-paypal-wp-button-manager'); ?></option><?php
	                foreach (angelleye_paypal_wp_button_manager_get_countries() as $country_id => $country) {
                        ?><option value="<?php echo $country_id; ?>"><?php echo $country; ?></option><?php
                    }
	            ?></select>
	            <select id="shipping_state" name="shipping_state"><option value=""><?php _e('Please Select State','angelleye-paypal-wp-button-manager'); ?></select>
	            <input type="text" id="shipping_postcode" name="shipping_postcode" placeholder="<?php _e('ZIP code','angelleye-paypal-wp-button-manager'); ?>">
	        </div>
	        <div id="error-messages-<?php echo $button_id; ?>" style="color: red; display: none;"></div>
	        <button id="card-field-submit-button" type="button">
	        	<span class="button-loader" style="display: none;">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" width="200" height="200" style="shape-rendering: auto; display: block; background: transparent;" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g transform="rotate(0 50 50)">
					  <rect fill="#000000" height="12" width="6" ry="6" rx="3" y="24" x="47">
					    <animate repeatCount="indefinite" begin="-0.9166666666666666s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate>
					  </rect>
					</g><g transform="rotate(30 50 50)">
					  <rect fill="#000000" height="12" width="6" ry="6" rx="3" y="24" x="47">
					    <animate repeatCount="indefinite" begin="-0.8333333333333334s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate>
					  </rect>
					</g><g transform="rotate(60 50 50)">
					  <rect fill="#000000" height="12" width="6" ry="6" rx="3" y="24" x="47">
					    <animate repeatCount="indefinite" begin="-0.75s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate>
					  </rect>
					</g><g transform="rotate(90 50 50)">
					  <rect fill="#000000" height="12" width="6" ry="6" rx="3" y="24" x="47">
					    <animate repeatCount="indefinite" begin="-0.6666666666666666s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate>
					  </rect>
					</g><g transform="rotate(120 50 50)">
					  <rect fill="#000000" height="12" width="6" ry="6" rx="3" y="24" x="47">
					    <animate repeatCount="indefinite" begin="-0.5833333333333334s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate>
					  </rect>
					</g><g transform="rotate(150 50 50)">
					  <rect fill="#000000" height="12" width="6" ry="6" rx="3" y="24" x="47">
					    <animate repeatCount="indefinite" begin="-0.5s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate>
					  </rect>
					</g><g transform="rotate(180 50 50)">
					  <rect fill="#000000" height="12" width="6" ry="6" rx="3" y="24" x="47">
					    <animate repeatCount="indefinite" begin="-0.4166666666666667s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate>
					  </rect>
					</g><g transform="rotate(210 50 50)">
					  <rect fill="#000000" height="12" width="6" ry="6" rx="3" y="24" x="47">
					    <animate repeatCount="indefinite" begin="-0.3333333333333333s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate>
					  </rect>
					</g><g transform="rotate(240 50 50)">
					  <rect fill="#000000" height="12" width="6" ry="6" rx="3" y="24" x="47">
					    <animate repeatCount="indefinite" begin="-0.25s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate>
					  </rect>
					</g><g transform="rotate(270 50 50)">
					  <rect fill="#000000" height="12" width="6" ry="6" rx="3" y="24" x="47">
					    <animate repeatCount="indefinite" begin="-0.16666666666666666s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate>
					  </rect>
					</g><g transform="rotate(300 50 50)">
					  <rect fill="#000000" height="12" width="6" ry="6" rx="3" y="24" x="47">
					    <animate repeatCount="indefinite" begin="-0.08333333333333333s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate>
					  </rect>
					</g><g transform="rotate(330 50 50)">
					  <rect fill="#000000" height="12" width="6" ry="6" rx="3" y="24" x="47">
					    <animate repeatCount="indefinite" begin="0s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate>
					  </rect>
					</g><g></g></g></svg>
				</span>
	        	<span class="button-text"><?php _e('Pay now with Card','angelleye-paypal-wp-button-manager'); ?></span>
	        </button>
	    </div><?php
	}
?></div>