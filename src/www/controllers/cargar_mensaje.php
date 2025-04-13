<?php
require_once __DIR__."/../config/conexion.php";

$id = $_GET['id'] ?? 0;
$procesado = $_GET['procesado'] ?? 0;

if($id !=0 && $procesado==0){
$stmt = $pdo->prepare("SELECT mensaje,nombre_usuario FROM vista_mensaje_help WHERE id = ?");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);


echo json_encode([
    'mensaje' => (string) $row["mensaje"],
    'nombre_usuario' => (string) $row["nombre_usuario"]


]);
}

if($id !=0 && $procesado!=0){
    $stmt = $pdo->prepare("SELECT mensaje,mensaje_original,dirigido_a_nombre,de_nombre FROM vista_notificacion_procesando WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    echo json_encode([
        'mensaje' => (string) $row["mensaje"],
        'mensaje_original'=>(string) $row["mensaje_original"],
        'de_nombre'=>(string) $row["de_nombre"],
        'dirigido_a_nombre'=>(string) $row["dirigido_a_nombre"],
    ]);
    }