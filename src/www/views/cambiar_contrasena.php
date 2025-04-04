<?php
$token = $_GET['token'] ?? '';

$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE reset_token = ? AND token_expiracion > NOW()");
$stmt->execute([$token]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<?php if(!$usuario):?>
    <p>El enlace ha expirado o es inválido.</p>
<?php else: ?>

<form action="?pag=actualizar_contrasena" method="POST">
        <h2>Restablecer Contraseña</h2>
        <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
        <input type="password" name="password" placeholder="Nueva Contraseña" required>
        <button  class="btn_recuperar" type="submit">Actualizar Contraseña</button>
</form>
<?php endif ?>
