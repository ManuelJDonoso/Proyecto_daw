<?php

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
    $stmt = $pdo->prepare("
        SELECT t.id,t.categoria_id, t.titulo, t.contenido, u.nombre_usuario, t.created_at, t.permitir_publicaciones
        FROM temas t
        JOIN usuarios u ON t.usuario_id = u.id
        WHERE t.categoria_id = ?
    ");
    $stmt->execute([$categoria_id]);
    $temas = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    $stmt = $pdo->prepare(" SELECT publicaciones.id, publicaciones.contenido, usuarios.nombre_usuario
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
    // Obtener el contenido del tema, titulo y nombre_usuario
    $stmt = $pdo->prepare("
        SELECT t.contenido, t.titulo, u.nombre_usuario
        FROM temas t
        JOIN usuarios u ON t.usuario_id = u.id
        WHERE t.id = ?
    ");
    $stmt->execute([$tema_id]);
    $tema_result = $stmt->fetch(PDO::FETCH_ASSOC);
    $tema_contenido = $tema_result['contenido'] ?? "";
    $tema_titulo = $tema_result['titulo'] ?? "";
    $nombre_usuario = $tema_result['nombre_usuario'] ?? "";
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