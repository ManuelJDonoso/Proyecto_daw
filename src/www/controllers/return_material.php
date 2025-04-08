<?PHP

// para paginacion $stmt = $pdo->prepare("SELECT * FROM vista_material_alquilado Limit 5 OFFSET 5");
$stmt = $pdo->prepare("SELECT * FROM vista_material_alquilado");
$stmt->execute();
$Lista_material_alquilado = $stmt->fetchAll(PDO::FETCH_ASSOC);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $comentario = $_POST["comentario"];
    $id = $_POST["id"];
    $now = date('Y-m-d H:i:s');
    switch ($_POST["devolver"]) {
        case 'Devolver':

            try {

                $stmt = $pdo->prepare("UPDATE alquiler_material SET fecha_devolucion = ? WHERE unidad_id = ?");
                $success = $stmt->execute([$now, $id]);

                $stmt = $pdo->prepare("UPDATE unidad_material SET estado = ? , comentario = ? WHERE id = ?");
                $success = $stmt->execute(['disponible', $comentario, $id]);

                $stmt = $pdo->prepare("UPDATE historial_material SET  observaciones = ? WHERE fecha_devolucion = ?");
                $success = $stmt->execute([$comentario, $now]);
            } catch (\Throwable $th) {
                echo "no realizada";
            }


            break;


        case 'Dar de baja':
            $stmt = $pdo->prepare("UPDATE alquiler_material SET fecha_devolucion = ? WHERE unidad_id = ?");
            $success = $stmt->execute([$now, $id]);

            $stmt = $pdo->prepare("UPDATE unidad_material SET estado = ? , comentario = ?,fecha_baja_material = ? WHERE id = ?");
            $success = $stmt->execute(['No disponible', $comentario, $now, $id]);

            $stmt = $pdo->prepare("UPDATE historial_material SET observaciones = ? WHERE fecha_devolucion = ?");
            $success = $stmt->execute([$comentario, $now]);
            break;


        case 'Reparar':

            $stmt = $pdo->prepare("UPDATE alquiler_material SET fecha_devolucion = ? WHERE unidad_id = ?");
            $success = $stmt->execute([$now, $id]);

            $stmt = $pdo->prepare("UPDATE unidad_material SET estado = ? , comentario = ? WHERE id = ?");
            $success = $stmt->execute(['No disponible', $comentario, $id]);

            $stmt = $pdo->prepare("UPDATE historial_material SET observaciones = ? WHERE fecha_devolucion = ?");
            $success = $stmt->execute([$comentario, $now]);
            break;
        default:
            # code...
            break;
    }
}


$stmt = $pdo->prepare("SELECT * FROM vista_material_alquilado");
$stmt->execute();
$Lista_material_alquilado = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const filas = document.querySelectorAll("table tbody tr");

        filas.forEach(fila => {
            fila.addEventListener("click", () => {
                const celdas = fila.querySelectorAll("td");

                // Rellenar los elementos del formulario
                document.getElementById("nombre").textContent = celdas[1].textContent.trim();
                document.getElementById("tipo").textContent = celdas[2].textContent.trim();
                document.getElementById("comentario").value = celdas[3].textContent.trim();
                document.getElementById("usuario").textContent = celdas[4].textContent.trim();
                document.getElementById("fecha").textContent = celdas[5].textContent.trim();

                // También rellenamos el campo oculto con el ID
                document.querySelector('input[name="id"]').value = celdas[0].textContent.trim();
            });
        });
    });



    function ocultar() {
        const oculto = document.getElementById("contenido");
        if (oculto.classList.contains("hidden")) {
            oculto.classList.remove("hidden")
        } else {
            oculto.classList.add("hidden")
        }

    }


    //filtros

    document.addEventListener("DOMContentLoaded", function() {
        const inputs = document.querySelectorAll('.filters--alquilado__input');
        const filas = document.querySelectorAll('.material-tabla__tbody .material-tabla__fila');

        inputs.forEach(input => {
            input.addEventListener('input', () => {
                const filtros = {
                    id: document.querySelector('input[name="id__filters"]').value.trim().toLowerCase(),
                    material: document.querySelector('input[name="material"]').value.trim().toLowerCase(),
                    tipo: document.querySelector('input[name="tipo"]').value.trim().toLowerCase(),
                    usuario: document.querySelector('input[name="usuario"]').value.trim().toLowerCase(),
                    fecha: document.querySelector('input[name="date-id"]').value.trim(), // formato yyyy-mm-dd
                };

                filas.forEach(fila => {
                    const celdas = fila.querySelectorAll('.material-tabla__celda');
                    const datos = {
                        id: celdas[0].textContent.trim().toLowerCase(),
                        material: celdas[1].textContent.trim().toLowerCase(),
                        tipo: celdas[2].textContent.trim().toLowerCase(),
                        usuario: celdas[4].textContent.trim().toLowerCase(),
                        fecha: celdas[5].textContent.trim(), // ejemplo: "08/04/2025 a las 18:08:21"
                    };

                    // Convertimos la fecha a formato yyyy-mm-dd para comparar
                    const fechaTexto = datos.fecha.split(" a las")[0]; // "08/04/2025"
                    const [d, m, y] = fechaTexto.split("/");
                    const fechaFormateada = `${y}-${m}-${d}`;

                    const coincide =
                        (!filtros.id || datos.id.includes(filtros.id)) &&
                        (!filtros.material || datos.material.includes(filtros.material)) &&
                        (!filtros.tipo || datos.tipo.includes(filtros.tipo)) &&
                        (!filtros.usuario || datos.usuario.includes(filtros.usuario)) &&
                        (!filtros.fecha || fechaFormateada === filtros.fecha);

                    fila.style.display = coincide ? "" : "none";
                });
            });
        });
    });
</script>