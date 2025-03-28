<?php
require_once '../config/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $stmt = $pdo->prepare("DELETE FROM eventos WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo "Evento eliminado correctamente.";
    } catch (PDOException $e) {
        echo "Error al eliminar el evento: " . $e->getMessage();
    }
} else {
    echo "Acceso no autorizado.";
}
?>
