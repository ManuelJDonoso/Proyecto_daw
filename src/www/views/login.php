<section class="login-box">
    <img
      src="./assets/images/logo_login.jpg"
      alt="logo pagina"
      class="login-box__logo"
    />
    <h1>Iniciar Sesión</h1>
    <form action="./controllers/login.php" method="post">
      <p>Nombre de usuario</p>
      <input
        type="text"
        name="usuario"
        placeholder="Introduce tu Nombre de Usuario"
      />
      <p>Contraseña</p>
      <input
        type="password"
        name="pass"
        placeholder="introduce la contraseña"
      />
      <input type="submit" value="Ingresar" />
      <a href="?pag=recuperar">Contraseña olvidada</a>
      <a class="btn_go_Creat_acount" data-page="login.html" href="?pag=creat_account" >Crear Cuenta</a>
    </form>
  </section>
