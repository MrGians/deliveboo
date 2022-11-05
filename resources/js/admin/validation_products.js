if (document.querySelector("form.product-form")) {
    // | Edit Form element
    const formEdit = document.getElementById("submit-form-edit");

    // | 'name' field & box errors
    const nameInput = document.getElementById("name");
    const nameErrorBox = document.getElementById("name-error-box");
    const nameErrorMsg = document.getElementById("name-error-msg");

    // | 'description' field & box errors
    const descriptionInput = document.getElementById("description");
    const descriptionErrorBox = document.getElementById(
        "description-error-box"
    );
    const descriptionErrorMsg = document.getElementById(
        "description-error-msg"
    );

    // | 'price' field & box errors
    const priceInput = document.getElementById("price");
    const priceErrorBox = document.getElementById("price-error-box");
    const priceErrorMsg = document.getElementById("price-error-msg");

    // | 'image' field & box errors
    const imageInput = document.getElementById("image");
    const imageErrorBox = document.getElementById("image-error-box");
    const imageErrorMsg = document.getElementById("image-error-msg");

    // # Functions to reset fields & errors
    const resetName = () => {
        nameInput.className = "form-control";
        nameErrorBox.classList.add("d-none");
        nameErrorMsg.innerText = "";
    };

    const resetDescription = () => {
        descriptionInput.className = "form-control";
        descriptionErrorBox.classList.add("d-none");
        descriptionErrorMsg.innerText = "";
    };

    const resetPrice = () => {
        priceInput.className = "form-control";
        priceErrorBox.classList.add("d-none");
        priceErrorMsg.innerText = "";
    };

    const resetImage = () => {
        imageInput.className = "";
        imageErrorBox.classList.add("d-none");
        imageErrorMsg.innerText = "";
    };

    // # Functions to validate fields
    const validateName = () => {
        if (nameInput.validity.valueMissing) {
            nameInput.classList.add("is-invalid");
            nameErrorBox.classList.remove("d-none");
            nameErrorMsg.innerText = "Il nome del prodotto è obbligatorio";
        }
    };

    const validateDescription = () => {
        if (descriptionInput.validity.valueMissing) {
            descriptionInput.classList.add("is-invalid");
            descriptionErrorBox.classList.remove("d-none");
            descriptionErrorMsg.innerText =
                "La descrizione del prodotto è obbligatoria";
        }
    };

    const validatePrice = () => {
        if (
            priceInput.validity.valueMissing ||
            priceInput.validity.badInput ||
            priceInput.validity.rangeUnderflow ||
            priceInput.validity.rangeOverflow ||
            isNaN(priceInput.value)
        ) {
            priceInput.classList.add("is-invalid");
            priceErrorBox.classList.remove("d-none");

            if (priceInput.validity.valueMissing) {
                priceErrorMsg.innerText =
                    "Il prezzo del prodotto è obbligatorio";
            } else if (
                priceInput.validity.badInput ||
                isNaN(priceInput.value)
            ) {
                priceErrorMsg.innerText =
                    "Il prezzo del prodotto deve essere un numero";
            } else if (priceInput.validity.rangeUnderflow) {
                priceErrorMsg.innerText =
                    "Il prezzo del prodotto deve essere almeno '0.01'";
            } else if (priceInput.validity.rangeOverflow) {
                priceErrorMsg.innerText =
                    "Il prezzo del prodotto deve essere massimo '999.99'";
            }
        }
    };

    const validateImage = () => {
        const allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;

        if (
            imageInput.validity.valueMissing ||
            !allowedExtensions.exec(imageInput.value)
        ) {
            imageInput.classList.add("is-invalid");
            imageErrorBox.classList.remove("d-none");

            if (imageInput.validity.valueMissing) {
                imageErrorMsg.innerText =
                    "L'immagine del prodotto è obbligatoria";
            } else if (!allowedExtensions.exec(imageInput.value)) {
                imageErrorMsg.innerText =
                    "L'immagine del prodotto deve essere di un'estensione valida (jpeg,jpg,png,svg)";
            }
        }
    };

    // # Function to submit Form
    const submitForm = (event) => {
        // Submit for Create Form
        if (!formEdit) {
            if (
                nameInput.value &&
                descriptionInput.value &&
                priceInput.value &&
                imageInput.value
            ) {
                event.submit();
            }
        }

        // Submit for Edit Form
        if (nameInput.value && descriptionInput.value && priceInput.value) {
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

    descriptionInput.addEventListener("input", () => {
        // Reset
        resetDescription();
        // Validation
        validateDescription();
    });

    priceInput.addEventListener("input", () => {
        // Reset
        resetPrice();
        // Validation
        validatePrice();
    });

    if (!formEdit) {
        imageInput.addEventListener("input", () => {
            // Reset
            resetImage();
            // Validation
            validateImage();
        });
    }

    // Submit Form logic
    window.onsubmit = (event) => {
        // Submit Form Validation
        submitForm(event);

        // Preventing default submit action
        event.preventDefault();

        // Validation name
        validateName();

        // Validation description
        validateDescription();

        // Validation price
        validatePrice();

        // Validation image
        if (!formEdit) {
            validateImage();
        }
    };
}
