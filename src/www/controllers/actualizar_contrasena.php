<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $nuevaPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Verificar si el token es válido
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE reset_token = ? AND token_expiracion > NOW()");
    $stmt->execute([$token]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Actualizar la contraseña y eliminar el token
        $stmt = $pdo->prepare("UPDATE usuarios SET password = ?, reset_token = NULL, token_expiracion = NULL WHERE reset_token = ?");
        $stmt->execute([$nuevaPassword, $token]);

        echo "Contraseña actualizada correctamente.";
    } else {
        echo "El token es inválido o ha expirado.";
    }
}
