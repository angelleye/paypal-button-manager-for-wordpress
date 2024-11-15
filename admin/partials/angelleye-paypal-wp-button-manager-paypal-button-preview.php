<?php
    $hidden_methods = !empty( $_GET['hide_funding'] ) ? explode(',', $_GET['hide_funding'] ) : array();
    $is_card_hidden = in_array( 'card', $hidden_methods );
?><div id="wbp-paypal-button"></div><?php
if( !$is_card_hidden ){
    ?><div class="or-line"><?php _e('or','angelleye-paypal-wp-button-manager'); ?></div>
    <div id="card-form" class="card_container">
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
            <select id="billing_country" name="billing_country"><?php
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
            <select id="shipping_country" name="shipping_country"><?php
                ?><option value=""><?php _e('Please Select Country','angelleye-paypal-wp-button-manager'); ?></option><?php
                foreach (angelleye_paypal_wp_button_manager_get_countries() as $country_id => $country) {
                    ?><option value="<?php echo $country_id; ?>"><?php echo $country; ?></option><?php
                }
            ?></select>
            <select id="shipping_state" name="shipping_state"><option value=""><?php _e('Please Select State','angelleye-paypal-wp-button-manager'); ?></select>
            <input type="text" id="shipping_postcode" name="shipping_postcode" placeholder="<?php _e('ZIP code','angelleye-paypal-wp-button-manager'); ?>">
        </div>
        <button id="card-field-submit-button" type="button"><?php _e('Pay now with Card','angelleye-paypal-wp-button-manager'); ?></button>
    </div><?php
}
$hide_method = !empty( $_GET['hide_funding'] ) ? '&disable-funding=' . $_GET['hide_funding'] : '';
$options = array(
    'layout' => $_GET['layout'],
    'color' => $_GET['color'],
    'shape' => $_GET['shape'],
    'size' => $_GET['size'],
    'height' => $_GET['height'],
    'label' => $_GET['label'],
    'tagline' => $_GET['tagline']
);
?><script src="https://www.paypal.com/sdk/js?&client-id=<?php echo ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_SANDBOX_PARTNER_CLIENT_ID; ?>&components=buttons,card-fields&enable-funding=credit,venmo,paylater<?php echo $hide_method; ?>"></script>
<script type="text/javascript">
    var paypal_iframe_preview = <?php echo json_encode( $options ); ?>;
    var ajax_url = '<?php echo admin_url('admin-ajax.php'); ?>';
    var please_select = '<?php _e('Please Select State','angelleye-paypal-wp-button-manager'); ?>';
</script>
<script src="<?php echo ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_URL; ?>public/js/angelleye-paypal-wp-button-manager-preview.js"></script>
<style type="text/css">
.or-line {
    text-align: center;
    font-size: 18px;
    color: #5b5b5b;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin: 20px 10px;
}
.or-line:after,
.or-line:before {
    content: '';
    position: relative;
    background: #adadad;
    width: 135px;
    height: 1px;
    display: inline-block;
}
#card-field-submit-button {
    width: 100%;
    padding: 16px;
    font-size: 16px;
    border: none;
    border-radius: 6px;
    margin: 7px 0px;
    background: #ffc439;
    font-weight: 700;
    cursor: pointer;
}
.card-form-address-billing .checkbox input {
    width: 20px;
    height: 20px;
    margin-bottom: 0;
}
.card-form-address-billing .checkbox label {
    color: #666666;
    margin-left: 7px;
}
.card-form-address-billing input{
    border: 0.0625rem solid #909697;
    border-radius: 0.25rem;
    box-sizing: border-box;
    background: #ffffff;
    font-family: inherit;
    font-size: 1.125rem;
    line-height: 1.5rem;
    padding: 1.25rem 0.75rem;
    width: 100%;
    margin-bottom: 10px;
}
.card-form-address-billing .d-flex{
    display: flex;
    gap: 10px; 
}
.card-form-address-billing {
    padding: 0px 6px;
}
.card-form-address-billing .checkbox {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}
.card-form-address-billing select {
    width: 100%;
    padding: 18px 14px;
    margin-bottom: 10px;
    border: 0.0625rem solid #909697;
    border-radius: 0.25rem;
}
label.b-address-heading {
    font-size: 18px;
    margin: 10px 0px;
    display: block;
}
</style>