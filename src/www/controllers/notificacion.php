<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $mensaje_id = $_POST["mensaje_id"];
    $data = $pdo->query("SELECT usuario_id,mensaje,id FROM help where id= $mensaje_id")->fetch(PDO::FETCH_ASSOC);


    $respuesta = $_POST["respuesta"];
    $destinatario_id = $data["usuario_id"];
    $remitente = $usuario->get_id();
    $mensaje_original = $data["mensaje"];
    $mensaje_original_id = $data["id"];

    switch ($_POST["accion"]) {
        case 'Enviar':
            //insertar en notificaciones
            $stmt = $pdo->prepare("INSERT INTO notificacion (dirigido_a, de, mensaje,mensaje_original) VALUES (?, ?, ?,?)");
            $stmt->execute([$destinatario_id, $remitente, $respuesta, $mensaje_original]);

            $stmt = $pdo->prepare("DELETE FROM  help WHERE id = ?");
            $stmt->execute([$mensaje_original_id]);


            break;
        case 'Finalizar':
            # code...
            break;
        
        case 'Eliminar':
            # code...
            break;

        default:
            # code...
            break;
    }
}

if ($es_moderador || $es_admin) {
    $mensajes = $pdo->query("SELECT id, nombre_usuario, fecha,mensaje FROM vista_mensaje_help ORDER BY fecha DESC")->fetchAll(PDO::FETCH_ASSOC);
    $mensajes_procesando = $pdo->query("SELECT id, dirigido_a_id, dirigido_a_nombre, de_id, de_nombre,mensaje_original,fecha,procesando FROM vista_notificacion_procesando ORDER BY fecha DESC")->fetchAll(PDO::FETCH_ASSOC);
} elseif ($es_jugador) {

    $usuario_id = $usuario->get_id();
    $mensajes = $pdo->query("SELECT id, nombre_usuario, fecha,mensaje FROM vista_mensaje_help where usuario_id = $usuario_id ORDER BY fecha DESC")->fetchAll(PDO::FETCH_ASSOC);
    $mensajes_procesando = $pdo->query("SELECT id, dirigido_a_id, dirigido_a_nombre, de_id, de_nombre,mensaje_original,fecha,procesando FROM vista_notificacion_procesando  where dirigido_a_id = $usuario_id ORDER BY fecha DESC")->fetchAll(PDO::FETCH_ASSOC);
} else {
    $mensajes = [];
    $mensajes_procesando = [];
}

?>


<script>
    document.addEventListener("DOMContentLoaded", function() {
        function cargarMensaje(id) {
            fetch('controllers/cargar_mensaje.php?id=' + id)
                .then(res => res.json())
                .then(data => {
                    const contenedor = document.getElementById('contenido-mensaje');
                    const inputId = document.getElementById('mensaje_id');
                    const botonEnviar = document.getElementById('help-page__button--enviar');
                    const botonEliminar = document.getElementById('help-page__button--eliminar');
                    const botonFinalizar = document.getElementById('help-page__button--finalizar');



                    contenedor.innerHTML =
                        `<p><strong>${data.nombre_usuario} :</strong> ${data.mensaje}</p>`;

                    if (inputId != null || botonEnviar != null || botonEliminar != null || botonFinalizar != null) {
                        inputId.value = id;
                        botonEnviar.classList.remove("hidden");
                        botonEliminar.classList.add("hidden");
                        botonFinalizar.classList.add("hidden");
                    }


                });

        }

        // Hacemos que cargarMensaje sea accesible globalmente
        window.cargarMensaje = cargarMensaje;
    });


    document.addEventListener("DOMContentLoaded", function() {

        function cargarMensaje_procesado(id) {
            fetch('controllers/cargar_mensaje.php?id=' + id + '&procesado=1')
                .then(res => res.json())
                .then(data => {
                    const contenedor = document.getElementById('contenido-mensaje');
                    const inputId = document.getElementById('mensaje_id');
                    const botonEnviar = document.getElementById('help-page__button--enviar');
                    const botonEliminar = document.getElementById('help-page__button--eliminar');
                    const botonFinalizar = document.getElementById('help-page__button--finalizar');

                    contenedor.innerHTML =
                        `<p><strong>${data.dirigido_a_nombre} : </strong>${data.mensaje_original}</p>
                     <p><strong>${data.de_nombre} : </strong>${data.mensaje}</p>`;

                    if (inputId != null || botonEnviar != null || botonEliminar != null || botonFinalizar != null) {
                        inputId.value = id;
                        botonEnviar.classList.add("hidden");
                        botonEliminar.classList.add("hidden");
                        botonFinalizar.classList.remove("hidden")
                    }
                });

        }

        // Hacemos que cargarMensaje_procesado sea accesible globalmente
        window.cargarMensaje_procesado = cargarMensaje_procesado;
    });
</script>