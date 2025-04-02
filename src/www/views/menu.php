<nav class="menu">
    <div class="menu__toggle" id="menu-toggle">
        <div></div>
        <div></div>
        <div></div>
    </div>
    <ul class="menu__list" id="menu-list">
        <li class="menu__item"><a href="index.php" class="menu__link">Inicio</a></li>
        <li class="menu__item"><a href="?pag=about" class="menu__link">Acerca de nosotros</a></li>
        <li class="menu__item menu__item--has-submenu">
            <a href="#" class="menu__link submenu-toggle">Eventos</a>
            <ul class="submenu">

                <?php
                if ($usuario->get_rol() == "administrador" || $usuario->get_rol() == "moderador") {
                    echo "<li class='submenu__item'><a href='?pag=add_event' class='submenu__link'>Crear evento</a></li>";
                }
                ?>

                <li class="submenu__item"><a href="?pag=show_events" class="submenu__link">Mostrar eventos</a></li>
                <?php if(!$es_visitante):?>
                    <li class="submenu__item"><a href="?pag=show_my_events" class="submenu__link">Mostrar mis eventos</a></li>
                <?php endif ?>

            </ul>
        </li>
        <li class="menu__item"><a href="?pag=calendar" class="menu__link">Calendario</a></li>
        <li class="menu__item menu__item--has-submenu">
            <a href="#" class="menu__link submenu-toggle">Gestión de material</a>
            <ul class="submenu">
                <li class="submenu__item"><a href="?pag=material" class="submenu__link">Material disponible</a></li>
                <?php
                if ($usuario->get_rol() != "visitante") {
                    echo "<li class='submenu__item'><a href='?pag=loan_material' class='submenu__link'>Préstamo de material</a></li>";
                }

                if ($usuario->get_rol() == "moderador" || $usuario->get_rol() == "administrador") {
                    echo "<li class='submenu__item'><a href='?pag=return_material' class='submenu__link'>Devolución del material</a></li>";
                }
                if ($usuario->get_rol() == "administrador") {
                    echo "
                
                <li class='submenu__item'><a href='?pag=upload_material' class='submenu__link'>Alta de material</a></li>
                <li class='submenu__item'><a href='?pag=unsubscribe_material' class='submenu__link'>Baja de material</a></li>";
                }
                ?>

            </ul>
        </li>
        <li class="menu__item"><a href="?pag=forum" class="menu__link">Foro</a></li>


        <?php
        if ($usuario->get_rol() == "administrador" || $usuario->get_rol() == "moderador") {
            echo "   <li class='menu__item menu__item--has-submenu'>
            <a href='#' class='menu__link submenu-toggle'>Gestión de usuario</a>
            <ul class='submenu'>
                <li class='submenu__item'><a href='?pag=assing_role' class='submenu__link'>Asignar rol</a></li>
                <li class='submenu__item'><a href='?pag=delete_user' class='submenu__link'>Eliminar usuario</a></li>
            </ul>
        </li>";
        }


        if ($usuario->get_rol() == "visitante") {
            echo " <li class='menu__item menu__item--has-submenu'>
                <a href='#' class='menu__link submenu-toggle'>Login / Logout</a>
                <ul class='submenu'>
                    <li class='submenu__item'><a href='?pag=login' class='submenu__link'>registrarse</a></li>
                    <li class='submenu__item'><a href='?pag=creat_account' class='submenu__link'>crear cuenta</a></li>
                </ul>
            </li>";
        }


        if ($usuario->get_rol() != "visitante") {
            echo "      <li class='menu__item menu__item--has-submenu'>
                <a href='#' class='menu__link submenu-toggle'>" . $usuario->get_nombre() . "</a>
                <ul class='submenu'>
                    <li class='submenu__item'><a href='?pag=my_profile' class='submenu__link'>Mi Perfil</a></li>
                    <li class='submenu__item'><a href='controllers/logout.php' class='submenu__link'>salir</a></li>
                </ul>
            </li>";
        }

        ?>

    </ul>
</nav>
