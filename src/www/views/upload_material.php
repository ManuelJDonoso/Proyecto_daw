<?php
include_once __DIR__."/../controllers/upload_material.php";
?>
<h1 class="material-form__title">Material a dar de alta</h1>

<div class="material-panel">
    <!-- Formulario -->
    <form class="material-form" action="" method="post">
        <label class="material-form__label" for="nombre">Nombre:</label>
        <input class="material-form__input" type="text" name="nombre" placeholder="Introduce el nombre del material">
        
        <label class="material-form__label" for="tipo-material">Tipo de material:</label>
        <select class="material-form__select" name="tipo-material" id="tipo-material">
            <?php foreach ($tipo_material as $fila): ?>
                <option value="<?= $fila['id'] ?>"><?= $fila["nombre"] ?></option>
            <?php endforeach ?>
        </select>

        <label class="material-form__label" for="descripcion">Descripción:</label>
        <textarea class="material-form__textarea" name="descripcion" placeholder="Descripción del material"></textarea>

        <label class="material-form__label" for="comentario">Comentario:</label>
        <textarea class="material-form__textarea" name="comentario" placeholder="Comentario del material"></textarea>

        <label class="material-form__label" for="edad_recomendada">Edad recomendada:</label>
        <input class="material-form__input" type="text" name="edad_recomendada" placeholder="Introduce la edad recomendada">

        <input class="material-form__button" type="submit" value="Dar de alta">
    </form>

    <!-- Tabla lateral -->
    <div class="material-table">
        <table class="material-table__table">
            <thead>
                <tr>
                    <th class="material-table__th material-table__th--id">ID</th>
                    <th class="material-table__th">Nombre</th>
                    <th class="material-table__th">Descripción</th>
                    <th class="material-table__th material-table__th--hide">tipo</th>
                    <th class="material-table__th material-table__th--hide">edad_recomendada</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($material as $mat): ?>
                    <tr>
                        <td class="material-table__td material-table__td--id"><?= $mat['id'] ?></td>
                        <td class="material-table__td"><?= $mat['nombre'] ?></td>
                        <td class="material-table__td"><?= $mat['descripcion'] ?></td>
                        <td class="material-table__td material-table__td--hide"><?= $mat['tipo_id'] ?></td>
                        <td class="material-table__td material-table__td--hide"><?= $mat['edad_recomendada'] ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>



