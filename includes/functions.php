<?php
if( !function_exists( 'angelleye_paypal_button_manager_get_price_html') ){
	/**
	 * Provides the HTML of the price
	 * 
	 * @param float price price of the item/button
	 * 
	 * @return string
	 * 
	 * */
	function angelleye_paypal_button_manager_get_price_html( $price, $currency="USD" ){
		$currencies = angelleye_paypal_wp_button_manager_currencies();
		$currency_index = array_search($currency, array_column( $currencies, 'value' ) );
		$currency_symbol = ( $currency_index !== false ) ? $currencies[$currency_index]['title'] : $currency;
		ob_start();
		include(ANGELLEYE_PAYPAL_WP_BUTTON_MANAGER_PLUGIN_PATH . '/public/partials/angelleye-paypal-wp-button-manager-public-price-html.php');
		return ob_get_clean();
	}
}

if( !function_exists( 'angelleye_paypal_wp_button_manager_currencies' ) ) {
	/**
	 * Provides the currencies array
	 * 
	 * @return array
	 * 
	 * */
	function angelleye_paypal_wp_button_manager_currencies(){
		return array(
            array("value" => "USD", "title" => "$"),
            array("value" => "BRL", "title" => "R$"),
            array("value" => "GBP", "title" => "£"),
            array("value" => "AUD", "title" => "$"),
            array("value" => "CZK", "title" => "Kč"),
            array("value" => "DKK", "title" => "DKK"),
            array("value" => "CAD", "title" => "$"),
            array("value" => "EUR", "title" => "€"),
            array("value" => "HKD", "title" => "$"),
            array("value" => "HUF", "title" => "Ft"),
            array("value" => "ILS", "title" => "₪"),
            array("value" => "JPY", "title" => "¥"),
            array("value" => "MXN", "title" => "$"),
            array("value" => "MYR", "title" => "RM"),
            array("value" => "TWD", "title" => "NT$"),
            array("value" => "NZD", "title" => "$"),
            array("value" => "NOK", "title" => "kr"),
            array("value" => "PHP", "title" => "₱"),
            array("value" => "PLN", "title" => "zł"),
            array("value" => "RUB", "title" => "руб."),
            array("value" => "SGD", "title" => "$"),
            array("value" => "SEK", "title" => "kr"),
            array("value" => "CHF", "title" => "CHF"),
            array("value" => "THB", "title" => "฿"),
            array("value" => "TRY", "title" => "₺")
        );
	}
}

if( !function_exists( 'angelleye_paypal_wp_button_manager_delete_old_logs_cron' ) ){
	add_action('wp', 'angelleye_paypal_wp_button_manager_delete_old_logs_cron');
	/**
	 * Setup the cron schedule to delete the log
	 * */
	function angelleye_paypal_wp_button_manager_delete_old_logs_cron() {
	    if (!wp_next_scheduled('angelleye_paypal_wp_button_manager_delete_old_logs_event')) {
	        wp_schedule_event(time(), 'daily', 'angelleye_paypal_wp_button_manager_delete_old_logs_event');
	    }
	}
	add_action('angelleye_paypal_wp_button_manager_delete_old_logs_event', array('PayPal_WP_Button_Manager_Logger', 'delete_old_logs') );
}

