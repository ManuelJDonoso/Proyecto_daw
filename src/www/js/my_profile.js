document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("userForm");
    const btnGuardar = document.getElementById("guardar");
    const btnBorrar = document.getElementById("borrar");
    const mensaje = document.getElementById("mensaje");

    btnGuardar.addEventListener("click", function () {
        const formData = new FormData(form);

        fetch("controllers/edit_user.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            mensaje.textContent = data.mensaje;
            mensaje.style.color = data.error ? "red" : "green";
        })
        .catch(error => {
            console.error("Error:", error);
            mensaje.textContent = "Ocurrió un error al procesar la solicitud.";
            mensaje.style.color = "red";
        });
    });

    btnBorrar.addEventListener("click", function () {
        if (!confirm("¿Estás seguro de que deseas eliminar tu cuenta?")) return;

        const formData = new FormData();
        formData.append("id", document.getElementById("id").value);
        formData.append("accion", "eliminar");

        fetch("controllers/edit_user.php", {
            method: "POST",
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            mensaje.textContent = data.mensaje;
            mensaje.style.color = data.error ? "red" : "green";
            if (!data.error) {
                setTimeout(() => {
                    window.location.href = "index.php"; // Redirige tras borrar
                }, 2000);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            mensaje.textContent = "Ocurrió un error al procesar la solicitud.";
            mensaje.style.color = "red";
        });
    });
});
