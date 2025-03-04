<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Index</title>

  <link rel="stylesheet" href="./css/reset.css" />
  <link rel="stylesheet" href="./css/styles.css" />
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
    <?PHP include_once './html/fragmento/Fragment_menu.php'; ?>
    </nav>
  </header>

  <!-- Contenido principal del body-->

  <main class="main">
    <section class="login-box">
      <img src="./assets/images/logo_login.jpg" alt="logo pagina" class="login-box__logo">
      <h1>Crear Cuenta</h1>
      <form action="./requires/crearCuenta.php" method="post">
        <p>Nombre de usuario</p>
        <input type="text" name="username" placeholder="Introduce tu Nombre de Usuario">
        <p>Nombre</p>
        <input type="text" name="name" placeholder="introduce tu nombre">
        <p>Email</p>
        <input type="email" name="email" placeholder="Introduce tu email">
        <p>Contraseña</p>
        <input type="password" name="pass" placeholder="introduce la contraseña">
        <p>Repite Contraseña</p>
        <input type="password" name="pass" placeholder="introduce la contraseña">

        <input type="submit" value="crear cuenta">
      </form>
    </section>
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
