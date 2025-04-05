<?php

 // obtener masterial disponible
 $stmt = $pdo->prepare("SELECT * FROM vista_material_disponible_cantidad");
 $stmt->execute();
 $material_disponible = $stmt->fetchAll(PDO::FETCH_ASSOC);

