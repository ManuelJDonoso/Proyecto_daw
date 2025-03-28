<?php
session_start();
require_once '../config/conexion.php'; // Archivo donde se conecta a la BD

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recoger y limpiar datos del formulario
    $nombre_usuario = trim($_POST['username']);
    $nombre = trim($_POST['name']);
    $email = trim($_POST['email']);
    $contraseña = trim($_POST['pass']);

    // Validar que los campos no estén vacíos
    if (empty($nombre_usuario) || empty($nombre) || empty($email) || empty($contraseña)) {
        die("Todos los campos son obligatorios.");
    }

    // Validar email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("El email no tiene un formato válido.");
    }

    try {
        // Verificar si el usuario o el email ya existen
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM usuarios WHERE nombre_usuario = ? OR email = ?");
        $stmt->execute([$nombre_usuario, $email]);
        $existe = $stmt->fetchColumn();

        if ($existe > 0) {
            echo '<meta http-equiv="refresh" content="0;url=../index.php?pag=creat_account_err">';
            
           
        }

        // Hashear la contraseña
        $hash_contraseña = password_hash($contraseña, PASSWORD_BCRYPT);

        // Insertar usuario en la base de datos
        $stmt = $pdo->prepare("INSERT INTO usuarios (nombre_usuario, nombre, email, password) VALUES (?, ?, ?, ?)");
        $stmt->execute([$nombre_usuario, $nombre, $email, $hash_contraseña]);

        // Obtener el ID del usuario recién creado
        $usuario_id = $pdo->lastInsertId();

        // Guardar datos de sesión para iniciar sesión automáticamente
        require_once '../models/usuario.php';
        $_SESSION['user'] = $user=new Jugador( $usuario_id,$nombre_usuario, $nombre,$email);
     
     

        // Redirigir a la página principal o panel de usuario
        
        echo '<meta http-equiv="refresh" content="0;url=../index.php?pag=registro_ok">';
        
    } catch (PDOException $e) {
        die("Error al registrar el usuario: " . $e->getMessage());
    }
}
