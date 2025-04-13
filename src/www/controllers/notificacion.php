<?php

$mensajes = $pdo->query("SELECT id, nombre_usuario, fecha,mensaje FROM vista_mensaje_help ORDER BY fecha DESC")->fetchAll(PDO::FETCH_ASSOC);
$mensajes2="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mensaje_id=$_POST["mensaje_id"];
    $data = $pdo->query("SELECT usuario_id,mensaje FROM help where id= $mensaje_id")->fetch(PDO::FETCH_ASSOC);
 

    $respuesta=$_POST["respuesta"];
    $destinatario_id=$data["usuario_id"];
    $remitente=$usuario->get_id();
    $mensaje_original=$data["mensaje"];
    switch ($_POST["accion"]) {
        case 'Enviar':
           echo' <br><br><br>';
            var_dump($destinatario_id);var_dump($remitente);var_dump($respuesta);
            $stmt = $pdo->prepare("INSERT INTO notificacion (dirigido_a, de, mensaje,mensaje_original) VALUES (?, ?, ?,?)");
            $stmt->execute([$destinatario_id, $remitente, $respuesta,$mensaje_original  ]);
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
