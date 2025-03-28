<section class="login-box">
    <img src="./assets/images/logo_login.jpg" alt="logo pagina" class="login-box__logo">
    <h1>Crear Cuenta</h1>
    <form action="controllers/creat_account.php" method="post">
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
          <input type="checkbox" id="terms-checkbox" class="login-box__checkbox" >
          <label for="terms-checkbox"><a href="#" id="terms-link" class="login-box__link">Acepto los términos y condiciones</a></label>
        </div>

        <div id="terms-content" class="login-box__terms-content">

          <?php include_once "views/terms_conditions.php"; ?>
          
   
        </div>


        <input style="margin-top: 15px;" type="submit" value="crear cuenta">
    </form>

</section>

<script src="js/creat_account_form.js"></script>
