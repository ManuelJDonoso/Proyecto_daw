<?php
require_once __DIR__."/../models/usuario.php";
session_start();
$usuario=$_SESSION["user"];

require_once __DIR__."/../config/conexion.php";

// Recibir mensaje desde POST
$mensaje = $_POST['mensaje'] ?? '';

if (!empty($mensaje)) {
    $stmt = $pdo->prepare("INSERT INTO help (usuario_id, mensaje) VALUES (:usuario_id, :mensaje)");
    $stmt->execute([
        'usuario_id' => $usuario->get_id(),
        'mensaje' => $mensaje
    ]);
    echo "Mensaje guardado correctamente.";
} else {
    http_response_code(400);
    echo "Mensaje vacío.";
}
