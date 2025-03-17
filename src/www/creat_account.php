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
  <link rel="stylesheet" href="css/responsive.css" />

  <style>
    .login-box__input,
    .login-box__submit {
      width: 100%;
      padding: 10px;
      margin: 5px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    .login-box__submit {
      background: #007BFF;
      color: white;
      border: none;
      cursor: pointer;
    }

    .login-box__submit:hover {
      background: #0056b3;
    }

    .login-box__terms {
      display: flex;
      align-items: center;
      gap: 10px;
     
    }

    .login-box__terms-content {
      display: none;
      padding: 20px;
      background: #007BFF;
      border: 1px solid #0056b3;
      margin-top: 10px;
    }

    .login-box__terms-content.active {
      display: block;
    }


    .login-box__terms {
  display: flex;
  align-items: center;
  gap: 5px; /* Espacio mínimo entre checkbox y label */
}

.login-box__checkbox {
  width: 16px;
  height: 16px;
  cursor: pointer;
}

.login-box__link {
  text-decoration: none;
  color: #007bff;
  font-size: 14px;
}

    @media (max-width: 600px) {
      .login-box {
        width: 90%;
        padding: 15px;
      }

      .login-box__label,
      .login-box__terms {
        font-size: 14px;
      }

      .login-box__input,
      .login-box__submit {
        padding: 8px;
      }
    }
  </style>


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

        <div class="login-box__terms">
          <input type="checkbox" id="terms-checkbox" class="login-box__checkbox">
          <label for="terms-checkbox"><a href="#" id="terms-link" class="login-box__link">Acepto los términos y condiciones</a></label>
        </div>

        <div id="terms-content" class="login-box__terms-content">

          <?php include_once "html/fragmento/fragment_terminos_y _condiciones.php"; ?>
          
   
        </div>


        <input style="margin-top: 15px;" type="submit" value="crear cuenta">
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
