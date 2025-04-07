<?php
    require_once __DIR__."/../controllers/loan_material.php";

?>
<h1>Reserva de juegos</h1>
<h2>Juegos Reservados</h2>


<table>
    <thead>
        <tr>
            <th>nombre juego</th>
            <th>tipo</th>
            <th>comentario</th>
            <th>Fecha alquiler</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($Lista_material_alquilado as $row): ?>
            <tr>
                <td><?=$row["nombre"]?></td>
                <td><?=$row["tipo"]?></td>
                <td><?=$row["comentario"]?></td>
                <td>
                    <?PHP
                        $fecha = new DateTime($row["fecha_alquiler"]);
                        echo $fechaFormateada = $fecha->format('d/m/Y \a\ \l\a\s H:i:s');
                    ?>
                </td>
            </tr>
        <?php endforeach?>
    </tbody>
</table>

<h2>Juegos Disponible</h2>
<table>
    <thead>
        <tr>
            
            <th>Nombre del juego</th>
            <th>tipo</th>
            <th>Descripción</th>
            <th>Edad Recomendada</th>
            <th>Comentario</th>
            <th>Alquilar</th>
            
        </tr>
    </thead>
    <tbody>
        <?PHP foreach ($Lista_material_disponible as $row):?>
            <tr>
            
                <td> <?=$row["nombre"]?> </td>
                <td> <?=$row["tipo"]?> </td>
                <td> <?=$row["descripcion"]?> </td>
                <td> <?=$row["edad_recomendada"]?> </td>
                <td> <?=$row["comentario"]?> </td>
                <td>
                    <form action="" method="post">
                        <input type="hidden" name="id_juego" value="<?=$row["id"]?> ">
                        <input type="hidden" name="id_jugador" value="<?=$usuario->get_id()?>">
                        <input type="submit" value="Alquilar">
                    </form>
                </td>

            </tr>
        <?PHP endforeach ?>
    </tbody>
</table>