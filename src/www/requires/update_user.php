<?php
header("Content-Type: application/json");
$pdo = require_once '../config/conexion.php';

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data["users"])) {
    echo json_encode(["error" => "Datos inválidos"]);
    exit;
}

try {
    $pdo->beginTransaction();
     // Preparar la consulta SQL para actualizar el rol de los usuarios
     $stmt = $pdo->prepare("UPDATE usuarios SET rol_id = :rol WHERE id = :id");

     // Recorrer el array de usuarios y ejecutar la consulta para cada uno
     foreach ($data["users"] as $user) {
         $stmt->execute([
             ":rol" => $user["rol"],
             ":id" => $user["id"]
         ]);
     }
 
     // Confirmar la transacción
     $pdo->commit();
     echo json_encode(["message" => "Cambios guardados correctamente"]);
 } catch (PDOException $e) {
     // Revertir la transacción en caso de error
     $pdo->rollBack();
     echo json_encode(["error" => "Error al actualizar usuarios: " . $e->getMessage()]);
 }
