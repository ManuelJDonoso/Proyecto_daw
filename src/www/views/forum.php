<?php
$es_admin = $usuario && $usuario->get_rol() === 'administrador';


// Si se envió el formulario para agregar categoría
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nueva_categoria']) && $es_admin) {
    $titulo = trim($_POST['nueva_categoria']);
    if (!empty($titulo)) {
        $stmt = $pdo->prepare("INSERT INTO categorias (nombre, permitir_crear_temas) VALUES (?, 1)");
        $stmt->execute([$titulo]);
    }
}

// Obtener categorías
$categorias = $pdo->query("SELECT * FROM categorias")->fetchAll();

// Verificar si se ha seleccionado una categoría para mostrar los temas
$categoria_id = $_GET['categoria_id'] ?? null;
$temas = [];
$permitir_crear_temas = false;

if ($categoria_id) {
    $stmt = $pdo->prepare("SELECT * FROM temas WHERE categoria_id = ?");
    $stmt->execute([$categoria_id]);
    $temas = $stmt->fetchAll();

}

if ($categoria_id) {
    $stmt = $pdo->prepare("SELECT permitir_crear_temas FROM categorias WHERE id = ?");
    $stmt->execute([$categoria_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC); // Obtener el resultado de la consulta
    $permitir_crear_temas = $result['permitir_crear_temas']; // Asignar el valor a la variable
}

?>
<h1>Foro</h1>

<?php if ($es_admin): ?>
    <form method="POST">
        <input type="text" name="nueva_categoria" placeholder="Nombre de la categoría" required>
        <button type="submit">Crear Categoría</button>
    </form>
<?php endif; ?>


<h2>Categorías</h2>
<ul>
    <?php foreach ($categorias as $categoria): ?>
        <li>
            <a href="?pag=forum&&categoria_id=<?= $categoria['id'] ?>"> <?= htmlspecialchars($categoria['nombre']) ?> </a>
            <?php if ($es_admin): ?>
                <form method="POST" action="controllers/eliminar_categoria.php" style="display:inline;">
                    <input type="hidden" name="categoria_id" value="<?= $categoria['id'] ?>">
                    <button type="submit" onclick="return confirm('¿Estás seguro de que deseas eliminar esta categoría?')" >Eliminar</button>
                </form>
                <form method="POST" action="controllers/toggle_temas.php" style="display:inline;">
                    <input type="hidden" name="categoria_id" value="<?= $categoria['id'] ?>">
                    <button type="submit">
                        <?= $categoria['permitir_crear_temas'] ? 'Deshabilitar temas' : 'Habilitar temas' ?>
                    </button>
                </form>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>


<?php if ($categoria_id): ?>
    <h2>Temas en la categoría seleccionada</h2>
    <ul>
        <?php if (count($temas) > 0): ?>
            <?php foreach ($temas as $tema): ?>
                <li>
                    <a href="ver_post.php?tema_id=<?= $tema['id'] ?>"> <?= htmlspecialchars($tema['titulo']) ?> </a>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay temas en esta categoría.</p>
        <?php endif; ?>
    </ul>
    <!-- falta rodearlo para que solo aparezca si esta habilitado el uso -->
    <?php if ($permitir_crear_temas): ?>
        <?php if ($es_admin || ($usuario && $categoria_id && in_array($usuario->get_rol(), ['moderador', 'jugador']))): ?>
            <form method="POST" action="controllers/add_tema.php">
                <input type="hidden" name="categoria_id" value="<?= $categoria_id ?>">
                <input type="text" name="titulo_tema" placeholder="Título del tema" required>
                <textarea name="contenido" required></textarea>
                <button type="submit">Crear Tema</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>


