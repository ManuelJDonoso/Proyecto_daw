<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="../css/reset.css" />

  <link rel="stylesheet" href="../css/styles.css">

  <link rel="stylesheet" href="../css/responsive.css">
</head>

<body>
  <header>
    <?php
    include_once "Fragment_banner.php";
    /*include_once "Fragment_menu.php";*/
    ?>
  </header>
  <main class="main">
    <div class="card">
      <img
        src="../assets/images/errorRegistro.jpg"
        alt="img de la tarjeta"
        class="card__image"
        id="preview" />

    </div>
  </main>

  <?php
    include_once "Fragment_footer.php";
  
    ?>
</body>

</html>