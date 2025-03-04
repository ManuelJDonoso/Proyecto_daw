<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/styles.css" />
</head>

<body>
    <!-- Encabezado de la pagina web -->
    <header>
        <div class="banner">
            <div class="banner__content">
                <h1>Bienvenido a Mi Sitio</h1>
            </div>
        </div>

        <!-- Menu de navegación -->
            <?php 
                include_once './html/fragmento/Fragment_menu.php'
            ?>
    </header>

    <!-- Contenido principal del body-->

    <main class="main">
        <p>Contenido principal aquí...</p>
    </main>

    <!-- Contenido del pie de pagina-->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2025 Mi Sitio Web. Todos los derechos reservados.</p>
            <nav class="footer-nav" aria-label="footer menu">
                <a href="#">Política de Privacidad</a>
                <a href="#">Términos y Condiciones</a>
                <a href="#">Contacto</a>
            </nav>
        </div>
    </footer>
</body>

<script src="js/menu_responsive.js"></script>
<script src="js/accion_menu.js"></script>

</html>