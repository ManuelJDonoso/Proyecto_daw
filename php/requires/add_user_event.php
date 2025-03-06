
<?php
    session_start();

    // Incluir el archivo de conexión
    require_once 'conexion.php';
    
    // Verificar si se enviaron los parámetros necesarios
    if (isset($_SESSION["usuario_nombre"]) && isset($_GET["id"])) {
        $nombre = trim($_SESSION["usuario_nombre"]);
        $fk_eventos = $_GET["id"];
    
        // Validar que los valores no estén vacíos
        if (empty($nombre) || $fk_eventos <= 0) {
            die("Error: Datos inválidos.");
        }
    
        // Consulta para insertar un jugador si no existe en ese evento
        $sql = "INSERT INTO Jugadores_eventos (nombre, fk_eventos)
                VALUES (:nombre, :fk_eventos)
                ON DUPLICATE KEY UPDATE nombre = nombre";
    
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
            $stmt->bindParam(':fk_eventos', $fk_eventos, PDO::PARAM_INT);
            
            $stmt->execute();
    
            echo "Jugador '$nombre' agregado al evento con ID $fk_eventos correctamente.";
        } catch (PDOException $e) {
            echo "Error al agregar jugador: " . $e->getMessage();
        }
    } else {
        echo "Error: Faltan parámetros.";
    }
    ?>
    
    <meta http-equiv="refresh"  content="0;url=../evento.php?id=<?=$_GET['id']?>">
    



