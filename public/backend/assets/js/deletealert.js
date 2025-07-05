function delete_data(dataId) {
    Swal.fire({
        title: window.localizationTexts.deleteTitle,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: window.localizationTexts.confirmButton,
        cancelButtonText: window.localizationTexts.cancelButton
    }).then((t) => {
        if (t.isConfirmed) {
            event.preventDefault();
            document.getElementById("delete-form-" + dataId).submit();
            Swal.fire({
                title: window.localizationTexts.successMessage,
                icon: "success",
                confirmButtonText: window.localizationTexts.successOkButton
            });
        }
    });
}
