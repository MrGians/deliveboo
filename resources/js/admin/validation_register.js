if (document.querySelector("form.register-form")) {
    // | 'name' field & box errors
    const nameInput = document.getElementById("name");
    const nameErrorBox = document.getElementById("name-error-box");
    const nameErrorMsg = document.getElementById("name-error-msg");

    // | 'email' field & box errors
    const emailInput = document.getElementById("email");
    const emailErrorBox = document.getElementById("email-error-box");
    const emailErrorMsg = document.getElementById("email-error-msg");

    // | 'restaurant_name' field & box errors
    const restaurantNameInput = document.getElementById("restaurant_name");
    const restaurantNameErrorBox = document.getElementById(
        "restaurant_name-error-box"
    );
    const restaurantNameErrorMsg = document.getElementById(
        "restaurant_name-error-msg"
    );

    // | 'restaurant_description' field & box errors
    const restaurantDescriptionInput = document.getElementById(
        "restaurant_description"
    );
    const restaurantDescriptionErrorBox = document.getElementById(
        "restaurant_description-error-box"
    );
    const restaurantDescriptionErrorMsg = document.getElementById(
        "restaurant_description-error-msg"
    );

    // | 'categories' field & box errors
    // TODO FIX CATEGORIES
    // const categoriesInput = document.getElementsByClassName("categories");
    // console.log(categoriesInput);
    // const categoriesErrorBox = document.getElementById("categories-error-box");
    // const categoriesErrorMsg = document.getElementById("categories-error-msg");

    // | 'restaurant_logo' field & box errors
    const restaurantLogoInput = document.getElementById("restaurant_logo");
    const restaurantLogoErrorBox = document.getElementById(
        "restaurant_logo-error-box"
    );
    const restaurantLogoErrorMsg = document.getElementById(
        "restaurant_logo-error-msg"
    );

    // | 'restaurant_address' field & box errors
    const restaurantAddressInput =
        document.getElementById("restaurant_address");
    const restaurantAddressErrorBox = document.getElementById(
        "restaurant_address-error-box"
    );
    const restaurantAddressErrorMsg = document.getElementById(
        "restaurant_address-error-msg"
    );

    // | 'p_iva' field & box errors
    const pIvaInput = document.getElementById("p_iva");
    const pIvaErrorBox = document.getElementById("p_iva-error-box");
    const pIvaErrorMsg = document.getElementById("p_iva-error-msg");

    // | 'password' field & box errors
    const passwordInput = document.getElementById("password");
    const passwordErrorBox = document.getElementById("password-error-box");
    const passwordErrorMsg = document.getElementById("password-error-msg");

    // # Functions to reset fields & errors
    const resetName = () => {
        nameInput.className = "mb-3 shadow form-control rounded-pill";
        nameErrorBox.classList.add("d-none");
        nameErrorMsg.innerText = "";
    };

    const resetEmail = () => {
        emailInput.className = "mb-3 shadow form-control rounded-pill";
        emailErrorBox.classList.add("d-none");
        emailErrorMsg.innerText = "";
    };

    const resetRestaurantName = () => {
        restaurantNameInput.className = "mb-3 shadow form-control rounded-pill";
        restaurantNameErrorBox.classList.add("d-none");
        restaurantNameErrorMsg.innerText = "";
    };

    const resetRestaurantDescription = () => {
        restaurantDescriptionInput.className =
            "mb-3 shadow form-control rounded-5";
        restaurantDescriptionErrorBox.classList.add("d-none");
        restaurantDescriptionErrorMsg.innerText = "";
    };

    // const resetCategories = () => {
    //     categoriesInput.className = "accordion mb-3";
    //     categoriesErrorBox.classList.add("d-none");
    //     categoriesErrorMsg.innerText = "";
    // };

    const resetRestaurantLogo = () => {
        restaurantLogoInput.className = "mb-3";
        restaurantLogoErrorBox.classList.add("d-none");
        restaurantLogoErrorMsg.innerText = "";
    };

    const resetRestaurantAddress = () => {
        restaurantAddressInput.className =
            "mb-3 shadow form-control rounded-pill";
        restaurantAddressErrorBox.classList.add("d-none");
        restaurantAddressErrorMsg.innerText = "";
    };

    const resetPIva = () => {
        pIvaInput.className = "mb-3 shadow form-control rounded-pill";
        pIvaErrorBox.classList.add("d-none");
        pIvaErrorMsg.innerText = "";
    };

    const resetPassword = () => {
        passwordInput.className = "mb-3 shadow form-control rounded-pill";
        passwordErrorBox.classList.add("d-none");
        passwordErrorMsg.innerText = "";
    };

    // # Functions to validate fields
    const validateName = () => {
        if (nameInput.validity.valueMissing || nameInput.length > 100) {
            nameInput.classList.add("is-invalid");
            nameErrorBox.classList.remove("d-none");
            if (nameInput.validity.valueMissing) {
                nameErrorMsg.innerText = "Il nome è obbligatorio";
            } else if (nameInput.length > 100) {
                nameErrorMsg.innerText =
                    "Il nome può contenere massimo 100 caratteri";
            }
        }
    };

    const validateEmail = () => {
        if (
            emailInput.validity.valueMissing ||
            emailInput.validity.typeMismatch
        ) {
            emailInput.classList.add("is-invalid");
            emailErrorBox.classList.remove("d-none");
            if (emailInput.validity.valueMissing) {
                emailErrorMsg.innerText = "l'email è obbligatoria";
            } else if (emailInput.validity.typeMismatch) {
                emailErrorMsg.innerText =
                    "l'email deve essere in un formato valido (example@gmail.com)";
            }
        }
    };

    const validateRestaurantName = () => {
        if (restaurantNameInput.validity.valueMissing) {
            restaurantNameInput.classList.add("is-invalid");
            restaurantNameErrorBox.classList.remove("d-none");
            restaurantNameErrorMsg.innerText =
                "Il nome del ristorante è obbligatorio";
        }
    };

    const validateRestaurantDescription = () => {
        if (restaurantDescriptionInput.validity.valueMissing) {
            restaurantDescriptionInput.classList.add("is-invalid");
            restaurantDescriptionErrorBox.classList.remove("d-none");
            restaurantDescriptionErrorMsg.innerText =
                "La descrizione del ristorante è obbligatoria";
        }
    };

    // const validateCategories = () => {
    //     if (categoriesInput.validity.valueMissing) {
    //         categoriesInput.classList.add("is-invalid");
    //         categoriesErrorBox.classList.remove("d-none");
    //         categoriesErrorMsg.innerText =
    //             "La categoria del ristorante è obbligatoria";
    //     }
    // };

    const validateRestaurantLogo = () => {
        const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

        if (
            restaurantLogoInput.validity.valueMissing ||
            !allowedExtensions.exec(restaurantLogoInput.value)
        ) {
            restaurantLogoInput.classList.add("is-invalid");
            restaurantLogoErrorBox.classList.remove("d-none");

            if (restaurantLogoInput.validity.valueMissing) {
                restaurantLogoErrorMsg.innerText =
                    "Il logo del ristorante è obbligatorio";
            } else if (!allowedExtensions.exec(restaurantLogoInput.value)) {
                restaurantLogoErrorMsg.innerText =
                    "Il logo del ristorante deve essere di un'estensione valida (jpeg,jpg,png,svg)";
            }
        }
    };

    const validateRestaurantAddress = () => {
        if (restaurantAddressInput.validity.valueMissing) {
            restaurantAddressInput.classList.add("is-invalid");
            restaurantAddressErrorBox.classList.remove("d-none");
            restaurantAddressErrorMsg.innerText =
                "L'indirizzo del ristorante è obbligatorio";
        }
    };

    const validatePIva = () => {
        if (pIvaInput.validity.valueMissing || pIvaInput.length == 11) {
            pIvaInput.classList.add("is-invalid");
            pIvaErrorBox.classList.remove("d-none");
            if (pIvaInput.validity.valueMissing) {
                pIvaErrorMsg.innerText = "La Partita Iva è obbligatoria";
            } else if (pIvaInput.length == 11) {
                pIvaErrorMsg.innerText =
                    "La Partita Iva deve contenere esattamente 11 caratteri";
            }
        }
    };

    const validatePassword = () => {
        if (passwordInput.validity.valueMissing || passwordInput.length < 8) {
            passwordInput.classList.add("is-invalid");
            passwordErrorBox.classList.remove("d-none");
            if (passwordInput.validity.valueMissing) {
                passwordErrorMsg.innerText = "La password è obbligatoria";
            } else if (passwordInput.length < 8) {
                passwordErrorMsg.innerText =
                    "La password deve contenere almeno 8 caratteri";
            }
        }
    };

    // # Function to submit Form
    const submitForm = (event) => {
        // Submit for Register Form
        if (
            nameInput.value &&
            emailInput.value &&
            restaurantNameInput.value &&
            restaurantDescriptionInput.value &&
            restaurantLogoInput.value &&
            restaurantAddressInput.value &&
            pIvaInput.value &&
            passwordInput.value
        ) {
            event.submit();
        }
    };

    // # Main content | reset + validation for each form field

    nameInput.addEventListener("input", () => {
        // Reset
        resetName();
        // Validation
        validateName();
    });

    emailInput.addEventListener("input", () => {
        // Reset
        resetEmail();
        // Validation
        validateEmail();
    });

    restaurantNameInput.addEventListener("input", () => {
        // Reset
        resetRestaurantName();
        // Validation
        validateRestaurantName();
    });

    restaurantDescriptionInput.addEventListener("input", () => {
        // Reset
        resetRestaurantDescription();
        // Validation
        validateRestaurantDescription();
    });

    // categoriesInput.addEventListener("input", () => {
    //     // Reset
    //     resetCategories();
    //     // Validation
    //     validateCategories();
    // });

    restaurantLogoInput.addEventListener("input", () => {
        // Reset
        resetRestaurantLogo();
        // Validation
        validateRestaurantLogo();
    });

    restaurantAddressInput.addEventListener("input", () => {
        // Reset
        resetRestaurantAddress();
        // Validation
        validateRestaurantAddress();
    });

    pIvaInput.addEventListener("input", () => {
        // Reset
        resetPIva();
        // Validation
        validatePIva();
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

        // Validation name
        validateName();

        // Validation email
        validateEmail();

        // Validation restaurant name
        validateRestaurantName();

        // Validation restaurant description
        validateRestaurantDescription();

        // Validation categories
        // validateCategories();

        // Validation restaurant logo
        validateRestaurantLogo();

        // Validation restaurant address
        validateRestaurantAddress();

        // Validation restaurant P. IVA
        validatePIva();

        // Validation password
        validatePassword();
    };
}
