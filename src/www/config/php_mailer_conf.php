<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';
$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.dondominio.com'; // Servidor SMTP (Ejemplo: smtp.gmail.com)
$mail->SMTPAuth = true;
$mail->Username = 'dev@manueldonoso.es'; // Correo del remitente
$mail->Password = 'An931@P3r3zC'; // Contraseña o App Password
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->setFrom('dev@manueldonoso.es', 'Soporte');
$mail->addAddress($email);
$mail->Subject = 'Recuperar Acceso';
