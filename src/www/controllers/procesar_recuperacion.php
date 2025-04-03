<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'config/conexion.php';




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Generar token
        $token = bin2hex(random_bytes(32));
        $expiracion = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $stmt = $pdo->prepare("UPDATE usuarios SET reset_token = ?, token_expiracion = ? WHERE email = ?");
        $stmt->execute([$token, $expiracion, $email]);

        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]";
        
        $link = $url."?pag=cambiar_contrasena&&token=$token";
        

        // Configurar PHPMailer
        
        try {
            require_once 'config/php_mailer_conf.php';
            $mail->Body = "Hola, usa el siguiente enlace para restablecer tu contraseña: $link";

            $mail->send();
            echo "Correo enviado con éxito.";
        } catch (Exception $e) {
            echo "Error al enviar correo: {$mail->ErrorInfo}";
        }
    } else {
        echo "El correo no está registrado.";
    }
}
?>

