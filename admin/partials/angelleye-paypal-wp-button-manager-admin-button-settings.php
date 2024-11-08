<?php
// Add a nonce field so we can check for it later.
wp_nonce_field( 'paypal_button_settings', 'paypal_button_settings_nonce' );
?><div class="paypal-button-generator-form">
    <div class="btn-type-payment-details">
        <div id="stepOne" class="panel panel-primary">
            <div class="panel-body" id="collapseOne">
                <div class="row" class="row">
                    <div class="btn_type col-md-12">
                        <div class="form-pd">
                            <div class="d-flex">
                                <label for="button_type"><?php _e("Choose a button type", "angelleye-paypal-wp-button-manager") ?></label>
                                <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Choose \'Buy Now\' for a one-time purchase or \'Subscription\' for automatic renewals at selected intervals.','angelleye-paypal-wp-button-manager'); ?></span></span>
                            </div>
                            <select class="form-control button-type" name="button_type" id="button_type">
                                <option value="services" <?php selected('services', $button->get_button_type( 'edit' ) ); ?>><?php _e("Buy Now", "angelleye-paypal-wp-button-manager"); ?></option>
                                <option value="subscription" <?php selected('subscription', $button->get_button_type( 'edit' ) ); ?>><?php _e('Subscription', 'angelleye-paypal-wp-button-manager'); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="buy_now_group">
                    <div class="row col-md-12">
                        <div class="form-pd">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="d-flex">
                                        <label for="company_id"><?php _e("Choose PayPal Account:", "angelleye-paypal-wp-button-manager");?></label>
                                        <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Choose the PayPal account where the payment will be directed.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <select class="form-control select-company" name="company_id" id="company_id" required>
                                        <option value=""><?php _e("Select Account", "angelleye-paypal-wp-button-manager"); ?></option><?php 
                                        foreach ($companies as $company) {
                                            ?><option value="<?php echo $company->ID; ?>"<?php selected($company->ID, $button->get_company_id( 'edit' ) ); ?>><?php _e($company->company_name, "angelleye-paypal-wp-button-manager") ?></option><?php 
                                        }
                                    ?></select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3" class="item-details">
                        <div class="col-md-6">
                            <div class="form-pd">
                                <div class="d-flex">
                                    <label for="item-name"><?php _e("Item Name", "angelleye-paypal-wp-button-manager") ?></label>
                                    <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Enter the item name that will be visible to customers.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                </div>
                                <input type="text" name="product_name" id="item-name" class="form-control" value="<?php echo $button->get_item_name( 'edit' ); ?>" maxlength="100" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-pd">
                                <div class="d-flex">
                                    <label for="item-id"><?php _e("Item ID", "angelleye-paypal-wp-button-manager") ?></label>
                                    <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Enter the item ID that will be used for your internal usage.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                </div>
                                <input type="text" name="product_id" id="item-id" class="form-control" value="<?php echo $button->get_item_id( 'edit' ); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="form-pd">
                                <div class="d-flex">
                                    <label for="add-paypal-buttons-image"><?php _e("Choose Image", "angelleye-paypal-wp-button-manager") ?></label>
                                    <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Choose an image that will be shown to customers.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                </div>
                                <div class="add-img-btn-manager">
                                    <button class="button" id="add-paypal-buttons-image"><?php _e('Choose Image','angelleye-paypal-wp-button-manager'); ?></button>
                                    <button class="button remove-image" style="display: <?php echo $button->get_image_id() ? 'inline-block' : 'none'; ?>;"><?php _e('Remove Image','angelleye-paypal-wp-button-manager'); ?></button>
                                </div>
                                <input type="hidden" id="paypal_buttons_image_id" name="paypal_buttons_image_id" value="<?php echo $button->get_image_id(); ?>" />
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3" class="item-details-meta">
                        <div class="col-md-6">
                            <div class="form-pd">
                                <div class="d-flex">
                                    <label for="item-price"><?php _e("Price", "angelleye-paypal-wp-button-manager") ?></label>
                                    <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Enter the price of the item.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                </div>
                                <input type="number" min="0" step=".01" name="item_price" id="item-price" class="form-control" value="<?php echo $button->get_price( 'edit' ); ?>" required>
                            </div>
                        </div>
                        <div class="shipping col-md-6">
                            <div class="form-pd">
                                <div class="d-flex">
                                    <label><?php _e("Shipping", "angelleye-paypal-wp-button-manager") ?> <?php _e("(Use specific amount: (<span class=shipping-currency>USD</span>))", "angelleye-paypal-wp-button-manager") ?></label>
                                    <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Enter the shipping cost, or leave it blank to offer free delivery.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                </div>
                                <input type="number" min="0" step=".01" class="shipping-amount form-control" name="item_shipping_amount" value="<?php echo $button->get_shipping_amount(); ?>">
                            </div>
                        </div>
                        
                    </div>
                    <div class="shipping-tax row">
                        <div class="tax col-md-6">
                            <div class="form-pd">
                                <div class="d-flex">
                                    <label><?php _e("Tax Name", "angelleye-paypal-wp-button-manager"); ?></label>
                                    <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Enter the tax name to charge customers, or leave it blank for no tax.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                </div>
                                <input type="text" class="form-control" name="item_tax_name" value="<?php echo $button->get_tax_name(); ?>">
                            </div>
                        </div>
                        <div class="tax col-md-6">
                            <div class="form-pd">
                                <div class="d-flex">
                                    <label><?php _e("Tax", "angelleye-paypal-wp-button-manager") ?> <?php _e("(Use tax rate: (%))", "angelleye-paypal-wp-button-manager") ?></label>
                                    <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Enter the tax rate in percentage, or leave it blank if no tax is applied.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                </div>
                                <input type="number" min="0" step=".01" class="text-rate form-control" name="item_tax_rate" value="<?php echo $button->get_tax_rate(); ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-pd">
                                <div class="d-flex">
                                    <label for="item_price_currency"><?php _e("Currency", "angelleye-paypal-wp-button-manager") ?></label>
                                    <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Choose the currency in which the item is priced.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                </div>
                                <select class="form-control currency" name="item_price_currency" id="item_price_currency" required><?php 
                                foreach($currencies as $currency){
                                    ?><option value="<?php echo $currency['value']; ?>" <?php selected( $currency['value'], $button->get_currency( 'edit' ) ) ?> data-title="<?php echo $currency['title']; ?>"><?php echo $currency['value']; ?></option><?php
                                }
                                ?></select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-pd">
                                <label for="tax_on_shipping" class="tax_on_shipping"><?php _e("Apply Tax on Shipping", "angelleye-paypal-wp-button-manager") ?> </label>
                                <div class="d-flex">
                                    <input type="checkbox" id="tax_on_shipping" class="form-control" name="tax_on_shipping" <?php if( $button->get_tax_on_shipping( 'edit' ) == 'yes' ){ echo 'checked="checked"'; } ?>>
                                    <label for="tax_on_shipping" class="tax_on_shipping_lbl"><?php _e('Check this checkbox to appy tax on shipping'); ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 subscription-settings" <?php echo $button->get_button_type( 'edit' ) != 'subscription' ? 'style="display:none;"' : ''; ?>>
                        <div class="col-md-6">
                            <div class="form-pd">
                                <div class="d-flex">
                                    <label for="frequency_count"><?php _e('Subscription Management','angelleye-paypal-wp-button-manager'); ?> <?php _e("(Frequency Count)", "angelleye-paypal-wp-button-manager") ?></label>
                                    <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Specify the frequency count (greater than 0). For example, \'1\' entered here with \'month\' chosen on frequency will renew subscriptions monthly.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                </div>
                                <input type="number" min="1" name="frequency_count" id="frequency_count" class="form-control" value="<?php echo $button->get_frequency_count( 'edit' ); ?>" maxlength="100" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-pd">
                                <div class="d-flex">
                                    <label for="frequency"><?php _e("Frequency", "angelleye-paypal-wp-button-manager") ?></label>
                                    <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Specify the frequency. For example, \'1\' entered in frequency count with \'month\' chosen here will renew subscriptions monthly.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                </div>
                                <select name="frequency" id="frequency" class="form-control">
                                    <option value=""><?php _e('Please Select','angelleye-paypal-wp-button-manager'); ?></option>
                                    <option value="day" <?php selected( $button->get_frequency( 'edit' ), 'day' ); ?>><?php _e('Days','angelleye-paypal-wp-button-manager'); ?></option>
                                    <option value="week" <?php selected( $button->get_frequency( 'edit' ), 'week' ); ?>><?php _e('Weeks','angelleye-paypal-wp-button-manager'); ?></option>
                                    <option value="month" <?php selected( $button->get_frequency( 'edit' ), 'month' ); ?>><?php _e('Months','angelleye-paypal-wp-button-manager'); ?></option>
                                    <option value="year" <?php selected( $button->get_frequency( 'edit' ), 'year' ); ?>><?php _e('Years','angelleye-paypal-wp-button-manager'); ?></option>
                                </select>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="additional-settings-row-main">
                        <div class="row additional-settings-row">
                            <div class="additional-settings col-md-6">
                                <div class="form-pd additional-settings">
                                    <h5 class="additional-heading"><?php esc_html_e("Additional Settings", "angelleye-paypal-wp-button-manager"); ?></h5>
                                    <div class="d-flex">
                                        <input type="checkbox" id="hide-data-fields" class="form-control" name="hide_data_fields" value="yes" <?php echo ($button->is_data_fields_hidden() == 'yes') ? 'checked' : '' ?>>
                                        <label for="hide-data-fields"><?php esc_html_e("Hide item and pricing details, so that only the buttons are displayed.", "angelleye-paypal-wp-button-manager"); ?></label>
                                    </div>
                                </div>
                            </div>                   
                        </div>
                        <div class="row data-fields-additional-settings-row" style="<?php echo ($button->is_data_fields_hidden() == 'yes') ? 'display: none' : '' ?>">
                            <div class="data-fields-additional-settings-background col-md-6">
                                <div class="form-pd data-fields-additional-settings">
                                    <p class="d-flex">
                                        <label><?php _e("Left Background Color", "angelleye-paypal-wp-button-manager"); ?></label>
                                        <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Choose the background color for the left section of the item details shown to customers.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                    </p>
                                    <input type="text" name="left_background_color" class="angelleye-color-picker" value="<?php echo $button->left_background_color(); ?>"  />
                                </div>
                            </div>
                            <div class="data-fields-additional-settings-background col-md-6">
                                <div class="form-pd data-fields-additional-settings">
                                    <p class="d-flex">
                                        <label><?php _e("Right Background Color", "angelleye-paypal-wp-button-manager"); ?></label>
                                        <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Choose the background color for the right section of the item details shown to customers.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                    </p>
                                    <input type="text" name="right_background_color" class="angelleye-color-picker" value="<?php echo $button->right_background_color(); ?>"  />
                                </div>
                            </div>

                            <div class="data-fields-additional-settings-foreground col-md-6">
                                <div class="form-pd data-fields-additional-settings">
                                    <p class="d-flex">
                                        <label><?php _e("Left Foreground Color", "angelleye-paypal-wp-button-manager"); ?></label>
                                        <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Choose the text color for the left section of the item details shown to customers.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                    </p>
                                    <input type="text" name="left_foreground_color" class="angelleye-color-picker" value="<?php echo $button->left_foreground_color(); ?>"  />
                                </div>
                            </div>
                            <div class="data-fields-additional-settings-foreground col-md-6">
                                <div class="form-pd data-fields-additional-settings">
                                    <p class="d-flex">
                                        <label><?php _e("Right Foreground Color", "angelleye-paypal-wp-button-manager"); ?></label>
                                        <span class="dashicons-before dashicons-info paypal_shortcode_info ml-1"><span class="tooltiptext"><?php _e('Choose the text color for the right section of the item details shown to customers.','angelleye-paypal-wp-button-manager'); ?></span></span>
                                    </p>
                                    <input type="text" name="right_foreground_color" class="angelleye-color-picker" value="<?php echo $button->right_foreground_color(); ?>"  />
                                </div>
                            </div>                 
                        </div>
                    </div>
                    <div class="row customization">
                        <div class="customize-button col-md-6">
                            <div class="customize-row">
                                <div class="form-pd"><p class="btn-text"><?php _e("Customize Button", "angelleye-paypal-wp-button-manager"); ?></p></div>
                                <div class="form-group">
                                    <div class="form-pd">
                                        <label for="wbp-button-layout"><?php _e('Button Layout','angelleye-paypal-wp-button-manager'); ?></label>
                                        <select name="wbp-button-layout" id="wbp-button-layout" class="form-control wbp-field">
                                            <option value="horizontal" <?php selected('horizontal',$button->get_button_layout( 'edit' ) ); ?>><?php _e('Horizontal', 'angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="vertical" <?php selected('vertical',$button->get_button_layout( 'edit' ) ); ?>><?php _e('Vertical','angelleye-paypal-wp-button-manager'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                   <div class="form-pd">
                                        <label for="wbp-button-color"><?php _e('Button Color','angelleye-paypal-wp-button-manager'); ?></label>
                                        <select name="wbp-button-color" id="wbp-button-color" class="form-control wbp-field">
                                            <option value="gold" <?php selected('gold',$button->get_button_color( 'edit' ) ); ?>><?php _e('Gold', 'angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="blue" <?php selected('blue',$button->get_button_color( 'edit' ) ); ?>><?php _e('Blue','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="silver" <?php selected('silver',$button->get_button_color( 'edit' ) ); ?>><?php _e('Silver','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="white" <?php selected('white',$button->get_button_color( 'edit' ) ); ?>><?php _e('White','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="black" <?php selected('black',$button->get_button_color( 'edit' ) ); ?>><?php _e('Black','angelleye-paypal-wp-button-manager'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-pd">
                                        <label for="wbp-button-shape"><?php _e('Button Shape','angelleye-paypal-wp-button-manager'); ?></label>
                                        <select name="wbp-button-shape" id="wbp-button-shape" class="form-control wbp-field">
                                            <option value="rect" <?php selected('rect',$button->get_button_shape( 'edit' ) ); ?>><?php _e('Rect', 'angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="pill" <?php selected('pill',$button->get_button_shape( 'edit' ) ); ?>><?php _e('Pill','angelleye-paypal-wp-button-manager'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-pd">
                                        <label for="wbp-button-size"><?php _e('Button Size','angelleye-paypal-wp-button-manager'); ?></label>
                                        <select name="wbp-button-size" id="wbp-button-size" class="form-control wbp-field">
                                            <option value="responsive" <?php selected('responsive',$button->get_button_size( 'edit' ) ); ?>><?php _e('Responsive', 'angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="small" <?php selected('small',$button->get_button_size( 'edit' ) ); ?>><?php _e('Small','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="medium" <?php selected('medium',$button->get_button_size( 'edit' ) ); ?>><?php _e('Medium','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="large" <?php selected('large',$button->get_button_size( 'edit' ) ); ?>><?php _e('Large','angelleye-paypal-wp-button-manager'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-pd">
                                        <label for="wbp-button-height"><?php _e('Button Height','angelleye-paypal-wp-button-manager'); ?></label>
                                        <select name="wbp-button-height" id="wbp-button-height" class="form-control wbp-field">
                                            <option value="" <?php selected('',$button->get_button_height( 'edit' ) ); ?>><?php _e('Default Height', 'angelleye-paypal-wp-button-manager'); ?></option><?php
                                            for( $i=25; $i<=55; $i++ ){
                                                ?><option value="<?php echo $i; ?>" <?php selected($i,$button->get_button_height( 'edit' ) ); ?>><?php echo sprintf( __('%d px','angelleye-paypal-wp-button-manager'), $i); ?></option><?php
                                            }
                                    ?></select>
                                     </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-pd">
                                        <label for="wbp-button-label"><?php _e('Button Label','angelleye-paypal-wp-button-manager'); ?></label>
                                        <select name="wbp-button-label" id="wbp-button-label" class="form-control wbp-field">
                                            <option value="paypal" <?php selected('paypal',$button->get_button_label( 'edit' ) ); ?>><?php _e('PayPal', 'angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="checkout" <?php selected('checkout',$button->get_button_label( 'edit' ) ); ?>><?php _e('Checkout','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="buynow" <?php selected('buynow',$button->get_button_label( 'edit' ) ); ?>><?php _e('Buy Now','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="pay" <?php selected('pay',$button->get_button_label( 'edit' ) ); ?>><?php _e('Pay','angelleye-paypal-wp-button-manager'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="wbp-tagline-field">
                                    <div class="form-pd">
                                        <label for="wbp-button-tagline"><?php _e('Enable Tag Line','angelleye-paypal-wp-button-manager'); ?></label>
                                        <select name="wbp-button-tagline" id="wbp-button-tagline" class="form-control wbp-field">
                                            <option value="false" <?php selected('false',$button->get_button_tagline( 'edit' ) ); ?>><?php _e('No', 'angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="true" <?php selected('true',$button->get_button_tagline( 'edit' ) ); ?>><?php _e('Yes','angelleye-paypal-wp-button-manager'); ?></option>
                                        </select>
                                    </div>
                                </div>
                                 <div class="form-group wbp-hide-funding">
                                    <div class="form-pd">
                                        <label for="wbp-button-hide-funding"><?php _e('Hide Funding Methods','angelleye-paypal-wp-button-manager'); ?></label>
                                        <select name="wbp-button-hide-funding[]" id="wbp-button-hide-funding" class="form-control" multiple="multiple">
                                            <option value="card" <?php echo in_array( 'card', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('Credit or Debit Card','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="credit" <?php echo in_array( 'credit', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('PayPal Credit','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="paylater" <?php echo in_array( 'paylater', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('Pay Later','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="bancontact" <?php echo in_array( 'bancontact', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('Bancontact','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="blik" <?php echo in_array( 'blik', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('BLIK','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="eps" <?php echo in_array( 'eps', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('eps','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="giropay" <?php echo in_array( 'giropay', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('giropay','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="ideal" <?php echo in_array( 'ideal', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('iDEAL','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="mercadopago" <?php echo in_array( 'mercadopago', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('Mercado Pago','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="mybank" <?php echo in_array( 'mybank', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('MyBank','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="p24" <?php echo in_array( 'p24', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('Przelewy24','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="sepa" <?php echo in_array( 'sepa', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('SEPA-Lastschrift','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="sofort" <?php echo in_array( 'sofort', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('Sofort','angelleye-paypal-wp-button-manager'); ?></option>
                                            <option value="venmo" <?php echo in_array( 'venmo', $button->get_hide_funding_method() ) ? 'selected="selected"' : ""; ?>><?php _e('Venmo','angelleye-paypal-wp-button-manager'); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="customer-view col-md-6">
                            <div class="form-pd">
                                <p class="btn-text"><?php  _e("Your customer's view", "angelleye-paypal-wp-button-manager"); ?></p>
                                <div class="wbp-form" style="display: none;">
                                    <div class="item-image">
                                        <img id="paypal-buttons-image-preview" src="<?php echo $button->get_image_id() ? wp_get_attachment_url( $button->get_image_id() ) : ''; ?>">
                                    </div>
                                    <div class="item-name-details">
                                        <label class="item-name-label"><?php _e("Item Name:", "angelleye-paypal-wp-button-manager") ?></label>
                                        <p class="item-name"></p>
                                    </div>
                                    
                                    <div class="price-currency">
                                        <div class="price">
                                            <label class="item-price-label"><?php _e("Price: ", "angelleye-paypal-wp-button-manager"); ?></label>
                                            <p class="item-price"></p>
                                        </div>
                                    </div>

                                    <div class="shipping-rate">
                                        <label class="shipping-rate-label"><?php _e("Shipping Rate:", "angelleye-paypal-wp-button-manager"); ?></label>
                                        <p class="shipping"></p>
                                    </div>
                                    <div class="tax-rate">
                                        <label class="tax-rate-label"></label>
                                        <p class="tax-amount"></p>
                                    </div>
                                    <div class="total-amount-details">
                                        <label class="total-amount-label"><?php _e("Total Amount:", "angelleye-paypal-wp-button-manager"); ?></label>
                                        <p class="total-amount"></p>
                                    </div>
                                </div>
                                
                                <iframe id="wbp-paypal-iframe" src="<?php echo get_site_url() . '/angelleye-paypal-button-manager-iframe-preview?layout='. $button->get_button_layout() . '&color=' . $button->get_button_color() . '&shape=' . $button->get_button_shape() . '&size=' . $button->get_button_size() . '&height=' . $button->get_button_height() . '&label=' . $button->get_button_label() . '&tagline=' . $button->get_button_tagline() .'&hide_funding=' . implode(',' , $button->get_hide_funding_method() ); ?>"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>