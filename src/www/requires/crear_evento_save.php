<?php
// Incluir el archivo de conexión PDO
require_once '../config/conexion.php';  // Asegúrate de que la ruta sea correcta

// Recibir datos del formulario
$title = $_POST['title'];
$description = $_POST['description'];
$master = $_POST['master'];
$players = $_POST['players'];
$date = $_POST['date'];
$time = $_POST['time'];
$end_time = $_POST['end_time'];
$mode = $_POST['mode'];
$location = !empty($_POST['location']) ? $_POST['location'] : NULL;
$adults = isset($_POST['adults']) ? 1 : 0;
$imageReset = $_POST['imageReset'];  // Si es "1", no hay imagen

$imagePath = NULL; // Por defecto, no hay imagen

// Manejo de imagen
if ($imageReset !== "1") {
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) { // Verifica si se subió correctamente
        $fileName = pathinfo($_FILES["image"]["name"], PATHINFO_FILENAME); // Nombre sin extensión
        $fileExt = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION); // Extensión del archivo
        $uniqueName = time() . "_" . uniqid() . "." . $fileExt; // Nombre único
        $targetDir = "../assets/images/uploads/";
        $targetFilePath = $targetDir . $uniqueName;

        // Mueve la imagen al directorio
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            $imagePath = 'assets/images/uploads/' . $uniqueName; // Guarda la ruta relativa en la base de datos
        } else {
            echo "Error al mover el archivo.";
            exit; // Detiene la ejecución si falla la subida
        }
    } else {
       
        echo "No se subió ninguna imagen o hubo un error en la subida.";
        echo "<br />";
    }
}

// Inserción en la base de datos usando PDO
try {
    // Consulta SQL para insertar los datos
    $sql = "INSERT INTO eventos (title, description, master, players, date, time, end_time, mode, location, adults, image) 
            VALUES (:title, :description, :master, :players, :date, :time, :end_time, :mode, :location, :adults, :image)";
    
    // Preparar la sentencia
    $stmt = $pdo->prepare($sql);

    // Vincular los parámetros
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':master', $master);
    $stmt->bindParam(':players', $players, PDO::PARAM_INT);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':time', $time);
    $stmt->bindParam(':end_time', $end_time);
    $stmt->bindParam(':mode', $mode);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':adults', $adults, PDO::PARAM_INT);
    $stmt->bindParam(':image', $imagePath);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        include_once '../template/fragment_crear_evento.php';
        echo '<meta http-equiv="refresh" content="2;url=../">';
        echo "Evento creado con éxito.";
    } else {
        echo "Error al guardar el evento.";
        print_r($stmt->errorInfo()); // Imprime información detallada del error
    }

} catch (PDOException $e) {
    // En caso de error, mostrar el mensaje
    die("Error al ejecutar la consulta: " . $e->getMessage());
}
?>
