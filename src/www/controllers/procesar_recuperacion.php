<?php
require_once 'config/conexion.php'; // Archivo donde está la conexión con PDO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    // Verificar si el correo existe
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Generar un token único
        $token = bin2hex(random_bytes(32));
        $expiracion = date("Y-m-d H:i:s", strtotime("+1 hour")); // Expira en 1 hora

        // Guardar en la base de datos
        $stmt = $pdo->prepare("UPDATE usuarios SET reset_token = ?, token_expiracion = ? WHERE email = ?");
        $stmt->execute([$token, $expiracion, $email]);

        // Enlace de recuperación
        $link = "http://tusitio.com/cambiar_contrasena.php?token=" . $token;

        // Enviar correo (ajusta mail() o usa PHPMailer para mejor compatibilidad)
        $asunto = "Recuperación de Contraseña";
        $mensaje = "Hola, usa el siguiente enlace para restablecer tu contraseña: $link";
        $cabeceras = "From: no-reply@tusitio.com\r\n";

        mail($email, $asunto, $mensaje, $cabeceras);

        echo "Se ha enviado un enlace a tu correo.";
    } else {
        echo "El correo no está registrado.";
    }
}
?>
