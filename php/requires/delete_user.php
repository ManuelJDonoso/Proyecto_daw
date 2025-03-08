<?php
header('Content-Type: application/json');

// Incluir la conexión a la base de datos
$pdo = require 'conexion.php';

// Verificar si se recibió el ID
$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['id'])) {
    echo json_encode(["success" => false, "message" => "ID de usuario no proporcionado"]);
    exit;
}

$userId = $data['id'];

// Eliminar usuario
try {
    $stmt = $pdo->prepare("DELETE FROM usuarios WHERE id = :id");
    $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo json_encode(["success" => true, "message" => "Usuario eliminado correctamente"]);
    } else {
        echo json_encode(["success" => false, "message" => "Usuario no encontrado"]);
    }
} catch (PDOException $e) {
    echo json_encode(["success" => false, "message" => "Error al eliminar usuario: " . $e->getMessage()]);
}
