<?php


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $fromEmail = $_POST['email'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['message'] ?? '';

    // Validación básica
    if (empty($name) || empty($fromEmail) || empty($subject) || empty($message)) {
        http_response_code(400);
       
        echo json_encode(["error" => "Faltan campos por completar."]);

        exit;
    }
   


    include_once __DIR__ . '/../config/php_mailer_conf2.php';
    // Configuración del remitente
  
    try {
        $mail->addAddress('donperma@gmail.com'); // Destinatario final (admin)
        $mail->Subject = "Formulario de contacto: " . $subject;
       
        $body = "
            <h2>Nuevo mensaje desde el formulario de contacto</h2>
            <p><strong>Nombre:</strong> {$name}</p>
            <p><strong>Email:</strong> {$fromEmail}</p>
            <p><strong>Asunto:</strong> {$subject}</p>
            <p><strong>Mensaje:</strong><br>{$message}</p>
        ";

       $mail->isHTML(true);
       $mail->Body = $body;

       $mail->send();

        echo json_encode(["success" => "Mensaje enviado correctamente."]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "No se pudo enviar el mensaje. Error: {$mail->ErrorInfo}"]);
    }
}
