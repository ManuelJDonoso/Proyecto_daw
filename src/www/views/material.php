<?php
include_once __DIR__ . "/../controllers/material.php";

?>

<h1 class="material-list__title">Lista de Material</h1>

<?php if (count($material_disponible) > 0): ?>
    <table class="material-list__table">
        <thead class="material-list__header">
            <tr class="material-list__row">
                <th scope="col" class="material-list__cell material-list__cell--header">Nombre</th>
                <th scope="col" class="material-list__cell material-list__cell--header">Tipo</th>
                <th scope="col" class="material-list__cell material-list__cell--header">Descripción</th>
                <th scope="col" class="material-list__cell material-list__cell--header">Edad Recomendada</th>
                <th scope="col" class="material-list__cell material-list__cell--header">Cantidad</th>
            </tr>
        </thead>
        <tbody class="material-list__body">
            <?php foreach ($material_disponible as $fila): ?>
                <tr class="material-list__row">
                    <td class="material-list__cell material-list__cell--body"><?= htmlspecialchars($fila["material"]) ?></td>
                    <td class="material-list__cell material-list__cell--body"><?= htmlspecialchars($fila["tipo"]) ?></td>
                    <td class="material-list__cell material-list__cell--body"><?= htmlspecialchars($fila["descripcion"]) ?></td>
                    <td class="material-list__cell material-list__cell--body"><?= htmlspecialchars($fila["edad_recomendada"]) ?></td>
                    <td class="material-list__cell material-list__cell--body"><?= htmlspecialchars($fila["cantidad_disponible"]) ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="material-list__empty">No hay material disponible.</p>
<?php endif ?>
