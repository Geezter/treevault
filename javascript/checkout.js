
    // getting data from inputs and sending it to do_checkout.php

    let emailErrCheckout = firstNameErr = lastNameErr = addressErr = zipCodeErr = cityErr = phoneNumErr = "";

    const emailInput = document.getElementById('emailInput');
    const firstNameInput = document.getElementById('firstNameInput');
    const lastNameInput = document.getElementById('lastNameInput');
    const addressInput = document.getElementById('addressInput');
    const zipCodeInput = document.getElementById('zipCodeInput');
    const cityInput = document.getElementById('cityInput');
    const phoneInput = document.getElementById('phoneNumInput');

    const submitCheckoutBtn = document.getElementById('submitBtn');

    const checkoutDiv = document.querySelector('.checkout');

    

    submitCheckoutBtn.addEventListener('click', (e) => {
        e.preventDefault();


        if (!emailInput.value) {
            const invalidFeedbackEmail = document.getElementById('invalidFeedbackEmail');
            emailErrCheckout = "Enter email";
            invalidFeedbackEmail.innerText = emailErrCheckout;
            emailInput.className = 'form-control is-invalid';
        } else {
            emailInput.className = 'form-control';
            emailErrCheckout = ""
            invalidFeedbackEmail.innerText = emailErrCheckout;
        }

        if (!firstNameInput.value) {
            const invalidFeedbackFirstName = document.getElementById('invalidFeedbackFirstName');
            firstNameErr = "Enter first name";
            invalidFeedbackFirstName.innerText = firstNameErr;
            firstNameInput.className = 'form-control is-invalid';
        } else {
            firstNameInput.className = 'form-control';
            firstNameErr = ""
            invalidFeedbackEmail.innerText = firstNameErr;
        }

        if (!lastNameInput.value) {
            const invalidFeedbackLastName = document.getElementById('invalidFeedbackLastName');
            lastNameErr = "Enter last name";
            invalidFeedbackLastName.innerText = lastNameErr;
            lastNameInput.className = 'form-control is-invalid';
        } else {
            lastNameInput.className = 'form-control';
            lastNameErr = ""
            invalidFeedbackLastName.innerText = lastNameErr;
        }

        if (!addressInput.value) {
            const invalidFeedbackAddress = document.getElementById('invalidFeedbackAddress');
            addressErr = "Enter address";
            invalidFeedbackAddress.innerText = addressErr;
            addressInput.className = 'form-control is-invalid';
        } else {
            addressInput.className = 'form-control';
            addressErr = ""
            invalidFeedbackEmail.innerText = addressErr;
        }

        if (!zipCodeInput.value) {
            const invalidFeedbackZipCode = document.getElementById('invalidFeedbackZipCode');
            zipCodeErr = "Enter zip code";
            invalidFeedbackZipCode.innerText = zipCodeErr;
            zipCodeInput.className = 'form-control is-invalid';
        } else {
            zipCodeInput.className = 'form-control';
            zipCodeErr = ""
            invalidFeedbackZipCode.innerText = zipCodeErr;
        }

        if (!cityInput.value) {
            const invalidFeedbackCity = document.getElementById('invalidFeedbackCity');
            cityErr = "Enter city";
            invalidFeedbackCity.innerText = cityErr;
            cityInput.className = 'form-control is-invalid';
        } else {
            cityInput.className = 'form-control';
            cityErr = ""
            invalidFeedbackCity.innerText = cityErr;
        }


        if (!phoneInput.value) {
            const invalidFeedbackPhone = document.getElementById('invalidFeedbackPhone');
            phoneNumErr = "Enter phone number";
            invalidFeedbackPhone.innerText = phoneNumErr;
            phoneInput.className = 'form-control is-invalid';
        } else {
            phoneInput.className = 'form-control';
            phoneNumErr = ""
            invalidFeedbackPhone.innerText = phoneNumErr;
        }

        if (!emailErr && !firstNameErr && !lastNameErr && !addressErr && !zipCodeErr && !cityErr && !phoneErr) {

            fetch('do_checkout.php', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: emailInput.value,
                    firstname: firstNameInput.value,
                    lastname: lastNameInput.value,
                    address: addressInput.value,
                    zipcode: zipCodeInput.value,
                    city: cityInput.value,
                    phone: phoneInput.value
                })
                }).then((response) => {
                    return response.json();
                }).then((myJson) => {
                    checkoutDiv.innerHTML = "<p class='p-3 lead text-center'>Thank you for the order. You have recieved an email confirmation of the purchase.</p>";
                })
        }
})