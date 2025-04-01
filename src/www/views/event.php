<?php
    include_once "controllers/event.php";
?>

<div class="form-card form-card--add_event">
    <div class="form-card__left">
    <img
                src="<?= $image ?>"
                alt="img de la tarjeta"
                class="card__image"
                id="preview" />
    </div>
    <div class="form-card__right">
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


<?php
if (method_exists($usuario, 'inscribir_evento') && $usuario->inscribir_evento()) {
    echo '<a href="controllers/add_user_event.php?id=';
    echo  $_GET['id'];
    echo '"><button class="event__register">Inscribirse</button></a>';
}


?>

</section>

<section class="players">
                <h2 class="players__title">Lista de Asistentes</h2>
                <table class="players__table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <?php

                            if (method_exists($usuario, 'eliminar_usuario_evento') && $usuario->eliminar_usuario_evento()) {
                                echo " <th>Acción</th>";
                            }

                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (count($jugadores) > 0): ?>
                            <?php foreach ($jugadores as $jugador): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($jugador['nombre']); ?></td>

                                    <?php

                                    if (method_exists($usuario, 'eliminar_usuario_evento') && $usuario->eliminar_usuario_evento()) {
                                        echo  " <td>";
                                        echo '<button class="players__remove" onclick="eliminarJugador(\'' . htmlspecialchars($jugador['nombre'], ENT_QUOTES, 'UTF-8') . '\')">Eliminar</button>';
                                        echo " </td>";
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

                <!-- Botón para eliminar el evento -->
                <?php if (method_exists($usuario, 'eliminar_evento') && $usuario->eliminar_evento()): ?>
                    <button class="event__delete" onclick="eliminarEvento(<?= $id ?>)">Eliminar Evento</button>
                <?php endif; ?>
            </section>

    </div>

    
</div>
 
<script src="js/event.js"></script>
