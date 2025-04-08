<?PHP
include_once __DIR__ . "/../controllers/return_material.php";

?>



<div class="container--alquilado">
    <h1 class="material-tabla__titulo" onclick="ocultar()">MATERIAL ALQUILADO</h1>
    <div class="content" id="contenido">
        <div class="filters--alquilado">
            <h2 class="filters__title">filtros</h2>
            <div class="filters__group">
                <div class="filters__item">
                    <label for="id" class="filters__label">id:</label>
                    <input type="text" name="id__filters" class="filters--alquilado__input">
                </div>
                <div class="filters__item">
                    <label for="material" class="filters__label">Material:</label>
                    <input type="text" name="material" class="filters--alquilado__input">
                </div>
                <div class="filters__item">
                    <label for="tipo" class="filters__label">Tipo:</label>
                    <input type="text" name="tipo" class="filters--alquilado__input">
                </div>
                <div class="filters__item">
                    <label for="usuario" class="filters__label">Usuario:</label>
                    <input type="text" name="usuario" class="filters--alquilado__input">
                </div>
                <div class="filters__item">
                    <label for="date-id" class="filters__label">fecha de alquiler:</label>
                    <input type="date" name="date-id" class="filters--alquilado__input">
                </div>
            </div>
        </div>

        <div class="tabla_content">
             <table class="material-tabla">
            <thead class="material-tabla__thead">
                <tr class="material-tabla__fila material-tabla__fila--encabezado">
                    <th class="material-tabla__celda">ID</th>
                    <th class="material-tabla__celda">Material</th>
                    <th class="material-tabla__celda">Tipo</th>
                    <th class="material-tabla__celda">Comentario</th>
                    <th class="material-tabla__celda">Usuario que lo alquiló</th>
                    <th class="material-tabla__celda">Fecha del alquiler</th>
                </tr>
            </thead>
            <tbody class="material-tabla__tbody">
                <?php foreach ($Lista_material_alquilado as $row): ?>
                    <tr class="material-tabla__fila">
                        <td class="material-tabla__celda"><?= htmlspecialchars($row["id"]) ?></td>
                        <td class="material-tabla__celda"><?= htmlspecialchars($row["nombre"]) ?></td>
                        <td class="material-tabla__celda"><?= htmlspecialchars($row["tipo"]) ?></td>
                        <td class="material-tabla__celda"><?= htmlspecialchars($row["comentario"]) ?></td>
                        <td class="material-tabla__celda"><?= htmlspecialchars($row["nombre_usuario"]) ?></td>
                        <td class="material-tabla__celda">
                            <?php
                            $fecha = new DateTime($row["fecha_alquiler"]);
                            echo $fecha->format('d/m/Y \a\ \l\a\s H:i:s');
                            ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        </div>
       
    </div>
</div>



<div class="material-formulario">
    <h2 class="material-formulario__titulo">Material seleccionado</h2>
    <form class="material-formulario__form" action="" method="post">

        <div class="material-formulario__grupo">
            <label class="material-formulario__label" for="nombre">Material:</label>
            <p class="material-formulario__valor" id="nombre">UNO</p>
        </div>

        <div class="material-formulario__grupo">
            <label class="material-formulario__label" for="tipo">Tipo:</label>
            <p class="material-formulario__valor" id="tipo">Cartas</p>
        </div>

        <div class="material-formulario__grupo">
            <label class="material-formulario__label" for="fecha">Fecha de alquiler:</label>
            <p class="material-formulario__valor" id="fecha">07/04/2025 a las 18:03:50</p>
        </div>

        <div class="material-formulario__grupo">
            <label class="material-formulario__label" for="usuario">Usuario que lo alquiló:</label>
            <p class="material-formulario__valor" id="usuario">manuel</p>
        </div>

        <div class="material-formulario__grupo">
            <label class="material-formulario__label" for="comentario">Comentario:</label>
            <textarea class="material-formulario__textarea" name="comentario" id="comentario"></textarea>
        </div>

       

      

        <input type="hidden" name="id" >

        <div class="material-formulario__botones">
            <input class="material-formulario__boton" type="submit" value="Devolver" name="devolver">
            <input class="material-formulario__boton" type="submit" value="Dar de baja" name="devolver">
            <input class="material-formulario__boton" type="submit" value="Reparar" name="devolver">
        </div>
    </form>
</div>