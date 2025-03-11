<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Index</title>

  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/styles.css" />
  <link rel="stylesheet" href="css/responsive.css" />
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
    <section class="login-box">
      <img src="./assets/images/logo_login.jpg" alt="logo pagina" class="login-box__logo">
      <h1>Crear Cuenta</h1>
      <form action="./requires/crear_cuenta.php" method="post">
        <p>Nombre de usuario</p>
        <input type="text" name="username" placeholder="Introduce tu Nombre de Usuario">
        <p>Nombre</p>
        <input type="text" name="name" placeholder="introduce tu nombre">
        <p>Email</p>
        <input type="email" name="email" placeholder="Introduce tu email">
        <p>Contraseña</p>
        <input type="password" name="pass" placeholder="introduce la contraseña">
        <p>Repite Contraseña</p>
        <input type="password" name="pass_secure" placeholder="introduce la contraseña">

        <input type="submit" value="crear cuenta">
      </form>
    </section>
  </main>

  <!-- Contenido del pie de pagina-->
  <?php include_once './html/fragmento/fragment_footer.php' ?>
  <script src="js/menu_responsive.js"></script>
  <script src="js/accion_menu.js"></script>
  <script src="js/creat_account_form.js"></script>

</body>


</html>
