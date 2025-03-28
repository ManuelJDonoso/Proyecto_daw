<?php
require_once "../models/usuario.php";
session_start();

$usuario = $_SESSION["user"] ?? null;

require_once '../config/conexion.php'; // Archivo de conexión a la base de datos


// Verificar si el usuario está autenticado
if (!$usuario) {
    die("Acceso denegado. Debes iniciar sesión para crear un tema.");
}

$categoria_id = $_POST['categoria_id'] ?? null;
$titulo_tema = trim($_POST['titulo_tema'] ?? '');
$contenido=trim($_POST['contenido']);

// Validar entrada
if (!$categoria_id || empty($titulo_tema)) {
    die("Error: Falta la categoría o el título del tema.");
}

// Verificar si la categoría permite la creación de temas
$stmt = $pdo->prepare("SELECT permitir_crear_temas FROM categorias WHERE id = ?");
$stmt->execute([$categoria_id]);
$categoria = $stmt->fetch();

if (!$categoria || !$categoria['permitir_crear_temas']) {
    die("No está permitido crear temas en esta categoría.");
}

// Insertar el nuevo tema en la base de datos
$stmt = $pdo->prepare("INSERT INTO temas (categoria_id, titulo,contenido, usuario_id, created_at) VALUES (?, ?, ?, ?, NOW())");
$stmt->execute([$categoria_id, $titulo_tema,$contenido, $usuario->get_id()]);

// Redirigir de nuevo a la página principal con la categoría seleccionada
header("Location: ../index.php?pag=forum&&categoria_id=$categoria_id");
exit;
