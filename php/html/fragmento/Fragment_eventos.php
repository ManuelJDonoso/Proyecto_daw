<div class="container__event">
<?php
$pdo = require_once '../../requires/conexion.php';

$query = "SELECT e.id, e.title, e.master, e.players, e.adults, e.image, e.date,
                 (SELECT COUNT(*) FROM jugadores_eventos je WHERE je.fk_eventos = e.id) AS nJugadores
          FROM eventos e";
$stmt = $pdo->query($query);

if ($stmt->rowCount() > 0) {
    while ($row = $stmt->fetch()) {
        $id = $row['id'];
        $ruta = !empty($row['image']) ? $row['image'] : 'assets/images/eventos.jpg';
        $titulo = $row['title'];
        $jugadores = $row['players'];
        $nJugadores = $row['nJugadores'];
        $master = $row['master'];
        $date = strtotime($row['date']);
        $now = time();
        
        // Determinar color
        if ($date > $now && $row['adults'] == 0) {
            $color = "card-event--green";
        } elseif ($date > $now && $row['adults'] == 1) {
            $color = "card-event--orange";
        } else {
            $color = "card-event--gray";
        }
        if ($jugadores == $nJugadores) {
            $color = "card-event--gray";
        }
        
        // Imprimir tarjeta de evento
        echo "<a href='evento.php?id={$id}' class='card-event {$color}'>
                <img src='{$ruta}' alt='Img Juego' class='card-event__image'/>
                <h2 class='card-event__title'>{$titulo}</h2>
                <p class='card-event__players'>Jugadores: {$nJugadores} de {$jugadores}</p>
                <p class='card-event__master'>Master: {$master}</p>
              </a>";
    }
} else {
    echo "<p>No hay eventos disponibles.</p>";
}
?>
 </div>


 <style>
  .main {
    width: 90%;
    max-width: 1200px;
  
  }
</style>
