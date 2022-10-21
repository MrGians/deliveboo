const nameField = document.getElementById('name');

nameField.addEventListener('input', () => {
    if (nameField.validity.valueMissing) {
        nameField.setCustomValidity('Questo è un campo obbligatorio');
        nameField.reportValidity();
    } else {
        nameField.setCustomValidity('');
    }
});

const descriptionField = document.getElementById('description');

descriptionField.addEventListener('input', () => {
    if (descriptionField.validity.valueMissing) {
        descriptionField.setCustomValidity('Questo è un campo obbligatorio');
        descriptionField.reportValidity();
    } else {
        descriptionField.setCustomValidity('');
    }
});

const priceField = document.getElementById('price');

priceField.addEventListener('input', () => {
    if (priceField.validity.valueMissing) {
        priceField.setCustomValidity('Questo campo è obbligatorio');
        priceField.reportValidity();
    } else if (priceField.validity.badInput) {
        priceField.setCustomValidity('Questo campo deve essere un numero');
        priceField.reportValidity();
    } else {
        priceField.setCustomValidity('');
    }
});

const imageField = document.getElementById('image');

imageField.addEventListener('input', () => {
    if (imageField.validity.valueMissing) {
        imageField.setCustomValidity('Questo campo è obbligatorio, inserisci un file immagine');
        imageField.reportValidity();
    } else {
        imageField.setCustomValidity('');
    }
})