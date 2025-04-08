<?php
    require_once __DIR__."/../controllers/loan_material.php";

?>

<h1 class="reserva__titulo">Reserva de juegos</h1>

<h2 class="reserva__subtitulo">Juegos Reservados por el usuario</h2>
<table class="reserva-tabla reserva-tabla--reservados">
    <thead class="reserva-tabla__thead">
        <tr class="reserva-tabla__fila reserva-tabla__fila--encabezado">
            <th class="reserva-tabla__celda">Nombre juego</th>
            <th class="reserva-tabla__celda">Tipo</th>
            <th class="reserva-tabla__celda">Comentario</th>
            <th class="reserva-tabla__celda">Fecha alquiler</th>
        </tr>
    </thead>
    <tbody class="reserva-tabla__tbody">
        <?php foreach ($Lista_material_alquilado as $row): ?>
            <tr class="reserva-tabla__fila">
                <td class="reserva-tabla__celda"><?= htmlspecialchars($row["nombre"]) ?></td>
                <td class="reserva-tabla__celda"><?= htmlspecialchars($row["tipo"]) ?></td>
                <td class="reserva-tabla__celda"><?= htmlspecialchars($row["comentario"]) ?></td>
                <td class="reserva-tabla__celda">
                    <?php
                        $fecha = new DateTime($row["fecha_alquiler"]);
                        echo $fecha->format('d/m/Y \a\ \l\a\s H:i:s');
                    ?>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<h2 class="reserva__subtitulo">Juegos Disponibles</h2>
<table class="reserva-tabla reserva-tabla--disponibles">
    <thead class="reserva-tabla__thead">
        <tr class="reserva-tabla__fila reserva-tabla__fila--encabezado">
            <th class="reserva-tabla__celda">Nombre del juego</th>
            <th class="reserva-tabla__celda">Tipo</th>
            <th class="reserva-tabla__celda">Descripción</th>
            <th class="reserva-tabla__celda">Edad Recomendada</th>
            <th class="reserva-tabla__celda">Comentario</th>
            <th class="reserva-tabla__celda">Alquilar</th>
        </tr>
    </thead>
    <tbody class="reserva-tabla__tbody">
        <?php foreach ($Lista_material_disponible as $row): ?>
            <tr class="reserva-tabla__fila">
                <td class="reserva-tabla__celda"><?= htmlspecialchars($row["nombre"]) ?></td>
                <td class="reserva-tabla__celda"><?= htmlspecialchars($row["tipo"]) ?></td>
                <td class="reserva-tabla__celda"><?= htmlspecialchars($row["descripcion"]) ?></td>
                <td class="reserva-tabla__celda"><?= htmlspecialchars($row["edad_recomendada"]) ?></td>
                <td class="reserva-tabla__celda"><?= htmlspecialchars($row["comentario"]) ?></td>
                <td class="reserva-tabla__celda">
                    <form action="" method="post" class="reserva-formulario">
                        <input type="hidden" name="id_juego" value="<?= $row["id"] ?>">
                        <input type="hidden" name="id_jugador" value="<?= $usuario->get_id() ?>">
                        <input type="submit" value="Alquilar" class="reserva-formulario__boton">
                    </form>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
