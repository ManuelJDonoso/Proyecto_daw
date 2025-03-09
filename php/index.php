<?php session_start();?>

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
        <?php include_once './html/fragmento/Fragment_banner.php' ?>
        <!-- Menu de navegación -->
            <?php include_once './html/fragmento/Fragment_menu.php' ?>
    </header>

    <!-- Contenido principal del body-->

    <main class="main">
        <p>Contenido principal aquí...</p>
    </main>

    <!-- Contenido del pie de pagina-->
    <?php include_once './html/fragmento/Fragment_footer.php' ?>
</body>

<script src="js/menu_responsive.js"></script>
<script src="js/accion_menu.js"></script>
<script src="js/gestion_usuarios.js"></script>

</html>
