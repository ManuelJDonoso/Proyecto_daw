<div class="card__update">
    <h2 class="card__title">Modificar Usuario</h2>
    <form id="userForm" class="form">
        <input type="hidden" name="id" id="id" class="form__input" value="<?php echo $usuario->get_id(); ?>">
        <label class="form__label">Usuario:</label>
        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form__input" value="<?= $usuario->get_nombre_usuario() ?>" required><br>


        <label class="form__label">Nombre:</label>
        <input type="text" name="nombre" id="nombre" class="form__input" value="<?= $usuario->get_nombre() ?>" required><br>


        <label class="form__label">Email:</label>
        <input type="email" name="email" id="email" class="form__input" value="<?= $usuario->get_email() ?>" required><br>


        <label class="form__label">Contraseña:</label>
        <input type="password" name="password" id="password" class="form__input" required><br>

        <button type="button" id="guardar" class="button button--save">Guardar Cambios</button>
        <button type="button" id="borrar" class="button button--delete">Eliminar Usuario</button>
    </form>
    <p id="mensaje" class="message"></p>
</div>
<script src="js/my_profile.js"></script>
