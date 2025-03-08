<?php
header("Content-Type: application/json");
$pdo = require 'conexion.php';

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data["users"])) {
    echo json_encode(["error" => "Datos inválidos"]);
    exit;
}

try {
    $pdo->beginTransaction();
    $stmt = $pdo->prepare("UPDATE usuarios SET rol = :rol WHERE id = :id");

    foreach ($data["users"] as $user) {
        $stmt->execute([
            ":rol" => $user["rol"],
            ":id" => $user["id"]
        ]);
    }

    $pdo->commit();
    echo json_encode(["message" => "Cambios guardados correctamente"]);
} catch (PDOException $e) {
    $pdo->rollBack();
    echo json_encode(["error" => "Error al actualizar usuarios: " . $e->getMessage()]);
}
?>