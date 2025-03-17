<?php
require_once 'requires/modelos/usuario.php';
 session_start();

 if (!isset($_SESSION['user']) || !($_SESSION['user'] instanceof Usuario)) {
    $_SESSION['user']=new Visitante();
}

$user = $_SESSION['user'];
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
        <p>Contenido principal aquí...</p>
    </main>

    <!-- Contenido del pie de pagina-->
    <?php include_once './html/fragmento/fragment_footer.php' ?>
    <script src="js/menu_responsive.js"></script>
    <script src="js/accion_menu.js"></script>
    <script src="js/gestion_usuarios.js"></script>

</body>


</html>
