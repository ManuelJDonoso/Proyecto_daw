<?php
require_once '../config/conexion.php';
require_once'../models/usuario.php';

session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"]->get_rol() !== 'administrador') {
    die("Acceso denegado");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['categoria_id'])) {
    $categoria_id = $_POST['categoria_id'];

    // Obtener el estado actual
    $stmt = $pdo->prepare("SELECT permitir_crear_temas FROM categorias WHERE id = ?");
    $stmt->execute([$categoria_id]);
    $estado_actual = $stmt->fetchColumn();

    // Cambiar el estado
    $nuevo_estado = $estado_actual ? 0 : 1;
    $stmt = $pdo->prepare("UPDATE categorias SET permitir_crear_temas = ? WHERE id = ?");
    $stmt->execute([$nuevo_estado, $categoria_id]);

    header("Location: ../index.php?pag=forum");
    exit();
}
?>
