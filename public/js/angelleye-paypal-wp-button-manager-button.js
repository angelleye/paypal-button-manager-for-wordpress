jQuery(function($){
    $('.wbp-button').each(function(){
        var button_id = $(this).data('button_id');
        var btn_obj = eval( 'btn_obj_' + button_id );
        if( btn_obj.type == 'services' || btn_obj.type == 'subscription' ){
            var buttonConfig = {
                style : {
                    layout: btn_obj.layout,
                    color: btn_obj.color,
                    shape: btn_obj.shape,
                    size: btn_obj.size,
                    label: btn_obj.label,
                    tagline: btn_obj.tagline == 'true' ? true : false
                },
                createOrder: function( data, actions ) {
                    const orderData = JSON.stringify({
                        button_id: button_id
                    });
                    return createOrderCallback( btn_obj, orderData, data);
                },
                onApprove: function( data, actions ) {
                    onApproveCallback( btn_obj, button_id, data, actions);
                },
                onError: function( err, actions ){
                    onErrorCallback( button_id, err );
                }
            };
            if( btn_obj.height ){
                buttonConfig.style.height = parseInt( btn_obj.height );
            }
            paypal.Buttons(buttonConfig).render("#wbp-button-" + button_id );

            var cardConfig = {
                createOrder: function(data, actions) {
                    $(`#card-form-${button_id} #card-field-submit-button span`).toggle();
                    $(`#card-form-${button_id} #card-field-submit-button`).addClass('disable');
                    const billingAddress = {
                        addressLine1: document.getElementById("billing_address_line_1").value,
                        addressLine2: document.getElementById("billing_address_line_2").value,
                        adminArea1: document.getElementById("billing_state").value,
                        adminArea2: document.getElementById("billing_city").value,
                        countryCode: document.getElementById("billing_country").value,
                        postalCode: document.getElementById("billing_postcode").value,
                    };

                    const payerDetails = {
                        first_name: document.getElementById("billing_first_name").value,
                        last_name: document.getElementById("billing_last_name").value,
                        email: document.getElementById("billing_email").value,
                        phone: document.getElementById("billing_phone").value,
                    };

                    let shippingAddress = null;
                    if (!document.getElementById("shipToBillingAddress").checked) {
                        shippingAddress = {
                            line1: document.getElementById("shipping_address_line_1").value,
                            line2: document.getElementById("shipping_address_line_2").value,
                            city: document.getElementById("shipping_city").value,
                            state: document.getElementById("shipping_state").value,
                            country: document.getElementById("shipping_country").value,
                            postal_code: document.getElementById("shipping_postcode").value,
                        };
                    }

                    const orderData = JSON.stringify({
                        button_id: button_id,
                        payer: payerDetails,
                        shipping_address: shippingAddress,
                        billing_address: billingAddress,
                    });
                    return createOrderCallback( btn_obj, orderData, data);
                },
                onApprove: function( data, actions ) {
                    onApproveCallback( btn_obj, button_id, data, actions);
                },
                onError: function( err, actions ){
                    onErrorCallback( button_id, err );
                },
                styles: {
                    'input': {
                        'font-size': '16px',
                        'color': '#3a3a3a'
                    }
                },
            };
            const cardField = window.paypal.CardFields(cardConfig);

            if(cardField.isEligible()){
                const nameField = cardField.NameField({
                    style: {
                        input: {
                            color: "blue"
                        },
                        ".invalid": {
                            color: "purple"
                        }
                    },
                });
                nameField.render("#card-name-field-container"); 

                const numberField = cardField.NumberField({
                    style: {
                        input: {
                            color: "blue"
                        }
                    },
                });
                numberField.render("#card-number-field-container"); 

                const cvvField = cardField.CVVField({
                    style: {
                        input: {
                            color: "blue"
                        }
                    },
                });
                cvvField.render("#card-cvv-field-container"); 

                const expiryField = cardField.ExpiryField({
                    style: {
                        input: {
                            color: "blue"
                        }
                    },
                });
                expiryField.render("#card-expiry-field-container"); 

                document.getElementById("card-field-submit-button").addEventListener("click", (event) => {
                    event.preventDefault();

                    const errorMessages = [];
                    const billingFirstName = document.getElementById("billing_first_name").value.trim();
                    const billingLastName = document.getElementById("billing_last_name").value.trim();
                    const billingEmail = document.getElementById("billing_email").value.trim();
                    const billingPhone = document.getElementById("billing_phone").value.trim();
                    const billingAddress = {
                        addressLine1: document.getElementById("billing_address_line_1").value.trim(),
                        addressLine2: document.getElementById("billing_address_line_2").value.trim(),
                        adminArea1: document.getElementById("billing_city").value.trim(),
                        adminArea2: document.getElementById("billing_state").value.trim(),
                        countryCode: document.getElementById("billing_country").value.trim(),
                        postalCode: document.getElementById("billing_postcode").value.trim(),
                    };

                    if (!billingFirstName) {
                        errorMessages.push(btn_obj.first_name_error);
                    }

                    if (!billingLastName) {
                        errorMessages.push(btn_obj.last_name_error);
                    }

                    if (!billingEmail || !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(billingEmail)) {
                        errorMessages.push(btn_obj.billing_email_error);
                    }

                    if (!billingPhone || !/^\d{10,15}$/.test(billingPhone)) {
                        errorMessages.push(btn_obj.billing_phone_error);
                    }

                    if (!billingAddress.addressLine1) {
                        errorMessages.push(btn_obj.billing_address_1_error);
                    }

                    if (!billingAddress.adminArea1) {
                        errorMessages.push(btn_obj.billing_city_error);
                    }

                    if (!billingAddress.countryCode || billingAddress.countryCode.length !== 2) {
                        errorMessages.push(btn_obj.billing_country_error);
                    }

                    if (!billingAddress.postalCode || !/^\d{5,10}$/.test(billingAddress.postalCode)) {
                        errorMessages.push(btn_obj.billing_post_code_error);
                    }

                    let shippingAddress = {};
                    if (!document.getElementById("shipToBillingAddress").checked) {
                        shippingAddress = {
                            addressLine1: document.getElementById("shipping_address_line_1").value.trim(),
                            addressLine2: document.getElementById("shipping_address_line_2").value.trim(),
                            adminArea1: document.getElementById("shipping_city").value.trim(),
                            adminArea2: document.getElementById("shipping_state").value.trim(),
                            countryCode: document.getElementById("shipping_country").value.trim(),
                            postalCode: document.getElementById("shipping_postcode").value.trim(),
                        };

                        if (!shippingAddress.addressLine1) {
                            errorMessages.push(btn_obj.shipping_address_1_error);
                        }

                        if (!shippingAddress.adminArea1) {
                            errorMessages.push(btn_obj.shipping_city_error);
                        }

                        if (!shippingAddress.countryCode || shippingAddress.countryCode.length !== 2) {
                            errorMessages.push(btn_obj.shipping_country_error);
                        }

                        if (!shippingAddress.postalCode || !/^\d{5,10}$/.test(shippingAddress.postalCode)) {
                            errorMessages.push(btn_obj.shipping_postcode_error);
                        }
                    }

                    if (errorMessages.length > 0) {
                        const errorContainer = document.getElementById(`error-messages-${button_id}`);
                        errorContainer.innerHTML = errorMessages.map(msg => `<p>${msg}</p>`).join("");
                        errorContainer.style.display = "block";
                        return; 
                    }

                    document.getElementById(`error-messages-${button_id}`).style.display = "none";

                    const submitData = {
                        billingAddress: billingAddress,
                        payer: {
                            name: {
                                given_name: billingFirstName,
                                surname: billingLastName,
                            },
                            email_address: billingEmail,
                            phone: {
                                phone_number: {
                                    national_number: billingPhone,
                                },
                            },
                        },
                    };

                    if (!document.getElementById("shipToBillingAddress").checked) {
                        submitData.shippingAddress = shippingAddress;
                    }

                    cardField.submit(submitData).catch((error) => {
                        const errorMessages = {
                            INVALID_NUMBER: btn_obj.invalid_card,
                            INVALID_EXPIRY: btn_obj.invalid_expiry,
                            INVALID_CVV: btn_obj.invalid_cvv,
                            INELIGIBLE_CARD_VENDOR: btn_obj.ineligible_card,
                            INVALID_NAME: btn_obj.invalid_name
                        };

                        const errorCode = error.message || error.code || "UNKNOWN_ERROR";
                        const errorMessage = errorMessages[errorCode] || "An unexpected error occurred. Please try again.";
                        
                        const errorDiv = document.getElementById(`error-messages-${button_id}`);
                        errorDiv.innerHTML = `<p>${errorMessage}</p>`;
                        errorDiv.style.display = "block";
                    });
                });

            } else {
                $("#or-line-" + button_id + ", #card-form-" + button_id ).hide();
            }
        }
    });
});

