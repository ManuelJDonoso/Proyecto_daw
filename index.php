<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        $paginas = [
            'login' => 'Login',
            'inicio' => 'Index',
            'about' => 'Acerca de',
            'event' => 'Eventos',
            'calendar' => 'Calendario',
            'sing-up' => 'crear cuenta'
        ];

        echo isset($_GET['pag']) && isset($paginas[$_GET['pag']]) ? $paginas[$_GET['pag']] : '';

        ?>
    </title>


    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="css/footer.css">

    <link rel="stylesheet" href="
     <?php
        $paginas = [
            'login' => 'css/iniciar_sesion.css',
            'inicio' => 'css/index.css',
            'about' => 'css/about.css',
            'event' => 'css/event.css',
            'calendar' => 'css/calendar.css',
            'sing-up' => 'css/iniciar_sesion.css'
        ];

        echo isset($_GET['pag']) && isset($paginas[$_GET['pag']]) ? $paginas[$_GET['pag']] : 'css/styles.css';

        ?>
">
</head>

<body>
    <header>
        <div class="banner">
            <div class="banner-content">
                <h1>Bienvenido a Mi Sitio</h1>

            </div>
        </div>

        <?php
        include_once 'includes/menu.php';
        ?>

    </header>
    <main>

        <?php

        $paginas = [
            'login' => 'includes/inicio_sesion.php',
            'inicio' =>  'includes/index.php',
            'about' =>  'includes/acercade.php',
            'event' =>  'includes/eventos.php',
            'calendar' =>  'includes/calendario.php',
            'sing-up' => 'includes/crear_cuenta.php'
        ];

        if (isset($_GET['pag']) && isset($paginas[$_GET['pag']])) {
            include_once $paginas[$_GET['pag']];
        } else {
            include_once 'includes/error.php';
        }
        ?>

    </main>


    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2025 Mi Sitio Web. Todos los derechos reservados.</p>
            <nav class="footer-nav">
                <a href="#">Política de Privacidad</a>
                <a href="#">Términos y Condiciones</a>
                <a href="#">Contacto</a>
            </nav>
        </div>
    </footer>
    </footer>
</body>

</html>