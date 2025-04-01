<?php
// Incluir el archivo de conexión a la base de datos
require_once '../config/conexion.php';
$tema_id=$_POST["tema_id"];
if (isset($_POST["categoria_id"])) {
    $categoria_id=$_POST["categoria_id"];
}else{
    $categoria_id=null;
}
var_dump($_POST);

// Verificar si se ha enviado el ID del comentario a eliminar
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['publicacion_id'])) {
    $publicacion_id = $_POST['publicacion_id'];

    try {
        // Preparar la consulta para eliminar el comentario
        $stmt = $pdo->prepare("DELETE FROM publicaciones WHERE id = :publicacion_id");
        $stmt->bindParam(':publicacion_id', $publicacion_id, PDO::PARAM_INT);
        $stmt->execute();

        // Verificar si el comentario fue eliminado correctamente
        if ($stmt->rowCount() > 0) {
            echo json_encode(["success" => true, "message" => "publicacion eliminada correctamente"]);
        } else {
            echo json_encode(["success" => false, "message" => "publicacion no encontrado"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "message" => "Error al eliminar publicacion: " . $e->getMessage()]);
    }
} else {
    // No se ha enviado el ID del comentario
    echo json_encode(["success" => false, "message" => "ID del comentario no proporcionado"]);
}

if($categoria_id!=null){
    header('Location: ../index.php?pag=forum&&categoria_id='.$categoria_id.'&&tema_id='.$tema_id);
}else{
    header('Location: ../index.php?pag=forum&&tema_id='.$tema_id);
}

?>
