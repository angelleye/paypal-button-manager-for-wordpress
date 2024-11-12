<div class="paypal-ac-wordpress">
    <div class="paypal-wp-manager">
        <div class="paypal-wp-manager-left">
            <div class="paypal-wp-l-logo-details">
                <img width="159" height="188" src="<?php echo ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_IMAGE_PATH . 'logo.png'; ?>">
                <div class="paypal-wp-l-details">
                    <div class="paypal-ac-heading"><?php _e('Welcome to the PayPal Commerce Button Manager','angelleye-paypal-wp-button-manager'); ?></div>
                    <p><?php _e('Boost average order totals and conversion rates with PayPal Checkout, PayPal Credit, Buy Now Pay Later, Venmo, and more!','angelleye-paypal-wp-button-manager'); ?></p>
                    <p><?php _e('All for a total fee of only 3.59% + 49¢','angelleye-paypal-wp-button-manager'); ?></p>
                    <p><?php _e('Save money on Visa/MasterCard/Discover transactions with a total fee of only 2.69% + 49¢','angelleye-paypal-wp-button-manager'); ?>
                    <div class="paypal-gp">
                        <label class="PayPal-gp-left"><?php _e('PayPal Sandbox:','angelleye-paypal-wp-button-manager'); ?></label>
                        <div class="paypal-ac-checkbox">
                            <div id="paypal-ac-type">
                                <label class="checkbox" for="paypal-ac-type-cb">
                                    <input type="checkbox" name="paypal_sandbox" id="paypal-ac-type-cb" <?php echo isset( $company ) ? 'disabled="disabled"' : ''; ?> <?php echo (isset( $company ) && $company->paypal_mode == 'sandbox') ? 'checked="checked"' : ''; ?>>
                                    <span class="checkmark"></span>
                                    <?php _e('Check this box to enable','angelleye-paypal-wp-button-manager'); ?>
                                </label>
                            </div>
                        </div>
                    </div><?php
                    if( isset( $redirect_url ) && is_wp_error( $redirect_url ) ){
                        ?><span class="signup-url-error"><?php echo $redirect_url->get_error_message(); ?></span><?php
                    } else {
                        ?><a data-paypal-button="true" class="b-btn <?php echo isset( $redirect_url ) ? 'active' : ''; ?>" href="<?php echo isset( $redirect_url ) ? $redirect_url . '&displayMode=minibrowser' : 'javascript:void(0)'; ?>" target="PPFrame">
                            <span class="text"><?php _e('Begin Now','angelleye-paypal-wp-button-manager'); ?></span>
                            <span class="loader" style="display: none;">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid" width="200" height="200" style="shape-rendering: auto; display: block; background: transparent;" xmlns:xlink="http://www.w3.org/1999/xlink"><g><g transform="rotate(0 50 50)"><rect fill="#ffffff" height="12" width="6" ry="6" rx="3" y="24" x="47"><animate repeatCount="indefinite" begin="-0.9166666666666666s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate></rect></g><g transform="rotate(30 50 50)"><rect fill="#ffffff" height="12" width="6" ry="6" rx="3" y="24" x="47"><animate repeatCount="indefinite" begin="-0.8333333333333334s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate></rect></g><g transform="rotate(60 50 50)"><rect fill="#ffffff" height="12" width="6" ry="6" rx="3" y="24" x="47"><animate repeatCount="indefinite" begin="-0.75s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate></rect></g><g transform="rotate(90 50 50)"><rect fill="#ffffff" height="12" width="6" ry="6" rx="3" y="24" x="47"><animate repeatCount="indefinite" begin="-0.6666666666666666s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate></rect></g><g transform="rotate(120 50 50)"><rect fill="#ffffff" height="12" width="6" ry="6" rx="3" y="24" x="47"><animate repeatCount="indefinite" begin="-0.5833333333333334s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate></rect></g><g transform="rotate(150 50 50)"><rect fill="#ffffff" height="12" width="6" ry="6" rx="3" y="24" x="47"><animate repeatCount="indefinite" begin="-0.5s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate></rect></g><g transform="rotate(180 50 50)"><rect fill="#ffffff" height="12" width="6" ry="6" rx="3" y="24" x="47"><animate repeatCount="indefinite" begin="-0.4166666666666667s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate></rect></g><g transform="rotate(210 50 50)"><rect fill="#ffffff" height="12" width="6" ry="6" rx="3" y="24" x="47"><animate repeatCount="indefinite" begin="-0.3333333333333333s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate></rect></g><g transform="rotate(240 50 50)"><rect fill="#ffffff" height="12" width="6" ry="6" rx="3" y="24" x="47"><animate repeatCount="indefinite" begin="-0.25s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate></rect></g><g transform="rotate(270 50 50)"><rect fill="#ffffff" height="12" width="6" ry="6" rx="3" y="24" x="47"><animate repeatCount="indefinite" begin="-0.16666666666666666s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate></rect></g><g transform="rotate(300 50 50)"><rect fill="#ffffff" height="12" width="6" ry="6" rx="3" y="24" x="47"><animate repeatCount="indefinite" begin="-0.08333333333333333s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate></rect></g><g transform="rotate(330 50 50)"><rect fill="#ffffff" height="12" width="6" ry="6" rx="3" y="24" x="47"><animate repeatCount="indefinite" begin="0s" dur="1s" keyTimes="0;1" values="1;0" attributeName="opacity"></animate></rect></g><g></g></g></svg>
                            </span>
                            <img src="<?php echo ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_IMAGE_PATH . 'arrow.png'; ?>">
                        </a><?php
                    }
                ?></div>
            </div>
            <div class="wave-vector-wordpress">
                <img width="164" height="140" src="<?php echo ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_IMAGE_PATH . 'vector-paypal-wordpress.png'; ?>">
            </div>
        </div><?php
        include_once( ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_PATH .'/admin/partials/angelleye-paypal-wp-button-manager-admin-help.php');
    ?></div>
</div>