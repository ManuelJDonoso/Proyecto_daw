<?php
session_start();
$pdo = require 'conexion.php';

header("Content-Type: application/json");

$response = ["error" => true, "mensaje" => "Acción no válida"];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST["id"] ?? null;
    $nombre_usuario = $_POST["nombre_usuario"] ?? null;
    $nombre = $_POST["nombre"] ?? null;
    $email = $_POST["email"] ?? null;
    $password = $_POST["password"] ?? null;
    $accion = $_POST["accion"] ?? "actualizar";

    if ($accion === "actualizar") {
        if (!$id || !$nombre_usuario || !$nombre || !$email) {
            $response["mensaje"] = "Los campos Usuario, Nombre y Email son obligatorios.";
        } else {
            // Verificar si el nombre de usuario ya existe en la base de datos
            $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE nombre_usuario = ? AND id != ?");
            $stmt->execute([$nombre_usuario, $id]);
            if ($stmt->fetch()) {
                $response["mensaje"] = "El nombre de usuario ya está en uso.";
            } else {
                if (!empty($password)) {
                    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                    $sql = "UPDATE usuarios SET nombre_usuario = ?, nombre = ?, email = ?, password = ? WHERE id = ?";
                    $params = [$nombre_usuario, $nombre, $email, $passwordHash, $id];
                } else {
                    $sql = "UPDATE usuarios SET nombre_usuario = ?, nombre = ?, email = ? WHERE id = ?";
                    $params = [$nombre_usuario, $nombre, $email, $id];
                }
                
                $stmt = $pdo->prepare($sql);
                if ($stmt->execute($params)) {
                    $_SESSION["usuario_nombre"] = $nombre_usuario;
                    $_SESSION["nombre"] = $nombre;
                    $_SESSION["email"] = $email;
                    $response = ["error" => false, "mensaje" => "Usuario actualizado correctamente."];
                } else {
                    $response["mensaje"] = "Error al actualizar el usuario.";
                }
            }
        }
    } elseif ($accion === "eliminar") {
        if (!$id) {
            $response["mensaje"] = "ID de usuario no válido.";
        } else {
            $sql = "DELETE FROM usuarios WHERE id = ?";
            $stmt = $pdo->prepare($sql);

            if ($stmt->execute([$id])) {
                session_destroy();
                $response = ["error" => false, "mensaje" => "Usuario eliminado correctamente."];
            } else {
                $response["mensaje"] = "Error al eliminar el usuario.";
            }
        }
    }
}

echo json_encode($response);
