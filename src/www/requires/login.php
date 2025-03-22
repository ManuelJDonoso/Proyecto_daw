<?php
require_once '../models/usuario.php';
session_start();
require_once '../config/conexion.php'; // Archivo donde se conecta a la BD


$user;

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
        $stmt = $pdo->prepare("SELECT id, nombre_usuario,nombre,email, password, rol_id FROM usuarios WHERE nombre_usuario = ?");
        $stmt->execute([$nombre_usuario]);
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario existe y la contraseña es correcta
        if ($usuario && password_verify($contraseña, $usuario['password'])) {

            // Guardar datos de sesión

            switch ($usuario['rol_id']) {
                case 1:
                    $user=new Visitante($usuario['id'],$usuario['nombre_usuario'],$usuario['nombre'],$usuario['email']);
                    break;
                case 2:
                    $user=new Jugador($usuario['id'],$usuario['nombre_usuario'],$usuario['nombre'],$usuario['email']);
                    break;
                case 3:
                    $user=new Moderador($usuario['id'],$usuario['nombre_usuario'],$usuario['nombre'],$usuario['email']);
                    break;
                case 4:
                    $user=new Administrador($usuario['id'],$usuario['nombre_usuario'],$usuario['nombre'],$usuario['email']);
                    break;

                default:
                    $user=null;
                    break;
            }

            
            $_SESSION['user'] = $user;


            include_once "../template/fragment_registro_ok.php";
        
        
        } else {
            include_once "../template/fragment_error_registro.php";
        }
    } catch (PDOException $e) {
        die("Error al iniciar sesión: " . $e->getMessage());
    }
}

echo '<meta http-equiv="refresh" content="2;url=../">';
