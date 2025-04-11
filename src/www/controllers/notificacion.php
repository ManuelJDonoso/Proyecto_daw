<?php

$mensajes = $pdo->query("SELECT id, nombre_usuario, fecha,mensaje FROM vista_mensaje_help ORDER BY fecha DESC")->fetchAll(PDO::FETCH_ASSOC);
$mensajes2="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    var_dump($_POST);
    switch ($_POST["accion"]) {
        case 'Enviar':
            # code...
            break;
        case 'value':
            # code...
            break;
        
        default:
            # code...
            break;
    }
}
?>


<script>
document.addEventListener("DOMContentLoaded", function() {
    function cargarMensaje(id) {
        fetch('controllers/cargar_mensaje.php?id=' + id)
            .then(res => res.json())
            .then(data => {
                document.getElementById('contenido-mensaje').innerHTML =
                    `<p>${data.mensaje}</p>`;
                document.getElementById('mensaje_id').value = id;
            });
    }

    // Hacemos que cargarMensaje sea accesible globalmente
    window.cargarMensaje = cargarMensaje;
});
</script>