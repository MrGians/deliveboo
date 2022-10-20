const formsToDelete = document.querySelectorAll(".delete-form");

formsToDelete.forEach((form) => {
    form.addEventListener("submit", (e) => {
        e.preventDefault();

        let target = 'questo';
        let element = "elemento";
        const cls = form.classList;

        switch (true) {
            case cls.contains("delete-product"):
                element = "Prodotto";
                console.log(element);
                break;
            case cls.contains("delete-null"):
                element = "";
                break;
            case cls.contains("delete-null"):
                element = "";
                break;
        }

        const confirmation = confirm(`Vuoi cancellare definitivamente ${target} ${element}? L'azione è irreversibile`);
        if (confirmation) form.submit();
    });
});