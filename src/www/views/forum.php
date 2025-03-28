<?php

// Función para verificar si el usuario tiene un rol específico
function tieneRol($usuario, $rol)
{
    return $usuario->get_rol() === $rol;
}

// Lógica para crear una nueva categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['crear_categoria'])) {
    $nombre_categoria = $_POST['nombre_categoria'] ?? '';

    // Validar campos
    if (empty($nombre_categoria)) {
        $error = "Por favor, completa todos los campos.";
    } else {
        try {
            if (tieneRol($usuario, 'administrador')) {
                $stmt = $pdo->prepare("INSERT INTO categorias (nombre, permitir_crear_temas) VALUES (:nombre, :permitir_crear_temas)");
                $stmt->execute([
                    ':nombre' => $nombre_categoria,
                    ':permitir_crear_temas' => 1 // Permitir crear temas por defecto
                ]);
                $success = "Categoría creada correctamente.";
            } else {
                $error = "No tienes permiso para crear categorías.";
            }
        } catch (PDOException $e) {
            $error = "Error al crear la categoría: " . $e->getMessage();
        }
    }
}

// Lógica para cambiar el estado de permitir_crear_temas
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cambiar_estado_crear_temas'])) {
    $categoria_id = $_POST['categoria_id'] ?? 0;

    try {
        if (tieneRol($usuario, 'administrador')) {
            $stmt = $pdo->prepare("SELECT permitir_crear_temas FROM categorias WHERE id = :categoria_id");
            $stmt->execute([':categoria_id' => $categoria_id]);
            $categoria = $stmt->fetch();

            if ($categoria) {
                $nuevo_estado = $categoria['permitir_crear_temas'] ? 0 : 1;
                $stmt = $pdo->prepare("UPDATE categorias SET permitir_crear_temas = :nuevo_estado WHERE id = :categoria_id");
                $stmt->execute([
                    ':nuevo_estado' => $nuevo_estado,
                    ':categoria_id' => $categoria_id
                ]);
                $success = "Estado de la categoría actualizado correctamente.";
            } else {
                $error = "Categoría no encontrada.";
            }
        } else {
            $error = "No tienes permiso para cambiar el estado de esta categoría.";
        }
    } catch (PDOException $e) {
        $error = "Error al cambiar el estado de la categoría: " . $e->getMessage();
    }
}

// Consulta para obtener las categorías
try {
    $stmt = $pdo->query("SELECT * FROM categorias");
    $categorias = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error al obtener las categorías: " . $e->getMessage());
}

// Consulta para obtener los temas de una categoría específica (si se proporciona)
$categoria_id = $_GET['categoria_id'] ?? null;
if ($categoria_id) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM temas WHERE categoria_id = :categoria_id ORDER BY created_at DESC");
        $stmt->execute([':categoria_id' => $categoria_id]);
        $temas = $stmt->fetchAll();
    } catch (PDOException $e) {
        die("Error al obtener los temas: " . $e->getMessage());
    }
}
?>
<div class="forum">
    <h2>Categorías del Foro</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>
    <?php if (isset($success)): ?>
        <p style="color: green;"><?= htmlspecialchars($success) ?></p>
    <?php endif; ?>
    <?php if (tieneRol($usuario, 'administrador')): ?>
        <h3>Crear Nueva Categoría</h3>
        <form method="post" action="">
            <label for="nombre_categoria">Nombre de la Categoría:</label>
            <input type="text" id="nombre_categoria" name="nombre_categoria" required>
            <br><br>
            <button type="submit" name="crear_categoria">Crear Categoría</button>
        </form>
    <?php endif; ?>
    <ul>
        <?php foreach ($categorias as $categoria): ?>
            <li>
                <a href="?pag=forum&&categoria_id=<?= $categoria['id'] ?>"><?= htmlspecialchars($categoria['nombre']) ?></a>
                <?php if (tieneRol($usuario, 'administrador')): ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="categoria_id" value="<?= $categoria['id'] ?>">
                        <button type="submit" name="cambiar_estado_crear_temas"><?= $categoria['permitir_crear_temas'] ? 'Cerrar Creación de Temas' : 'Abrir Creación de Temas' ?></button>
                    </form>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <?php if ($categoria_id): ?>
        <h3>Temas en la Categoría</h3>
        <?php if (!empty($temas)): ?>
            <ul>
                <?php foreach ($temas as $tema): ?>
                    <li>
                        <a href="?pag=tema&&id=<?= $tema['id'] ?>"><?= htmlspecialchars($tema['titulo']) ?> - <?= date('d/m/y H:i', strtotime($tema['created_at'])) ?></a>
                        <?php if ($tema['usuario_id'] == $usuario->get_id() || tieneRol($usuario, 'moderador') || tieneRol($usuario, 'administrador')): ?>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="tema_id" value="<?= $tema['id'] ?>">
                                <button type="submit" name="eliminar_tema" onclick="return confirm('¿Estás seguro de querer eliminar este tema?')">Eliminar</button>
                            </form>
                        <?php endif; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>No hay temas en esta categoría.</p>
        <?php endif; ?>
    <?php endif; ?>
</div>
