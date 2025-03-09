<?php session_start(); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <!-- Encabezado de la pagina web -->
    <header>
             <!-- Menu de banner -->
             <?php include_once './html/fragmento/Fragment_banner.php' ?>
        <!-- Menu de navegación -->
            <?php include_once './html/fragmento/Fragment_menu.php' ?>
    </header>

    <!-- Contenido principal del body-->s

    <main class="main">
        
    <div class="container-gestion">
  <h2 class="title">Asignar rol a usuarios</h2>

  <div class="filters">
    <input
      type="text"
      id="filter-username"
      class="filters__input"
      placeholder="Filtrar por usuario"
    />
    <input
      type="text"
      id="filter-name"
      class="filters__input"
      placeholder="Filtrar por nombre"
    />
    <input
      type="text"
      id="filter-email"
      class="filters__input"
      placeholder="Filtrar por email"
    />
  </div>

  <div class="table-container">
    <table class="user-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Usuario</th>
          <th>Nombre</th>
          <th>Email</th>
          <th>Rol</th>
        </tr>
      </thead>
      <tbody id="user-table-body">
        <!-- Aquí se insertarán las filas con JavaScript -->
      </tbody>
    </table>
  </div>

  <button id="save-button" class="button">Guardar Cambios</button>
</div>

    </main>


    <!-- Contenido del pie de pagina-->
    <?php include_once './html/fragmento/Fragment_footer.php' ?>
</body>

<script src="js/menu_responsive.js"></script>
<script src="js/accion_menu.js"></script>
<script src="js/asignar_rol.js"></script>

</html>