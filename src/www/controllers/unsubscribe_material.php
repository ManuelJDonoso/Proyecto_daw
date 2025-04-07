<?php



if ($_SERVER["REQUEST_METHOD"] == "POST")  {
  
   $stmt = $pdo->prepare("UPDATE unidad_material SET estado = 'No disponible' , fecha_baja_material = ? where id = ?");
   $stmt->execute([date('Y-m-d H:i:s'),$_POST["id"]]);

   
}

// obtener masterial tipo disponible
$stmt = $pdo->prepare("SELECT * FROM tipo_material ORDER BY id");
$stmt->execute();
$tipo_material = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM vista_unidad_material_disponible");
$stmt->execute();

$busqueda_material = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
      // Get all the forms with the class "unsubscribe__form"
      const forms = document.querySelectorAll('.unsubscribe__form');

      // Add event listener to each form
      forms.forEach(form => {
        form.addEventListener('submit', function(event) {
          // Prevent the default form submission
          event.preventDefault();

          // Ask the user for confirmation
          const confirmation = confirm('¿Estás seguro de que deseas dar de baja este elemento?');

          // If the user confirms, submit the form
          if (confirmation) {
            form.submit();
          }
        });
      });
    });




    

    document.addEventListener("DOMContentLoaded", function() {
    const idInput = document.querySelector('input[name="id"]');
    const nombreInput = document.querySelector('input[name="nombre"]');
    const tipoMaterialSelect = document.querySelector('select[name="tipo-material"]');
    const tablaBody = document.querySelector('.unsubscribe__table-body');

    function filtrarTabla() {
        const idValue = idInput.value.toLowerCase();
        const nombreValue = nombreInput.value.toLowerCase();
        const tipoMaterialValue = tipoMaterialSelect.value;
        
        const filas = tablaBody.getElementsByTagName('tr');

        for (let fila of filas) {
            const idCell = fila.cells[0].textContent.toLowerCase();
            const nombreCell = fila.cells[1].textContent.toLowerCase();
            const tipoCell = fila.cells[3].textContent.toLowerCase();  // Asegúrate de que esto coincida con el tipo de material
            
            const matchesId = idValue === '' || idCell.includes(idValue);
            const matchesNombre = nombreValue === '' || nombreCell.includes(nombreValue);
            const matchesTipoMaterial = tipoMaterialValue === '0' || tipoCell.toLowerCase().includes(tipoMaterialValue.toLowerCase()); // Filtrado por tipo de material

           
            fila.style.display = matchesId && matchesNombre && matchesTipoMaterial ? '' : 'none';
        }
    }

    idInput.addEventListener('input', filtrarTabla);
    nombreInput.addEventListener('input', filtrarTabla);
    tipoMaterialSelect.addEventListener('change', filtrarTabla);
});


  </script>