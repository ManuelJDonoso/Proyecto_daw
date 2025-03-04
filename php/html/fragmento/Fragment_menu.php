<nav class="nav" aria-label="nav menu">

            <div class="nav__toggle" id="menuToggle">☰</div>
            <ul class="nav__list" id="menuList">
                <li class="nav__item">
                    <a href="index.html" class="nav__link boton" data-page="inicio.html">Inicio</a>
                </li>
                <li class="nav__item">
                    <a href="acercade.html" class="nav__link" data-page="about.html">Acerca de nosotros</a>
                </li>
                <li class="nav__item">
                    <a href="eventos.html" class="nav__link" data-page="event.html">Eventos</a>
                </li>
                <li class="nav__item">
                    <a href="calendar.html" class="nav__link" data-page="calendar.html">Calendario</a>
                </li>
                <li class="nav__item">
                    <a href="foro_index.html" class="nav__link" data-page="foro.html">Foro</a>
                </li>

                <?php
                if (empty($_SESSION['usuario_nombre'])) {
                    echo "  <li class='nav__item'>
              <a href='html/fragmento/Fragment_login.html' class='nav__link' data-page='login.html'
                >Login</a
              >
            </li>";
                }else{
                    echo "  <li class='nav__item'>
                    <a href='./requires/logout.php' class='nav__link' data-page='login.html'
                      >Salir</a
                    >
                  </li>";
                }
                ?>

            </ul>
</nav>
