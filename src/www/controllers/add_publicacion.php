<?php
include_once "../models/usuario.php";
session_start();

$usuario= $_SESSION["user"];
require_once '../config/conexion.php'; // Ajusta la ruta según tu estructura




// Verificar si se recibieron los datos del formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tema_id'], $_POST['contenido'])) {
    $tema_id = intval($_POST['tema_id']);
    $contenido = trim($_POST['contenido']);

    // Verificar si el contenido no está vacío
    if (empty($contenido)) {
        die("El contenido no puede estar vacío.");
    }

    // Verificar si el tema permite publicaciones
    $stmt = $pdo->prepare("SELECT permitir_publicaciones FROM temas WHERE id = ?");
    $stmt->execute([$tema_id]);
    $tema = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$tema || !$tema['permitir_publicaciones']) {
        die("Las publicaciones en este tema están cerradas.");
    }

    // Insertar la publicación
    $stmt = $pdo->prepare("INSERT INTO publicaciones (tema_id, usuario_id, contenido, created_at) VALUES (?, ?, ?, NOW())");
    $stmt->execute([$tema_id, $usuario->get_id(), $contenido]);

    // Redirigir al tema después de publicar
    header("Location: ../index.php?pag=forum&tema_id=$tema_id");
    exit;
}

// Si se accede directamente sin POST
die("Solicitud no válida.");
