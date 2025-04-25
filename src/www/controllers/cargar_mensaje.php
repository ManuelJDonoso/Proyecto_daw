<?php
require_once __DIR__."/../config/conexion.php";

header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$id = $_GET['id'] ?? 0;
$procesado = $_GET['procesado'] ?? 0;

if($id != 0 && $procesado == 0){
    $stmt = $pdo->prepare("SELECT mensaje,nombre_usuario FROM vista_mensaje_help WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        'mensaje' => (string) $row["mensaje"],
        'nombre_usuario' => (string) $row["nombre_usuario"]
    ]);
}
elseif($id != 0 && $procesado == 2){
    $stmt = $pdo->prepare("SELECT mensaje,mensaje_original,dirigido_a_nombre,de_nombre FROM vista_notificacion_procesando_finalizado WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $mensaje = str_replace(["\r\n", "\r", "\n"], "<br><br>", $row["mensaje"]);
        $mensaje_original = str_replace(["\r\n", "\r", "\n"], "<br><br>", $row["mensaje_original"]);

        echo json_encode([
            'mensaje' => $mensaje,
            'mensaje_original' => $mensaje_original,
            'de_nombre' => (string) $row["de_nombre"],
            'dirigido_a_nombre' => (string) $row["dirigido_a_nombre"],
        ]);
    } else {
        echo json_encode(['error' => 'No se encontró la notificación.']);
    }
}
elseif($id != 0 && $procesado != 0){
    $stmt = $pdo->prepare("SELECT mensaje,mensaje_original,dirigido_a_nombre,de_nombre FROM vista_notificacion_procesando WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $mensaje = str_replace(["\r\n", "\r", "\n"], "<br><br>", $row["mensaje"]);
    $mensaje_original = str_replace(["\r\n", "\r", "\n"], "<br><br>", $row["mensaje_original"]);

    echo json_encode([
        'mensaje' => $mensaje,
        'mensaje_original' => $mensaje_original,
        'de_nombre' => (string) $row["de_nombre"],
        'dirigido_a_nombre' => (string) $row["dirigido_a_nombre"],
    ]);
}
