<?php
require_once __DIR__ . '/../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;



$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host = 'smtp.dondominio.com';
$mail->SMTPAuth = true;
$mail->Username = 'dev@manueldonoso.es';
$mail->Password = ''; // ⚠️ Se recomienda mover esto a un archivo .env
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->setFrom('dev@manueldonoso.es', 'Soporte');