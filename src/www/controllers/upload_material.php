<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"] ?? "";
    $tipo_material = $_POST["tipo-material"] ?? "";
    $descripcion = $_POST["descripcion"] ?? "";
    $edad_recomendada = $_POST["edad_recomendada"] ?? "";
    $comentario = $_POST["comentario"] ?? "";

    //si no existe el material lo crea
    $stmt = $pdo->prepare("SELECT nombre,descripcion, edad_recomendada,tipo_id FROM material WHERE nombre = ? and descripcion = ? and edad_recomendada =? and tipo_id = ?");
    $stmt->execute([$nombre, $descripcion, $edad_recomendada, $tipo_material]);

    $busqueda_material = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($busqueda_material)) {

        $stmt = $pdo->prepare("INSERT INTO material ( nombre,descripcion, edad_recomendada,tipo_id) VALUES (?,?,?,?)");
        $stmt->execute([$nombre, $descripcion, $edad_recomendada, $tipo_material]);
    }

    //da de alta al material
    $stmt = $pdo->prepare("SELECT id,nombre,descripcion, edad_recomendada,tipo_id FROM material WHERE nombre = ? and descripcion = ? and edad_recomendada =? and tipo_id = ?");
    $stmt->execute([$nombre, $descripcion, $edad_recomendada, $tipo_material]);

    $busqueda_material = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!empty($busqueda_material)) {

        $stmt = $pdo->prepare("INSERT INTO unidad_material ( material_id,estado, comentario) VALUES (?,?,?)");
        $stmt->execute([$busqueda_material["id"], "disponible", $comentario]);
    }
}


// obtener masterial tipo disponible
$stmt = $pdo->prepare("SELECT * FROM tipo_material ORDER BY id");
$stmt->execute();
$tipo_material = $stmt->fetchAll(PDO::FETCH_ASSOC);


// obtener lista masterial disponible
$stmt = $pdo->prepare("SELECT nombre,descripcion, edad_recomendada,tipo_id FROM material");
$stmt->execute();
$material = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<script>
    // rellena los datos del elemento pulsado en la tabla
    document.addEventListener("DOMContentLoaded", function() {
        const tableRows = document.querySelectorAll(".material-table__table tbody tr");

        tableRows.forEach(row => {
            row.addEventListener("click", function() {
                const cells = row.querySelectorAll("td");
                if (cells.length >= 5) {
                    // Rellenar el formulario con los valores de la fila
                    document.querySelector('input[name="nombre"]').value = cells[1].innerText.trim();
                    document.querySelector('textarea[name="descripcion"]').value = cells[2].innerText.trim();
                    document.querySelector('select[name="tipo-material"]').value = cells[3].innerText.trim();
                    document.querySelector('input[name="edad_recomendada"]').value = cells[4].innerText.trim();

                    // Comentario no viene en la tabla, así que se limpia o mantiene
                    document.querySelector('textarea[name="comentario"]').value = '';
                }
            });
        });
    });


    //filtro para la tabla
    document.addEventListener("DOMContentLoaded", function() {
        const inputNombre = document.querySelector('input[name="nombre"]');
        const tableRows = document.querySelectorAll(".material-table__table tbody tr");

        // Oculta todas las filas al cargar
        tableRows.forEach(row => row.style.display = "none");

        inputNombre.addEventListener("input", function() {
            const filtro = inputNombre.value.toLowerCase();

            tableRows.forEach(row => {
                const nombreCelda = row.querySelectorAll("td")[1]; // Segunda celda: Nombre
                if (nombreCelda) {
                    const textoNombre = nombreCelda.innerText.toLowerCase();
                    if (textoNombre.includes(filtro) && filtro !== "") {
                        row.style.display = "";
                    } else {
                        row.style.display = "none";
                    }
                }
            });
        });
    });
</script>
