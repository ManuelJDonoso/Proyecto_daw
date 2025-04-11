<?php
require_once __DIR__."/../config/conexion.php";

$id = $_GET['id'] ?? 0;

$stmt = $pdo->prepare("SELECT mensaje FROM vista_mensaje_help WHERE id = ?");
$stmt->execute([$id]);
$mensaje = $stmt->fetchColumn();

echo json_encode(['mensaje' => $mensaje]);