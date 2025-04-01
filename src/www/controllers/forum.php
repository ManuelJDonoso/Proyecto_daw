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

// Verificar si se ha seleccionado un tema
$tema_id = $_GET['tema_id'] ?? null;
$publicaciones = [];

if ($tema_id) {
    $stmt = $pdo->prepare(" SELECT publicaciones.contenido, usuarios.nombre_usuario
    FROM publicaciones
    JOIN usuarios ON publicaciones.usuario_id = usuarios.id
    WHERE publicaciones.tema_id = ?");
    $stmt->execute([$tema_id]);
    $publicaciones = $stmt->fetchAll();
}


$permitir_publicaciones = true; // Valor por defecto

if ($tema_id) {
    $stmt = $pdo->prepare("SELECT permitir_publicaciones FROM temas WHERE id = ?");
    $stmt->execute([$tema_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $permitir_publicaciones = $result['permitir_publicaciones'];
}

if ($tema_id) {
    // Obtener el contenido del tema
    $stmt = $pdo->prepare("SELECT contenido FROM temas WHERE id = ?");
    $stmt->execute([$tema_id]);
    $tema_result = $stmt->fetch(PDO::FETCH_ASSOC);
    $tema_contenido = $tema_result['contenido'] ?? "";
}
