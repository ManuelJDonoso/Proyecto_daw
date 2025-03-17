<?php
require_once 'conexion.php';

if (isset($_POST['nombre'])) {
    $nombre = trim($_POST['nombre']);

    if (!empty($nombre)) {
        try {
            $sql = "DELETE FROM jugadores_eventos WHERE nombre = :nombre";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                echo "Jugador eliminado correctamente.";
            } else {
                echo "No se encontró el jugador.";
            }
        } catch (PDOException $e) {
            echo "Error al eliminar jugador: " . $e->getMessage();
        }
    } else {
        echo "Error: Nombre inválido.";
    }
} else {
    echo "Error: No se recibió el nombre.";
}
?>
