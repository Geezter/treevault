
    // sending feedback

    let emailErr, phoneErr, messageErr = "";

    const email = document.getElementById('email');
    const phone = document.getElementById('phone');
    const message = document.getElementById('message');
    const submitFeedbackBtn = document.getElementById('submitButton');
    const contactForm = document.getElementById('contact');

    submitFeedbackBtn.addEventListener('click', (e) => {
        e.preventDefault();

        if (!email.value) {
            const invalidFeedbackEmail = document.getElementById('invalidFeedbackEmail');
            emailErr = "Enter email";
            invalidFeedbackEmail.innerText = emailErr;
            email.className = 'form-control is-invalid';
        } else {
            email.className = 'form-control';
            emailErr = ""
            invalidFeedbackEmail.innerText = emailErr;
        }

        if (!phone.value) {
            const invalidFeedbackPhone = document.getElementById('invalidFeedbackPhone');
            phoneErr = "Enter phone number";
            invalidFeedbackPhone.innerText = phoneErr;
            phone.className = 'form-control is-invalid';
        } else {
            phone.className = 'form-control';
            phoneErr = "";
            invalidFeedbackPhone.innerText = phoneErr;
        }

        if (!message.value) {
            const invalidFeedbackEmail = document.getElementById('invalidFeedbackMessage');
            messageErr = "Enter message";
            invalidFeedbackMessage.innerText = messageErr;
            message.className = 'form-control is-invalid';
        } else {
            message.className = 'form-control';
            messageErr = "";
            invalidFeedbackMessage.innerText = messageErr;
        }

        if (!emailErr && !phoneErr && !messageErr) {

            fetch('do_contact.php', {
                        method: 'POST',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            email: email.value,
                            phone: phone.value,
                            message: message.value
                        })
                        }).then((response) => {
                            return response.json();
                        }).then((myJson) => {
                            contactForm.innerHTML = "<p class='lead text-center'>Thank you for the feedback!</p>";
                        })
        }
    })