document.getElementById("billing_country").addEventListener("change", function() {
    var country = this.value;
    var button_id = this.getAttribute("data-id");
    setStates(country,'billing_state',button_id);
});

document.getElementById("shipping_country").addEventListener("change", function() {
    var country = this.value;
    var button_id = this.getAttribute("data-id");
    setStates(country,'shipping_state',button_id);
});

function setStates(country,elementId,button_id){
    var btn_obj = eval( 'btn_obj_' + button_id );
    var xhr = new XMLHttpRequest();
    xhr.open("POST", btn_obj.ajax_url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var billingStateSelect = document.getElementById(elementId);
            
            billingStateSelect.innerHTML = "";
            var option = document.createElement("option");
            option.value = '';
            option.text = btn_obj.please_select;
            billingStateSelect.appendChild(option);

            for (var code in response) {
                var option = document.createElement("option");
                option.value = code;
                option.text = response[code];
                billingStateSelect.appendChild(option);
            }
        }
    };
    
    xhr.send("action=get_state&country=" + encodeURIComponent(country));
}

document.getElementById("shipToBillingAddress").addEventListener("change", function() {
    var shippingAddressForm = document.querySelector(".card-form-address-shipping");
    
    if (this.checked) {
        shippingAddressForm.style.display = "none";
    } else {
        shippingAddressForm.style.display = "block";
    }
});

function createOrderCallback(btn_obj,orderData,data){
    return fetch(btn_obj.api_url, {
        method: 'POST',
        headers: {
            'content-type': 'application/json'
        },
        body: orderData
    }).then(function(response) {
        return response.json();
    }).then(function(data) {
        if( data.orderID ){
            return data.orderID;
        } else {
            if( data.message ){
                throw new Error(data.message);
            } else {
                throw new Error(btn_obj.general_error)
            }
        }
    });
}

function onApproveCallback(btn_obj,button_id,data,actions){
    window.location.href = btn_obj.capture_url + '?paypal_order_id=' + data.orderID + '&button_id=' + button_id;
}

function onErrorCallback(button_id,err){
    jQuery('.angelleye-paypal-wp-button-manager-error').remove();
    jQuery("#form-" + button_id).before('<div class="angelleye-paypal-wp-button-manager-error">' + err + '</div>');
}