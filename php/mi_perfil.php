<?php session_start();
require_once 'requires/conexion.php';


?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <!-- Encabezado de la pagina web -->
    <header>
        <!-- Menu de banner -->
        <?php include_once './html/fragmento/fragment_banner.php' ?>
        <!-- Menu de navegación -->
        <?php include_once './html/fragmento/fragment_menu.php' ?>
    </header>

    <!-- Contenido principal del body-->

    <main class="main">
        <link rel="stylesheet" href="css/mi_perfil.css">
        <div class="card__update">
            <h2 class="card__title">Modificar Usuario</h2>
            <form id="userForm" class="form">
                <input type="hidden" name="id" id="id" class="form__input" value="<?php echo $_SESSION['usuario_id']; ?>">
                <label class="form__label">Usuario:</label>
                <input type="text" name="nombre_usuario" id="nombre_usuario" class="form__input" value="<?= $_SESSION['usuario_nombre'] ?>" required><br>


                <label class="form__label">Nombre:</label>
                <input type="text" name="nombre" id="nombre" class="form__input" value="<?= $_SESSION['nombre'] ?>" required><br>


                <label class="form__label">Email:</label>
                <input type="email" name="email" id="email" class="form__input" value="<?= $_SESSION['email'] ?>" required><br>


                <label class="form__label">Contraseña:</label>
                <input type="password" name="password" id="password" class="form__input" required><br>

                <button type="button" id="guardar" class="button button--save">Guardar Cambios</button>
                <button type="button" id="borrar" class="button button--delete">Eliminar Usuario</button>
            </form>
            <p id="mensaje" class="message"></p>
        </div>
       

    </main>

    <!-- Contenido del pie de pagina-->
    <?php include_once './html/fragmento/fragment_footer.php' ?>

    <script src="js/menu_responsive.js"></script>
    <script src="js/accion_menu.js"></script>
    <script src="js/gestion_usuarios.js"></script>
    <script src="js/mi_perfil.js"></script>

</body>


</html>
