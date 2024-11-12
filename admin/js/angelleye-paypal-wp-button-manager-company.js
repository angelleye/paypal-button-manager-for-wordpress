(function(d, s, id) {
    var js, ref = d.getElementsByTagName(s)[0];
    if (!d.getElementById(id)) {
        js = d.createElement(s);
        js.id = id;
        js.async = true;
        js.src = "https://www.paypal.com/webapps/merchantboarding/js/lib/lightbox/partner.js";
        ref.parentNode.insertBefore(js, ref);
    }
}(document, "script", "paypal-js"));

jQuery('#paypal-ac-type-cb').on('change',function(){
    var mode = jQuery(this).is(':checked') ? 'sandbox' : 'live';
    jQuery.ajax({
        url: angelleye_company.ajaxurl,
        method: 'GET',
        data: {
            'mode' : mode,
            'action' : 'get_signup_url'
        },
        beforeSend: function(){
            jQuery(".b-btn").removeClass('active');
            jQuery(".b-btn span").toggle();
        },
        success: function(response){
            jQuery(".b-btn").attr('href',response);
        },
        error: function(){
            alert(angelleye_company.error_text);
        },
        complete: function(){
            jQuery(".b-btn").addClass('active');
            jQuery(".b-btn span").toggle();
        }
    });
});