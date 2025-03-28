<?php
require_once '../config/conexion.php';
require_once'../models/usuario.php';

session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"]->get_rol() !== 'administrador') {
    die("Acceso denegado");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoria_id'])) {
    $categoria_id = $_POST['categoria_id'];

    // Eliminar la categoría solo si no tiene temas asociados
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM temas WHERE categoria_id = ?");
    $stmt->execute([$categoria_id]);
    $num_temas = $stmt->fetchColumn();

 

    $stmt = $pdo->prepare("DELETE FROM categorias WHERE id = ?");
    $stmt->execute([$categoria_id]);

    header("Location: ../index.php?pag=forum");
    exit();
}
?>
