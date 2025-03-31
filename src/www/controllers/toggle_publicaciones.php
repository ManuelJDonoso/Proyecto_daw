<?php
require_once '../config/conexion.php'; // Ajusta la ruta si es necesario
session_start();



// Verificar si se recibió el ID del tema a modificar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tema_id'])) {
    $tema_id = $_POST['tema_id'];

    try {
        // Obtener el estado actual de permitir publicaciones
        $stmt = $pdo->prepare("SELECT permitir_publicaciones FROM temas WHERE id = ?");
        $stmt->execute([$tema_id]);
        $tema = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($tema) {
            // Invertir el estado actual
            $nuevo_estado = $tema['permitir_publicaciones'] ? 0 : 1;

            // Actualizar el estado en la base de datos
            $stmt = $pdo->prepare("UPDATE temas SET permitir_publicaciones = ? WHERE id = ?");
            $stmt->execute([$nuevo_estado, $tema_id]);

            header("Location: ../index.php?pag=forum&&categoria_id=".$_POST["categora_id"]);  // Redirigir al foro
            exit;
        } else {
            die("Tema no encontrado");
        }
    } catch (Exception $e) {
        die("Error al actualizar el estado del tema: " . $e->getMessage());
    }
} else {
    die("Solicitud inválida");
}
?>
