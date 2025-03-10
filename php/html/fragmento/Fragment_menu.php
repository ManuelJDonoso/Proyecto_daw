<nav class="nav" aria-label="nav menu">
    <div class="nav__toggle" id="menuToggle">☰</div>
    <ul class="nav__list" id="menuList">
        <li class="nav__item">
            <a href="index.html" class="nav__link boton" data-page="inicio.html">Inicio</a>
        </li>
        <li class="nav__item">
            <a href="html/fragmento/acercade.html" class="nav__link" data-page="about.html">Acerca de nosotros</a>
        </li>

        <li class="nav__item nav__item--dropdown">
            <label class="nav__label">Eventos</label>
            <ul class="nav__dropdown">
                <?php
                if (isset($_SESSION["rol"])) {
                    if ($_SESSION["rol"] == "moderador" || $_SESSION["rol"] == "administrador") {
                        echo '<li><a href="html/fragmento/fragment_crear_evento.html" class="nav__link nav__dropdown-link">Crear Evento</a></li>';
                    }
                }

                ?>

                <li><a href="html/fragmento/fragment_eventos.php" class="nav__link nav__dropdown-link">Mostrar Eventos</a></li>
            </ul>
        </li>

        <li class="nav__item">
            <a href="calendar.html" class="nav__link" data-page="calendar.html">Calendario</a>
        </li>
        <li class="nav__item">
            <a href="foro_index.html" class="nav__link" data-page="foro.html">Foro</a>
        </li>


        <?php
        if (isset($_SESSION["rol"])) {
            if ($_SESSION["rol"] == "moderador" || $_SESSION["rol"] == "administrador") {
                echo '<li class="nav__item nav__item--dropdown">
            <label class="nav__label">Gestion de Usuarios</label>
            <ul class="nav__dropdown">';
            }

            if ($_SESSION["rol"] == "administrador") {
                echo '<li><a href="asignar_rol.php" class="nav__label nav__dropdown-link">asignar rol</a></li>';
            }
            if ($_SESSION["rol"] == "moderador" || $_SESSION["rol"] == "administrador") {
                echo ' <li><a href="eliminar_usuario.php" class="nav__label nav__dropdown-link">Eliminar usuario</a></li>';
            }
            if ($_SESSION["rol"] == "moderador" || $_SESSION["rol"] == "administrador") {
                echo '        </ul>
                </li>';
            }
        }

        ?>


        <?php
        if (isset($_SESSION["rol"])) {
            if ($_SESSION["rol"] == "jugador" || $_SESSION["rol"] == "moderador" || $_SESSION["rol"] == "administrador") {
                echo '<li class="nav__item nav__item--dropdown">
            <label class="nav__label">' . $_SESSION["usuario_nombre"] . '</label>
            <ul class="nav__dropdown">';
            }

            echo  "<li> <a href='mi_perfil.php' class='nav__label' data-page='login.html'>Mi perfil</a></li>";
            echo "<li><a href='./requires/logout.php' class='nav__link' data-page='login.html'>Salir</a></li>";

           

            if ($_SESSION["rol"] == "moderador" || $_SESSION["rol"] == "administrador") {
                echo '        </ul>
                </li>';
            }
        } else {

            echo '<li class="nav__item nav__item--dropdown">
            <label class="nav__label">Iniciar sesión / Registrarse</label>
            <ul class="nav__dropdown">';
            echo  "<li> <a href='html/fragmento/fragment_login.html' class='nav__link' data-page='login.html'>Login</a></li>";
            echo  "<li> <a href='creat_account.php' class='nav__label' data-page='login.html'>Crear cuentas</a></li>";
        }

        ?>

    </ul>
</nav>