if( !function_exists('angelleye_paypal_wp_button_manager_get_countries') ){
	/**
	 * Provides the array of countries
	 * 
	 * @return array
	 * */
	function angelleye_paypal_wp_button_manager_get_countries(){
		return apply_filters('angelleye_paypal_wp_button_manager_get_countries', array(
			'AF' => __( 'Afghanistan', 'angelleye-paypal-wp-button-manager' ),
			'AX' => __( 'Åland Islands', 'angelleye-paypal-wp-button-manager' ),
			'AL' => __( 'Albania', 'angelleye-paypal-wp-button-manager' ),
			'DZ' => __( 'Algeria', 'angelleye-paypal-wp-button-manager' ),
			'AS' => __( 'American Samoa', 'angelleye-paypal-wp-button-manager' ),
			'AD' => __( 'Andorra', 'angelleye-paypal-wp-button-manager' ),
			'AO' => __( 'Angola', 'angelleye-paypal-wp-button-manager' ),
			'AI' => __( 'Anguilla', 'angelleye-paypal-wp-button-manager' ),
			'AQ' => __( 'Antarctica', 'angelleye-paypal-wp-button-manager' ),
			'AG' => __( 'Antigua and Barbuda', 'angelleye-paypal-wp-button-manager' ),
			'AR' => __( 'Argentina', 'angelleye-paypal-wp-button-manager' ),
			'AM' => __( 'Armenia', 'angelleye-paypal-wp-button-manager' ),
			'AW' => __( 'Aruba', 'angelleye-paypal-wp-button-manager' ),
			'AU' => __( 'Australia', 'angelleye-paypal-wp-button-manager' ),
			'AT' => __( 'Austria', 'angelleye-paypal-wp-button-manager' ),
			'AZ' => __( 'Azerbaijan', 'angelleye-paypal-wp-button-manager' ),
			'BS' => __( 'Bahamas', 'angelleye-paypal-wp-button-manager' ),
			'BH' => __( 'Bahrain', 'angelleye-paypal-wp-button-manager' ),
			'BD' => __( 'Bangladesh', 'angelleye-paypal-wp-button-manager' ),
			'BB' => __( 'Barbados', 'angelleye-paypal-wp-button-manager' ),
			'BY' => __( 'Belarus', 'angelleye-paypal-wp-button-manager' ),
			'BE' => __( 'Belgium', 'angelleye-paypal-wp-button-manager' ),
			'PW' => __( 'Belau', 'angelleye-paypal-wp-button-manager' ),
			'BZ' => __( 'Belize', 'angelleye-paypal-wp-button-manager' ),
			'BJ' => __( 'Benin', 'angelleye-paypal-wp-button-manager' ),
			'BM' => __( 'Bermuda', 'angelleye-paypal-wp-button-manager' ),
			'BT' => __( 'Bhutan', 'angelleye-paypal-wp-button-manager' ),
			'BO' => __( 'Bolivia', 'angelleye-paypal-wp-button-manager' ),
			'BQ' => __( 'Bonaire, Saint Eustatius and Saba', 'angelleye-paypal-wp-button-manager' ),
			'BA' => __( 'Bosnia and Herzegovina', 'angelleye-paypal-wp-button-manager' ),
			'BW' => __( 'Botswana', 'angelleye-paypal-wp-button-manager' ),
			'BV' => __( 'Bouvet Island', 'angelleye-paypal-wp-button-manager' ),
			'BR' => __( 'Brazil', 'angelleye-paypal-wp-button-manager' ),
			'IO' => __( 'British Indian Ocean Territory', 'angelleye-paypal-wp-button-manager' ),
			'BN' => __( 'Brunei', 'angelleye-paypal-wp-button-manager' ),
			'BG' => __( 'Bulgaria', 'angelleye-paypal-wp-button-manager' ),
			'BF' => __( 'Burkina Faso', 'angelleye-paypal-wp-button-manager' ),
			'BI' => __( 'Burundi', 'angelleye-paypal-wp-button-manager' ),
			'KH' => __( 'Cambodia', 'angelleye-paypal-wp-button-manager' ),
			'CM' => __( 'Cameroon', 'angelleye-paypal-wp-button-manager' ),
			'CA' => __( 'Canada', 'angelleye-paypal-wp-button-manager' ),
			'CV' => __( 'Cape Verde', 'angelleye-paypal-wp-button-manager' ),
			'KY' => __( 'Cayman Islands', 'angelleye-paypal-wp-button-manager' ),
			'CF' => __( 'Central African Republic', 'angelleye-paypal-wp-button-manager' ),
			'TD' => __( 'Chad', 'angelleye-paypal-wp-button-manager' ),
			'CL' => __( 'Chile', 'angelleye-paypal-wp-button-manager' ),
			'CN' => __( 'China', 'angelleye-paypal-wp-button-manager' ),
			'CX' => __( 'Christmas Island', 'angelleye-paypal-wp-button-manager' ),
			'CC' => __( 'Cocos (Keeling) Islands', 'angelleye-paypal-wp-button-manager' ),
			'CO' => __( 'Colombia', 'angelleye-paypal-wp-button-manager' ),
			'KM' => __( 'Comoros', 'angelleye-paypal-wp-button-manager' ),
			'CG' => __( 'Congo (Brazzaville)', 'angelleye-paypal-wp-button-manager' ),
			'CD' => __( 'Congo (Kinshasa)', 'angelleye-paypal-wp-button-manager' ),
			'CK' => __( 'Cook Islands', 'angelleye-paypal-wp-button-manager' ),
			'CR' => __( 'Costa Rica', 'angelleye-paypal-wp-button-manager' ),
			'HR' => __( 'Croatia', 'angelleye-paypal-wp-button-manager' ),
			'CU' => __( 'Cuba', 'angelleye-paypal-wp-button-manager' ),
			'CW' => __( 'Cura&ccedil;ao', 'angelleye-paypal-wp-button-manager' ),
			'CY' => __( 'Cyprus', 'angelleye-paypal-wp-button-manager' ),
			'CZ' => __( 'Czech Republic', 'angelleye-paypal-wp-button-manager' ),
			'DK' => __( 'Denmark', 'angelleye-paypal-wp-button-manager' ),
			'DJ' => __( 'Djibouti', 'angelleye-paypal-wp-button-manager' ),
			'DM' => __( 'Dominica', 'angelleye-paypal-wp-button-manager' ),
			'DO' => __( 'Dominican Republic', 'angelleye-paypal-wp-button-manager' ),
			'EC' => __( 'Ecuador', 'angelleye-paypal-wp-button-manager' ),
			'EG' => __( 'Egypt', 'angelleye-paypal-wp-button-manager' ),
			'SV' => __( 'El Salvador', 'angelleye-paypal-wp-button-manager' ),
			'GQ' => __( 'Equatorial Guinea', 'angelleye-paypal-wp-button-manager' ),
			'ER' => __( 'Eritrea', 'angelleye-paypal-wp-button-manager' ),
			'EE' => __( 'Estonia', 'angelleye-paypal-wp-button-manager' ),
			'ET' => __( 'Ethiopia', 'angelleye-paypal-wp-button-manager' ),
			'FK' => __( 'Falkland Islands', 'angelleye-paypal-wp-button-manager' ),
			'FO' => __( 'Faroe Islands', 'angelleye-paypal-wp-button-manager' ),
			'FJ' => __( 'Fiji', 'angelleye-paypal-wp-button-manager' ),
			'FI' => __( 'Finland', 'angelleye-paypal-wp-button-manager' ),
			'FR' => __( 'France', 'angelleye-paypal-wp-button-manager' ),
			'GF' => __( 'French Guiana', 'angelleye-paypal-wp-button-manager' ),
			'PF' => __( 'French Polynesia', 'angelleye-paypal-wp-button-manager' ),
			'TF' => __( 'French Southern Territories', 'angelleye-paypal-wp-button-manager' ),
			'GA' => __( 'Gabon', 'angelleye-paypal-wp-button-manager' ),
			'GM' => __( 'Gambia', 'angelleye-paypal-wp-button-manager' ),
			'GE' => __( 'Georgia', 'angelleye-paypal-wp-button-manager' ),
			'DE' => __( 'Germany', 'angelleye-paypal-wp-button-manager' ),
			'GH' => __( 'Ghana', 'angelleye-paypal-wp-button-manager' ),
			'GI' => __( 'Gibraltar', 'angelleye-paypal-wp-button-manager' ),
			'GR' => __( 'Greece', 'angelleye-paypal-wp-button-manager' ),
			'GL' => __( 'Greenland', 'angelleye-paypal-wp-button-manager' ),
			'GD' => __( 'Grenada', 'angelleye-paypal-wp-button-manager' ),
			'GP' => __( 'Guadeloupe', 'angelleye-paypal-wp-button-manager' ),
			'GU' => __( 'Guam', 'angelleye-paypal-wp-button-manager' ),
			'GT' => __( 'Guatemala', 'angelleye-paypal-wp-button-manager' ),
			'GG' => __( 'Guernsey', 'angelleye-paypal-wp-button-manager' ),
			'GN' => __( 'Guinea', 'angelleye-paypal-wp-button-manager' ),
			'GW' => __( 'Guinea-Bissau', 'angelleye-paypal-wp-button-manager' ),
			'GY' => __( 'Guyana', 'angelleye-paypal-wp-button-manager' ),
			'HT' => __( 'Haiti', 'angelleye-paypal-wp-button-manager' ),
			'HM' => __( 'Heard Island and McDonald Islands', 'angelleye-paypal-wp-button-manager' ),
			'HN' => __( 'Honduras', 'angelleye-paypal-wp-button-manager' ),
			'HK' => __( 'Hong Kong', 'angelleye-paypal-wp-button-manager' ),
			'HU' => __( 'Hungary', 'angelleye-paypal-wp-button-manager' ),
			'IS' => __( 'Iceland', 'angelleye-paypal-wp-button-manager' ),
			'IN' => __( 'India', 'angelleye-paypal-wp-button-manager' ),
			'ID' => __( 'Indonesia', 'angelleye-paypal-wp-button-manager' ),
			'IR' => __( 'Iran', 'angelleye-paypal-wp-button-manager' ),
			'IQ' => __( 'Iraq', 'angelleye-paypal-wp-button-manager' ),
			'IE' => __( 'Ireland', 'angelleye-paypal-wp-button-manager' ),
			'IM' => __( 'Isle of Man', 'angelleye-paypal-wp-button-manager' ),
			'IL' => __( 'Israel', 'angelleye-paypal-wp-button-manager' ),
			'IT' => __( 'Italy', 'angelleye-paypal-wp-button-manager' ),
			'CI' => __( 'Ivory Coast', 'angelleye-paypal-wp-button-manager' ),
			'JM' => __( 'Jamaica', 'angelleye-paypal-wp-button-manager' ),
			'JP' => __( 'Japan', 'angelleye-paypal-wp-button-manager' ),
			'JE' => __( 'Jersey', 'angelleye-paypal-wp-button-manager' ),
			'JO' => __( 'Jordan', 'angelleye-paypal-wp-button-manager' ),
			'KZ' => __( 'Kazakhstan', 'angelleye-paypal-wp-button-manager' ),
			'KE' => __( 'Kenya', 'angelleye-paypal-wp-button-manager' ),
			'KI' => __( 'Kiribati', 'angelleye-paypal-wp-button-manager' ),
			'KW' => __( 'Kuwait', 'angelleye-paypal-wp-button-manager' ),
			'KG' => __( 'Kyrgyzstan', 'angelleye-paypal-wp-button-manager' ),
			'LA' => __( 'Laos', 'angelleye-paypal-wp-button-manager' ),
			'LV' => __( 'Latvia', 'angelleye-paypal-wp-button-manager' ),
			'LB' => __( 'Lebanon', 'angelleye-paypal-wp-button-manager' ),
			'LS' => __( 'Lesotho', 'angelleye-paypal-wp-button-manager' ),
			'LR' => __( 'Liberia', 'angelleye-paypal-wp-button-manager' ),
			'LY' => __( 'Libya', 'angelleye-paypal-wp-button-manager' ),
			'LI' => __( 'Liechtenstein', 'angelleye-paypal-wp-button-manager' ),
			'LT' => __( 'Lithuania', 'angelleye-paypal-wp-button-manager' ),
			'LU' => __( 'Luxembourg', 'angelleye-paypal-wp-button-manager' ),
			'MO' => __( 'Macao', 'angelleye-paypal-wp-button-manager' ),
			'MK' => __( 'North Macedonia', 'angelleye-paypal-wp-button-manager' ),
			'MG' => __( 'Madagascar', 'angelleye-paypal-wp-button-manager' ),
			'MW' => __( 'Malawi', 'angelleye-paypal-wp-button-manager' ),
			'MY' => __( 'Malaysia', 'angelleye-paypal-wp-button-manager' ),
			'MV' => __( 'Maldives', 'angelleye-paypal-wp-button-manager' ),
			'ML' => __( 'Mali', 'angelleye-paypal-wp-button-manager' ),
			'MT' => __( 'Malta', 'angelleye-paypal-wp-button-manager' ),
			'MH' => __( 'Marshall Islands', 'angelleye-paypal-wp-button-manager' ),
			'MQ' => __( 'Martinique', 'angelleye-paypal-wp-button-manager' ),
			'MR' => __( 'Mauritania', 'angelleye-paypal-wp-button-manager' ),
			'MU' => __( 'Mauritius', 'angelleye-paypal-wp-button-manager' ),
			'YT' => __( 'Mayotte', 'angelleye-paypal-wp-button-manager' ),
			'MX' => __( 'Mexico', 'angelleye-paypal-wp-button-manager' ),
			'FM' => __( 'Micronesia', 'angelleye-paypal-wp-button-manager' ),
			'MD' => __( 'Moldova', 'angelleye-paypal-wp-button-manager' ),
			'MC' => __( 'Monaco', 'angelleye-paypal-wp-button-manager' ),
			'MN' => __( 'Mongolia', 'angelleye-paypal-wp-button-manager' ),
			'ME' => __( 'Montenegro', 'angelleye-paypal-wp-button-manager' ),
			'MS' => __( 'Montserrat', 'angelleye-paypal-wp-button-manager' ),
			'MA' => __( 'Morocco', 'angelleye-paypal-wp-button-manager' ),
			'MZ' => __( 'Mozambique', 'angelleye-paypal-wp-button-manager' ),
			'MM' => __( 'Myanmar', 'angelleye-paypal-wp-button-manager' ),
			'NA' => __( 'Namibia', 'angelleye-paypal-wp-button-manager' ),
			'NR' => __( 'Nauru', 'angelleye-paypal-wp-button-manager' ),
			'NP' => __( 'Nepal', 'angelleye-paypal-wp-button-manager' ),
			'NL' => __( 'Netherlands', 'angelleye-paypal-wp-button-manager' ),
			'NC' => __( 'New Caledonia', 'angelleye-paypal-wp-button-manager' ),
			'NZ' => __( 'New Zealand', 'angelleye-paypal-wp-button-manager' ),
			'NI' => __( 'Nicaragua', 'angelleye-paypal-wp-button-manager' ),
			'NE' => __( 'Niger', 'angelleye-paypal-wp-button-manager' ),
			'NG' => __( 'Nigeria', 'angelleye-paypal-wp-button-manager' ),
			'NU' => __( 'Niue', 'angelleye-paypal-wp-button-manager' ),
			'NF' => __( 'Norfolk Island', 'angelleye-paypal-wp-button-manager' ),
			'MP' => __( 'Northern Mariana Islands', 'angelleye-paypal-wp-button-manager' ),
			'KP' => __( 'North Korea', 'angelleye-paypal-wp-button-manager' ),
			'NO' => __( 'Norway', 'angelleye-paypal-wp-button-manager' ),
			'OM' => __( 'Oman', 'angelleye-paypal-wp-button-manager' ),
			'PK' => __( 'Pakistan', 'angelleye-paypal-wp-button-manager' ),
			'PS' => __( 'Palestinian Territory', 'angelleye-paypal-wp-button-manager' ),
			'PA' => __( 'Panama', 'angelleye-paypal-wp-button-manager' ),
			'PG' => __( 'Papua New Guinea', 'angelleye-paypal-wp-button-manager' ),
			'PY' => __( 'Paraguay', 'angelleye-paypal-wp-button-manager' ),
			'PE' => __( 'Peru', 'angelleye-paypal-wp-button-manager' ),
			'PH' => __( 'Philippines', 'angelleye-paypal-wp-button-manager' ),
			'PN' => __( 'Pitcairn', 'angelleye-paypal-wp-button-manager' ),
			'PL' => __( 'Poland', 'angelleye-paypal-wp-button-manager' ),
			'PT' => __( 'Portugal', 'angelleye-paypal-wp-button-manager' ),
			'PR' => __( 'Puerto Rico', 'angelleye-paypal-wp-button-manager' ),
			'QA' => __( 'Qatar', 'angelleye-paypal-wp-button-manager' ),
			'RE' => __( 'Reunion', 'angelleye-paypal-wp-button-manager' ),
			'RO' => __( 'Romania', 'angelleye-paypal-wp-button-manager' ),
			'RU' => __( 'Russia', 'angelleye-paypal-wp-button-manager' ),
			'RW' => __( 'Rwanda', 'angelleye-paypal-wp-button-manager' ),
			'BL' => __( 'Saint Barth&eacute;lemy', 'angelleye-paypal-wp-button-manager' ),
			'SH' => __( 'Saint Helena', 'angelleye-paypal-wp-button-manager' ),
			'KN' => __( 'Saint Kitts and Nevis', 'angelleye-paypal-wp-button-manager' ),
			'LC' => __( 'Saint Lucia', 'angelleye-paypal-wp-button-manager' ),
			'MF' => __( 'Saint Martin (French part)', 'angelleye-paypal-wp-button-manager' ),
			'SX' => __( 'Saint Martin (Dutch part)', 'angelleye-paypal-wp-button-manager' ),
			'PM' => __( 'Saint Pierre and Miquelon', 'angelleye-paypal-wp-button-manager' ),
			'VC' => __( 'Saint Vincent and the Grenadines', 'angelleye-paypal-wp-button-manager' ),
			'SM' => __( 'San Marino', 'angelleye-paypal-wp-button-manager' ),
			'ST' => __( 'S&atilde;o Tom&eacute; and Pr&iacute;ncipe', 'angelleye-paypal-wp-button-manager' ),
			'SA' => __( 'Saudi Arabia', 'angelleye-paypal-wp-button-manager' ),
			'SN' => __( 'Senegal', 'angelleye-paypal-wp-button-manager' ),
			'RS' => __( 'Serbia', 'angelleye-paypal-wp-button-manager' ),
			'SC' => __( 'Seychelles', 'angelleye-paypal-wp-button-manager' ),
			'SL' => __( 'Sierra Leone', 'angelleye-paypal-wp-button-manager' ),
			'SG' => __( 'Singapore', 'angelleye-paypal-wp-button-manager' ),
			'SK' => __( 'Slovakia', 'angelleye-paypal-wp-button-manager' ),
			'SI' => __( 'Slovenia', 'angelleye-paypal-wp-button-manager' ),
			'SB' => __( 'Solomon Islands', 'angelleye-paypal-wp-button-manager' ),
			'SO' => __( 'Somalia', 'angelleye-paypal-wp-button-manager' ),
			'ZA' => __( 'South Africa', 'angelleye-paypal-wp-button-manager' ),
			'GS' => __( 'South Georgia/Sandwich Islands', 'angelleye-paypal-wp-button-manager' ),
			'KR' => __( 'South Korea', 'angelleye-paypal-wp-button-manager' ),
			'SS' => __( 'South Sudan', 'angelleye-paypal-wp-button-manager' ),
			'ES' => __( 'Spain', 'angelleye-paypal-wp-button-manager' ),
			'LK' => __( 'Sri Lanka', 'angelleye-paypal-wp-button-manager' ),
			'SD' => __( 'Sudan', 'angelleye-paypal-wp-button-manager' ),
			'SR' => __( 'Suriname', 'angelleye-paypal-wp-button-manager' ),
			'SJ' => __( 'Svalbard and Jan Mayen', 'angelleye-paypal-wp-button-manager' ),
			'SZ' => __( 'Eswatini', 'angelleye-paypal-wp-button-manager' ),
			'SE' => __( 'Sweden', 'angelleye-paypal-wp-button-manager' ),
			'CH' => __( 'Switzerland', 'angelleye-paypal-wp-button-manager' ),
			'SY' => __( 'Syria', 'angelleye-paypal-wp-button-manager' ),
			'TW' => __( 'Taiwan', 'angelleye-paypal-wp-button-manager' ),
			'TJ' => __( 'Tajikistan', 'angelleye-paypal-wp-button-manager' ),
			'TZ' => __( 'Tanzania', 'angelleye-paypal-wp-button-manager' ),
			'TH' => __( 'Thailand', 'angelleye-paypal-wp-button-manager' ),
			'TL' => __( 'Timor-Leste', 'angelleye-paypal-wp-button-manager' ),
			'TG' => __( 'Togo', 'angelleye-paypal-wp-button-manager' ),
			'TK' => __( 'Tokelau', 'angelleye-paypal-wp-button-manager' ),
			'TO' => __( 'Tonga', 'angelleye-paypal-wp-button-manager' ),
			'TT' => __( 'Trinidad and Tobago', 'angelleye-paypal-wp-button-manager' ),
			'TN' => __( 'Tunisia', 'angelleye-paypal-wp-button-manager' ),
			'TR' => __( 'Turkey', 'angelleye-paypal-wp-button-manager' ),
			'TM' => __( 'Turkmenistan', 'angelleye-paypal-wp-button-manager' ),
			'TC' => __( 'Turks and Caicos Islands', 'angelleye-paypal-wp-button-manager' ),
			'TV' => __( 'Tuvalu', 'angelleye-paypal-wp-button-manager' ),
			'UG' => __( 'Uganda', 'angelleye-paypal-wp-button-manager' ),
			'UA' => __( 'Ukraine', 'angelleye-paypal-wp-button-manager' ),
			'AE' => __( 'United Arab Emirates', 'angelleye-paypal-wp-button-manager' ),
			'GB' => __( 'United Kingdom (UK)', 'angelleye-paypal-wp-button-manager' ),
			'US' => __( 'United States (US)', 'angelleye-paypal-wp-button-manager' ),
			'UM' => __( 'United States (US) Minor Outlying Islands', 'angelleye-paypal-wp-button-manager' ),
			'UY' => __( 'Uruguay', 'angelleye-paypal-wp-button-manager' ),
			'UZ' => __( 'Uzbekistan', 'angelleye-paypal-wp-button-manager' ),
			'VU' => __( 'Vanuatu', 'angelleye-paypal-wp-button-manager' ),
			'VA' => __( 'Vatican', 'angelleye-paypal-wp-button-manager' ),
			'VE' => __( 'Venezuela', 'angelleye-paypal-wp-button-manager' ),
			'VN' => __( 'Vietnam', 'angelleye-paypal-wp-button-manager' ),
			'VG' => __( 'Virgin Islands (British)', 'angelleye-paypal-wp-button-manager' ),
			'VI' => __( 'Virgin Islands (US)', 'angelleye-paypal-wp-button-manager' ),
			'WF' => __( 'Wallis and Futuna', 'angelleye-paypal-wp-button-manager' ),
			'EH' => __( 'Western Sahara', 'angelleye-paypal-wp-button-manager' ),
			'WS' => __( 'Samoa', 'angelleye-paypal-wp-button-manager' ),
			'YE' => __( 'Yemen', 'angelleye-paypal-wp-button-manager' ),
			'ZM' => __( 'Zambia', 'angelleye-paypal-wp-button-manager' ),
			'ZW' => __( 'Zimbabwe', 'angelleye-paypal-wp-button-manager' ),
		) );
	}
}

if( !function_exists( 'angelleye_paypal_wp_button_manager_format_strings') ){
	/**
	 * Formats the string
	 * 
	 * @param string 	$string 	Unformatted String
	 * 
	 * @return string
	 * 
	 * */
	function angelleye_paypal_wp_button_manager_format_strings( $string ){
		$references = array(
	        'paypal' => 'PayPal',
	        'ppcp' => 'PPCP',
	    );

	    $formattedReferences = array();
	    $words = explode(' ', strtolower($string));
	    foreach ($words as $word) {
	        if (isset($references[$word])) {
	            $formattedReferences[] = $references[$word];
	        } else {
	        	$formattedReferences[] = ucfirst( $word );
	        }
	    }

	    return implode(' ', $formattedReferences);
	}
}