<?php
session_start();
require_once 'conexion.php'; // Archivo donde se conecta a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger y limpiar datos del formulario
    $nombre_usuario = trim($_POST['usuario']);
    $contraseña = trim($_POST['pass']);

    // Validar que los campos no estén vacíos
    if (empty($nombre_usuario) || empty($contraseña)) {
        die("Todos los campos son obligatorios.");
    }

    try {
        // Buscar el usuario en la base de datos
        $stmt = $pdo->prepare("SELECT id, nombre_usuario, password FROM usuarios WHERE nombre_usuario = ?");
        $stmt->execute([$nombre_usuario]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y la contraseña es correcta
        if ($usuario && password_verify($contraseña, $usuario['password'])) {
            // Guardar datos de sesión
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nombre'] = $usuario['nombre_usuario'];
            echo "Inicio de sesión exitoso.";
        } else {
            echo "Nombre de usuario o contraseña incorrectos.";
        }
    } catch (PDOException $e) {
        die("Error al iniciar sesión: " . $e->getMessage());
    }
}

echo '<meta http-equiv="refresh" content="5;url=../">';
?>
