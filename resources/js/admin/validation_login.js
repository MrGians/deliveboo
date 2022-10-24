if (document.querySelector("form.login_form")) {

    // | 'email' field & box errors
    const emailInput = document.getElementById("email");
    const emailErrorBox = document.getElementById("error_email_box");
    const emailErrorMsg = document.getElementById("error_email_msg");

    // | 'password' field & box errors
    const passwordInput = document.getElementById("password");
    const passwordErrorBox = document.getElementById("error_password_box");
    const passwordErrorMsg = document.getElementById("error_password_msg");

    // # Functions to reset fields & errors
    const resetEmail = () => {
        emailInput.className = "form-control";
        emailErrorBox.classList.add("d-none");
        emailErrorMsg.innerText = "";
    };
   

    // # Functions to reset fields & errors
    const resetPassword = () => {
        passwordInput.className = "form-control";
        passwordErrorBox.classList.add("d-none");
        passwordErrorMsg.innerText = "";
    };

    // # Functions to validate fields
    const validateEmail = () => {
        if (emailInput.validity.valueMissing || emailInput.validity.typeMismatch) {
            emailInput.classList.add("is-invalid");
            emailErrorBox.classList.remove("d-none");
            if (emailInput.validity.typeMismatch) {
                emailErrorMsg.innerText = "Inserire una email valida ";
            } else if (emailInput.validity.valueMissing) {
                emailErrorMsg.innerText = "La email é obbligatoria";
            }
        }
    };

    // # Functions to validate fields
    const validatePassword = () => {
        if (passwordInput.validity.valueMissing || passwordInput.length < 8) {
            passwordInput.classList.add("is-invalid");
            passwordErrorBox.classList.remove("d-none");

            if (passwordInput.validity.valueMissing) {
                passwordErrorMsg.innerText = "La password è obbligatoria";
            } else if (passwordInput.length < 8) {
                passwordErrorMsg.innerText = "La password deve essere di almeno 8 caratteri";
            };
        }
    };

    // # Function to submit Form
    const submitForm = (event) => {
        // Submit for Register Form
            if (emailInput.value && passwordInput.value ) {
                event.submit();
            }
    };

    emailInput.addEventListener("input", () => {
        // Reset
        resetEmail();
        // Validation
        validateEmail();
    });

    passwordInput.addEventListener("input", () => {
        // Reset
        resetPassword();
        // Validation
        validatePassword();
    });

    // Submit Form logic
    window.onsubmit = (event) => {
        // Submit Form Validation
        submitForm(event);

        // Preventing default submit action
        event.preventDefault();

        // Validation email
        validateEmail();

        // Validation password
        validatePassword();
    };
}