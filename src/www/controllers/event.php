<?php
// Verificar si se recibió un ID válido por GET o POST
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id']; // Obtener el ID del evento desde la URL
} else {
    die("Error: ID de evento no válido.");
}

// Consulta SQL para obtener el evento por ID
$sql = "SELECT title, description, master, players, date, time, end_time, mode, location, adults, image FROM eventos WHERE id = :id";

try {
    // Preparar la consulta
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Obtener el resultado
    $evento = $stmt->fetch();

    if ($evento) {
        // Asignar los valores a variables
        $title = $evento["title"];
        $description = $evento["description"];
        $master = $evento["master"];
        $players = $evento["players"];
        $date = $evento["date"];
        // Crear un objeto DateTime
        $fecha = new DateTime($date);

        // Configurar la localización para que muestre los nombres en español
        setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain', 'es_ES');

        // Obtener el formato deseado
        $fecha_formateada = strftime('%d de %B de %Y', $fecha->getTimestamp());

        // Convertir la primera letra en mayúscula
        $fecha_formateada = ucfirst($fecha_formateada);

        $time = $evento["time"];
        $end_time = $evento["end_time"];
        $mode = $evento["mode"];
        $location = $evento["location"];
        $adults = $evento["adults"];
        $image = $evento["image"];
        if ($evento["image"] == null) {
            $image = "./assets/images/eventos.jpg";
        } else {
            $image = $evento["image"];
        }
    } else {
        echo "No se encontró el evento con ID: $id.";
    }
} catch (PDOException $e) {
    echo "Error en la consulta: " . $e->getMessage();
}

try {
    // Consulta para obtener los jugadores
    $sql = "SELECT nombre FROM jugadores_eventos WHERE fk_eventos = $_GET[id] ORDER BY nombre ASC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $jugadores = $stmt->fetchAll();
} catch (PDOException $e) {
    die("Error al obtener jugadores: " . $e->getMessage());
}
