<?php session_start();

// Incluir el archivo de conexión
require_once 'requires/conexion.php';

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
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/responsive.css" />


</head>

<body>
    <!-- Encabezado de la pagina web -->
    <header>
        <!-- Menu de banner -->
        <?php include_once './html/fragmento/fragment_banner.php' ?>
        <!-- Menu de navegación -->
        <?php include_once './html/fragmento/fragment_menu.php' ?>
    </header>

    <!-- Contenido principal del body-->

    <main class="main">

        <div class="card">
            <img
                src="<?= $image ?>"
                alt="img de la tarjeta"
                class="card__image"
                id="preview" />

            <section class="event">

                <h1 class="event__title"><?= $title ?></h1>
                <p class="event__description"><?= $description ?></p>
                <p class="event__master">organizador: <?= $master ?></p>
                <p class="event__schedule">Fecha: <?= $fecha_formateada ?></p>
                <p class="event__schedule">Hora de inicio: <?= $time ?>| Hora de fin: <?= $end_time ?></p>
                <p class="event__location event__location--online">Ubicación: <?= $mode ?></p>

                <?php
                if ($mode == "presencial") {
                    echo "<p class='event__location event__location--presencial'>Ubicación:" . $location . "</p>";
                }
                ?>
                <p class="event__age-restriction">+18: <?= ($adults ? "Sí" : "No") ?></p>

                <?php if (isset($_SESSION["rol"])) {
                    if ($_SESSION["rol"] == "jugador" || $_SESSION["rol"] == "moderador" || $_SESSION["rol"] == "administrador") {
                        echo '<a href="requires/add_user_event.php?id=';
                        echo  $_GET['id'];
                        echo '"><button class="event__register">Inscribirse</button></a>';
                    }
                }

                ?>

            </section>


            <section class="players">
                <h2 class="players__title">Lista de Asistentes</h2>
                <table class="players__table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <?php if (isset($_SESSION["rol"])) {
                                if ($_SESSION["rol"] == "moderador" || $_SESSION["rol"] == "administrador") {
                                    echo " <th>Acción</th>";
                                }
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($jugadores) > 0): ?>
                            <?php foreach ($jugadores as $jugador): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($jugador['nombre']); ?></td>

                                    <?php if (isset($_SESSION["rol"])) {

                                        if ($_SESSION["rol"] == "moderador" || $_SESSION["rol"] == "administrador") {
                                            echo  " <td>";
                                            echo '<button class="players__remove" onclick="eliminarJugador(\'' . htmlspecialchars($jugador['nombre'], ENT_QUOTES, 'UTF-8') . '\')">Eliminar</button>';
                                            echo " </td>";
                                        }
                                    }
                                    ?>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="2">No hay asistentes registrados.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>



        </div>

    </main>

    <!-- Contenido del pie de pagina-->
    <?php include_once './html/fragmento/fragment_footer.php' ?>
    <script src="js/menu_responsive.js"></script>
    <script src="js/accion_menu.js"></script>
    <script>
        function eliminarJugador(nombre) {
            if (confirm(`¿Seguro que quieres eliminar a ${nombre}?`)) {
                fetch('requires/eliminar_jugador.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `nombre=${encodeURIComponent(nombre)}`
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert(data);
                        location.reload();
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>
</body>



</html>
