<?php
require_once '../models/usuario.php';
session_start();

if (!isset($_SESSION['user']) || !($_SESSION['user'] instanceof Usuario)) {
    $_SESSION['user'] = new Visitante();
}

$usuario = $_SESSION['user'];

// Incluir el archivo de conexión
require_once '../config/conexion.php';

// Verificar si se enviaron los parámetros necesarios
if (method_exists($usuario, 'inscribir_evento') && $usuario->inscribir_evento()) {
 

    $nombre = trim($usuario->get_nombre_usuario());

    $fk_eventos = $_GET["id"];

    var_dump($nombre);
    echo '<br>';
    var_dump($fk_eventos);
    echo '<br>';
    // Validar que los valores no estén vacíos
    if (empty($nombre) || $fk_eventos <= 0) {
        die("Error: Datos inválidos.");
    }

    // Consulta para insertar un jugador si no existe en ese evento
    $sql = "INSERT INTO jugadores_eventos (nombre, fk_eventos)
                VALUES (:nombre, :fk_eventos)
                ON DUPLICATE KEY UPDATE nombre = nombre";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':fk_eventos', $fk_eventos, PDO::PARAM_INT);

        $stmt->execute();

        echo "Jugador '$nombre' agregado al evento con ID $fk_eventos correctamente.";
    } catch (PDOException $e) {
        echo "Error al agregar jugador: " . $e->getMessage();
    }
} else {
    echo "Error: Faltan parámetros.";
}
?>

<meta http-equiv="refresh" content="0;url=../index.php?pag=event&&id=<?= $_GET['id'] ?>">
