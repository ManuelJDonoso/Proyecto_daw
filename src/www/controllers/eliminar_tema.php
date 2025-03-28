<?php
require_once '../config/conexion.php';
session_start();



// Verificar si se recibió el ID del tema a eliminar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tema_id'])) {
    $tema_id = $_POST['tema_id'];

    try {
        $pdo->beginTransaction();

        // Eliminar publicaciones asociadas al tema
        $stmt = $pdo->prepare("DELETE FROM publicaciones WHERE tema_id = ?");
        $stmt->execute([$tema_id]);

        // Eliminar el tema
        $stmt = $pdo->prepare("DELETE FROM temas WHERE id = ?");
        $stmt->execute([$tema_id]);

        $pdo->commit();
        
        header("Location: ../index.php?pag=forum&&categoria_id=".$_POST["categora_id"]); // Redirigir al foro después de eliminar
        exit;
    } catch (Exception $e) {
        $pdo->rollBack();
        die("Error al eliminar el tema: " . $e->getMessage());
    }
} else {
    die("Solicitud inválida");
}
?>
