<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("INSERT INTO alquiler_material (unidad_id,usuario_id) values(?,?)");
    $success = $stmt->execute([$_POST["id_juego"],$_POST["id_jugador"]]);
    //UPDATE `unidad_material` SET `estado` = 'disponible' WHERE `unidad_material`.`id` = 8; 
    $stmt =$pdo->prepare("UPDATE unidad_material SET estado='alquilado' WHERE unidad_material.id=?");
    $success = $stmt->execute([$_POST["id_juego"]]);



}

$stmt = $pdo->prepare("SELECT * FROM vista_material_disponible");
$stmt->execute();
$Lista_material_disponible = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->prepare("SELECT * FROM vista_material_alquilado WHERE nombre_usuario = ?");
$stmt->execute([$usuario->get_nombre_usuario()]);
$Lista_material_alquilado = $stmt->fetchAll(PDO::FETCH_ASSOC);


