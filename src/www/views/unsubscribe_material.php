<?php
include_once "__DIR__" . "/../controllers/unsubscribe_material.php";

?>

<h1 class="unsubscribe__title">Material para dar de baja</h1>
<h2 class="unsubscribe__subtitle">filtro</h2>

<div class="unsubscribe__form-group">
    <label class="unsubscribe__label" for="id">ID:</label>
    <input class="unsubscribe__input" type="text" name="id" placeholder="Introduce el nombre del material">
</div>

<div class="unsubscribe__form-group">
    <label class="unsubscribe__label" for="nombre">Nombre:</label>
    <input class="unsubscribe__input" type="text" name="nombre" placeholder="Introduce el nombre del material">
</div>

<div class="unsubscribe__form-group">
    <label class="unsubscribe__label" for="tipo-material">Tipo material:</label>
    <select class="unsubscribe__select" name="tipo-material" id="tipo-material">
        <option value="0"></option>
        <optgroup label="tipo de material">
            <?php foreach ($tipo_material as $fila): ?>
                <option value="<?= $fila['id'] ?>"><?= $fila["nombre"] ?></option>
            <?php endforeach ?>
        </optgroup>
    </select>
</div>


<h2 class="unsubscribe__subtitle">Material</h2>
<div class="unsubscribe__table-container">
    <table class="unsubscribe__table">
        <thead class="unsubscribe__table-head">
            <tr class="unsubscribe__table-row">
                <th class="unsubscribe__table-header">ID</th>
                <th class="unsubscribe__table-header">Nombre</th>
                <th class="unsubscribe__table-header">estado</th>
                <th class="unsubscribe__table-header">tipo</th>
                <th class="unsubscribe__table-header">comentario</th>


                <th class="unsubscribe__table-header">fecha Alta</th>
                <th class="unsubscribe__table-header">dar de baja</th>

            </tr>
        </thead>
        <tbody class="unsubscribe__table-body">
            <?php foreach ($busqueda_material as $row): ?>
                <tr class="unsubscribe__table-row">
                    <td class="unsubscribe__table-cell"><?= $row["id"] ?></td>
                    <td class="unsubscribe__table-cell"><?= $row["nombre"] ?></td>
                    <td class="unsubscribe__table-cell"><?= $row["estado"] ?></td>
                    <td class="unsubscribe__table-cell"><?= $row["tipo"] ?></td>
                    <td class="unsubscribe__table-cell"><?= $row["comentario"] ?></td>

                    <td><?php
                        $fecha = new DateTime($row["fecha_alta_material"]);
                        echo $fechaFormateada = $fecha->format('d/m/Y \a\ \l\a\s H:i:s');
                        ?></td>
                    <td>
                        <form action="" method="post" class="unsubscribe__form">
                            <input type="hidden" name="id" value="<?= $row["id"] ?>">
                            <input type="submit" value="Baja" class="unsubscribe__submit">
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>
