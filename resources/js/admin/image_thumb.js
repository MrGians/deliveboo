const placeholder = "http://127.0.0.1:8000/storage/products_image/placeholder.png"

const imageField = document.getElementById('image');
const preview = document.getElementById('thumb');

if(imageField !== null) {
imageField.addEventListener('input', () => {
    if (imageField.files && imageField.files[0]) {
        let reader = new FileReader();

        reader.readAsDataURL(imageField.files[0]);
        reader.onload = event => {
            preview.src = event.target.result;
        }
    } else preview.src = placeholder;
});
};