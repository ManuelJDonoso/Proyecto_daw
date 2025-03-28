function toggleLocationField() {
    const mode = document.getElementById("mode").value;
    const locationField = document.getElementById("location");
    locationField.style.display = mode === "presencial" ? "block" : "none";
}

function previewImage(event) {
    const input = event.target;
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function (e) {
            document.getElementById("preview").src = e.target.result;
            document.getElementById("imageReset").value = "0"; // Se ha seleccionado una imagen
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function resetForm() {
    document.getElementById("preview").src = "./assets/images/eventos.jpg"; // Imagen por defecto
    document.getElementById("imageUpload").value = ""; // Reinicia el input file
    document.getElementById("imageReset").value = "1"; // Indica que se ha restablecido la imagen
}