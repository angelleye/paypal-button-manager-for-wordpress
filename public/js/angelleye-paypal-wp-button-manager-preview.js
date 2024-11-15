var buttonConfig = {
    style : {
        layout : paypal_iframe_preview.layout,
        color: paypal_iframe_preview.color,
        shape: paypal_iframe_preview.shape,
        size: paypal_iframe_preview.size,
        label: paypal_iframe_preview.label,
    },
    createOrder: function() {},
    onApprove: function() {}
};

if( paypal_iframe_preview.height ){
    buttonConfig.style.height = parseInt( paypal_iframe_preview.height );
}

if( paypal_iframe_preview.layout != 'vertical' && paypal_iframe_preview.tagline ){
    buttonConfig.style.tagline = paypal_iframe_preview.tagline
}

var paypalButton = null;
function angelleyeRenderButton() {
    if (paypalButton) {
        paypalButton.close();
    }
    
    paypalButton = paypal.Buttons(buttonConfig);
    paypalButton.render('#wbp-paypal-button');

    const cardField = window.paypal.CardFields({
        createOrder: function() {},
        styles: {
            'input': {
                'font-size': '16px',
                'color': '#3a3a3a'
            }
        },
    });

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

        document.getElementById("card-field-submit-button").addEventListener("click", () => {
            cardField.submit({}).then(() => {});
        });
    }
}

document.addEventListener("DOMContentLoaded", function(event) { 
    angelleyeRenderButton();
});

document.getElementById("billing_country").addEventListener("change", function() {
    var country = this.value;
    setStates(country,'billing_state');
});

document.getElementById("shipping_country").addEventListener("change", function() {
    var country = this.value;
    setStates(country,'shipping_state');
});

function setStates(country,elementId){
    var xhr = new XMLHttpRequest();
    xhr.open("POST", ajax_url, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            var billingStateSelect = document.getElementById(elementId);
            
            billingStateSelect.innerHTML = "";
            var option = document.createElement("option");
            option.value = '';
            option.text = please_select;
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
