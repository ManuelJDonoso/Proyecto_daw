<?php
require_once 'models/usuario.php';
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
    <title>crónicas de merida</title>

    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>
    <!-- Encabezado de la pagina web -->
    <header>
        <!-- Menu de banner -->
        <?php include_once 'template/fragment_banner.php' ?>
        <!-- Menu de navegación -->
        <?php include_once 'template/fragment_menu.php' ?>
    </header>
