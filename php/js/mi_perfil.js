
document.getElementById("guardar").addEventListener("click", function() {
    let formData = new FormData(document.getElementById("userForm"));
    formData.append("guardar", true);

    fetch("requires/editar_usuario.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("mensaje").textContent = data.message;
    });
});

document.getElementById("borrar").addEventListener("click", function() {
    if (confirm('¿Seguro que quieres eliminar este usuario?')) {
        let formData = new FormData(document.getElementById("userForm"));
        formData.append("borrar", true);

        fetch("requires/editar_usuario.php", {
            method: "POST",
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById("mensaje").textContent = data.message;
        });
    }
});
