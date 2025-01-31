document.addEventListener("DOMContentLoaded", function () {
    const deleteButtons = document.querySelectorAll(".delete");

    deleteButtons.forEach((button) => {
        button.addEventListener("click", function (event) {
            event.preventDefault();
            const url = this.getAttribute("data-url");
            if (url) {
                showConfirmationPopup(url);
            } else {
                console.error("No se encontró la URL para eliminar.");
            }
        });
    });
});

function showConfirmationPopup(url) {
    const popup = document.getElementById("delete-popup");
    const confirmButton = document.getElementById("confirm-delete");
    const cancelButton = document.getElementById("cancel-delete");

    popup.style.display = "flex";

    confirmButton.onclick = function () {
        window.location.href = url;
    };

    cancelButton.onclick = function () {
        popup.style.display = "none";
    };
}
