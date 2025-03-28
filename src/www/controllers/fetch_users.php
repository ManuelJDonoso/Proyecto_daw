<?php
header("Content-Type: application/json");
$pdo = require_once '../config/conexion.php';

try {
    $stmt = $pdo->query("SELECT id, nombre_usuario, nombre, email, rol_id FROM usuarios");
    $users = $stmt->fetchAll();
    echo json_encode($users);
} catch (PDOException $e) {
    echo json_encode(["error" => "Error al obtener los usuarios: " . $e->getMessage()]);
}
