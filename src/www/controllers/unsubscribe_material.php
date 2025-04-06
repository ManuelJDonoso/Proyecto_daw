<?php

$stmt = $pdo->prepare("SELECT * FROM vista_unidad_material_disponible");
$stmt->execute();

$busqueda_material = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST")  {
  
   $stmt = $pdo->prepare("UPDATE unidad_material SET estado = 'No disponible' , fecha_baja_material = ? where id = ?");
   $stmt->execute([date('Y-m-d H:i:s'),$_POST["id"]]);

   
}

// obtener masterial tipo disponible
$stmt = $pdo->prepare("SELECT * FROM tipo_material ORDER BY id");
$stmt->execute();
$tipo_material = $stmt->fetchAll(PDO::FETCH_ASSOC);
