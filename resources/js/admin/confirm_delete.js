const formsToDelete = document.querySelectorAll(".delete-form");

const customModal = document.getElementById("myModal");
const modalConfirmBtn = document.getElementById("delete-confirm");
const modalBackBtn = document.getElementById("delete-go-back");
const modalContent = document.querySelector("#myModal p");

formsToDelete.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        // switch case to set correct message
        let target = "questo";
        let element = "elemento";
        const cls = form.classList;

        switch (true) {
            case cls.contains("delete-product"):
                element = "Prodotto";
                break;
            case cls.contains("delete-null"):
                element = "";
                break;
            case cls.contains("delete-null"):
                element = "";
                break;
        }

        // Modal message to display
        let modalMessage = `Vuoi cancellare definitivamente ${target} ${element}? L'azione è irreversibile`;
        modalContent.innerText = modalMessage;

        // Show modal
        customModal.style.display = "block";
        // If click confirm, hide modal & submit form
        modalConfirmBtn.addEventListener("click", () => {
            customModal.style.display = "none";
            form.submit();
        });
        // If click go back hide modal
        modalBackBtn.addEventListener("click", () => {
            customModal.style.display = "none";
        });
    });
});
