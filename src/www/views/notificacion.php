<?php
require_once __DIR__ . "/../controllers/notificacion.php";



?>

<div class="help-page">

    <div class="help-page__column help-page__column--left">
    <h2>Mensaje nuevos</h2>
        <?php foreach ($mensajes as $msg): ?>
            <div class="help-page__item" onclick="cargarMensaje(<?= $msg['id'] ?>)">
                <strong><?= htmlspecialchars($msg['nombre_usuario']) ?></strong><br>
                <small><?= $msg['fecha'] ?></small>
            </div>
        <?php endforeach; ?>

        <h2>Procesando</h2>
        <?php foreach ($mensajes_procesando as $msg): ?>
            <div class="help-page__item" onclick="cargarMensaje_procesado(<?= $msg['id'] ?>)">
                <strong><?= htmlspecialchars($msg['dirigido_a_nombre']) ?></strong><br>
                <small><?= $msg['fecha'] ?></small>
            </div>
        <?php endforeach; ?>

    </div>

    <div class="help-page__column help-page__column--right">
        <div id="contenido-mensaje" class="help-page__content">
            <p>Selecciona un mensaje de la izquierda.</p>
        </div>


        <?php if($es_admin||$es_moderador): ?>

        <form action="?pag=notificacion" method="POST" class="help-page__form ">
            <input type="hidden" name="mensaje_id" id="mensaje_id">
            <input type="hidden" name="destinatario_id" id="destinatario_id">
            <input type="hidden" name="id_notificacion" id="id_notificacion">
            <textarea name="respuesta" rows="4" class="help-page__textarea" placeholder="Escribe tu respuesta..."></textarea>
            <br>
            <div>
            <input type="submit" name="accion" class="help-page__button help-page__button--enviar" id="help-page__button--enviar" value="Enviar">
            <input type="submit" name="accion" class="help-page__button help-page__button--ampliar" id="help-page__button--ampliar" value="Ampliar">
           
            <input type="submit" name="accion" class="help-page__button help-page__button--finalizar" id="help-page__button--finalizar" value="Finalizar">
            <input type="submit" name="accion" class="help-page__button help-page__button--eliminar" id="help-page__button--eliminar" value="Eliminar">
            
            </div>
          

            
        </form>
        <?php endif ?>
    </div>
</div>
