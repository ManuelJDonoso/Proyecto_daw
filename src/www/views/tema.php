<?php
var_dump($usuario);
// Función para verificar si el usuario tiene un rol específico
function tieneRol($usuario, $rol) {
    return $usuario->get_rol() === $rol;
}

// Obtener el tema
$tema_id = $_GET['categoria'] ?? 0;
try {
    $stmt = $pdo->prepare("SELECT t.id, t.titulo, t.contenido, t.usuario_id, t.permitir_publicaciones, t.created_at, u.nombre_usuario FROM temas t JOIN usuarios u ON t.usuario_id = u.id WHERE t.id = :tema_id");
    $stmt->execute([':tema_id' => $tema_id]);
    $tema = $stmt->fetch();
    if (!$tema) {
        die("Tema no encontrado.");
    }
} catch (PDOException $e) {
    die("Error al obtener el tema: " . $e->getMessage());
}

// Lógica para crear una nueva publicación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_publicacion'])) {
    $contenido = $_POST['contenido'] ?? '';

    // Validar campos
    if (empty($contenido)) {
        $error = "Por favor, completa todos los campos.";
    } else {
        try {
            if ($tema['permitir_publicaciones'] || tieneRol($usuario, 'moderador') || tieneRol($usuario, 'administrador')) {
                $stmt = $pdo->prepare("INSERT INTO publicaciones (tema_id, contenido, usuario_id) VALUES (:tema_id, :contenido, :usuario_id)");
                $stmt->execute([
                    ':tema_id' => $tema_id,
                    ':contenido' => $contenido,
                    ':usuario_id' => $usuario->get_id()
                ]);
                $success = "Publicación creada correctamente.";
            } else {
                $error = "No se permiten publicaciones en este tema.";
            }
        } catch (PDOException $e) {
            $error = "Error al crear la publicación: " . $e->getMessage();
        }
    }
}

// Lógica para dar "Me gusta" o "Ya no me gusta" a una publicación
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dar_me_gusta'])) {
    $publicacion_id = $_POST['publicacion_id'] ?? 0;

    try {
        $stmt = $pdo->prepare("SELECT * FROM me_gustas WHERE publicacion_id = :publicacion_id AND usuario_id = :usuario_id");
        $stmt->execute([
            ':publicacion_id' => $publicacion_id,
            ':usuario_id' => $usuario->get_id()
        ]);
        $me_gusta = $stmt->fetch();

        if ($me_gusta) {
            // Si ya ha dado Me gusta, se elimina el voto
            $stmt = $pdo->prepare("DELETE FROM me_gustas WHERE publicacion_id = :publicacion_id AND usuario_id = :usuario_id");
            $stmt->execute([
                ':publicacion_id' => $publicacion_id,
                ':usuario_id' => $usuario->get_id()
            ]);
            $success = "Ya no te gusta esta publicación.";
        } else {
            // Si no ha dado Me gusta, se inserta un nuevo voto
            $stmt = $pdo->prepare("INSERT INTO me_gustas (publicacion_id, usuario_id) VALUES (:publicacion_id, :usuario_id)");
            $stmt->execute([
                ':publicacion_id' => $publicacion_id,
                ':usuario_id' => $usuario->get_id()
            ]);
            $success = "Te gusta esta publicación.";
        }
    } catch (PDOException $e) {
        $error = "Error al dar Me gusta: " . $e->getMessage();
    }
}

// Consulta para obtener las publicaciones del tema
try {
    $stmt = $pdo->prepare("SELECT p.id, p.contenido, p.usuario_id, p.created_at, u.nombre_usuario FROM publicaciones p JOIN usuarios u ON p.usuario_id = u.id WHERE p.tema_id = :tema_id ORDER BY p.created_at DESC");
    $stmt->execute([':tema_id' => $tema_id]);
    $publicaciones = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error al obtener las publicaciones: " . $e->getMessage());
}
?>

<div class="container">
    <div class="forum">
        <h2>Tema: <?= htmlspecialchars($tema['titulo']) ?></h2>
        <p><strong>Autor:</strong> <?= htmlspecialchars($tema['nombre_usuario']) ?> - <?= date('d/m/y H:i', strtotime($tema['created_at'])) ?></p>
        <p><?= nl2br(htmlspecialchars($tema['contenido'])) ?></p>
        <br>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p style="color: green;"><?= htmlspecialchars($success) ?></p>
        <?php endif; ?>
        <?php if ($tema['permitir_publicaciones'] || tieneRol($usuario, 'moderador') || tieneRol($usuario, 'administrador')): ?>
            <form method="post" action="">
                <label for="contenido">Publicación:</label>
                <textarea id="contenido" name="contenido" rows="4" required></textarea>
                <br><br>
                <button type="submit" name="crear_publicacion">Crear Publicación</button>
            </form>
        <?php else: ?>
            <p>No se permiten publicaciones en este tema.</p>
        <?php endif; ?>
        <br>
        <?php if ($tema['usuario_id'] == $usuario->get_id() || tieneRol($usuario, 'moderador') || tieneRol($usuario, 'administrador')): ?>
            <form method="post" style="display:inline;">
                <button type="submit" name="cambiar_estado"><?= $tema['permitir_publicaciones'] ? 'Cerrar Tema' : 'Abrir Tema' ?></button>
            </form>
        <?php endif; ?>
        <br>
        <?php if (!empty($publicaciones)): ?>
            <h3>Publicaciones</h3>
            <?php foreach ($publicaciones as $publicacion): ?>
                <div class="post">
                    <div class="user"><?= htmlspecialchars($publicacion['nombre_usuario']) ?> - <?= date('d/m/y H:i', strtotime($publicacion['created_at'])) ?></div>
                    <div class="content"><?= nl2br(htmlspecialchars($publicacion['contenido'])) ?></div>
                    <?php if ($publicacion['usuario_id'] == $usuario->get_id() || tieneRol($usuario, 'moderador') || tieneRol($usuario, 'administrador')): ?>
                        <form method="post" style="display:inline;">
                            <input type="hidden" name="publicacion_id" value="<?= $publicacion['id'] ?>">
                            <button type="submit" name="eliminar_publicacion" onclick="return confirm('¿Estás seguro de querer eliminar esta publicación?')">Eliminar</button>
                        </form>
                    <?php endif; ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="publicacion_id" value="<?= $publicacion['id'] ?>">
                        <?php
                        $stmt = $pdo->prepare("SELECT * FROM me_gustas WHERE publicacion_id = :publicacion_id AND usuario_id = :usuario_id");
                        $stmt->execute([
                            ':publicacion_id' => $publicacion['id'],
                            ':usuario_id' => $usuario->get_id()
                        ]);
                        $me_gusta = $stmt->fetch();
                        ?>
                        <?php if ($me_gusta): ?>
                            <button type="submit" name="dar_me_gusta" style="background-color: #ff4d4d; color: white;">Ya no me gusta</button>
                        <?php else: ?>
                            <button type="submit" name="dar_me_gusta" style="background-color: #4dff4d; color: white;">Me gusta</button>
                        <?php endif; ?>
                    </form>
                    <?php
                    $stmt = $pdo->prepare("SELECT COUNT(*) FROM me_gustas WHERE publicacion_id = :publicacion_id");
                    $stmt->execute([':publicacion_id' => $publicacion['id']]);
                    $me_gustas_count = $stmt->fetchColumn();
                    ?>
                    <p><?= $me_gustas_count ?> Me gusta</p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay publicaciones en este tema.</p>
        <?php endif; ?>
    </div>
</div>

