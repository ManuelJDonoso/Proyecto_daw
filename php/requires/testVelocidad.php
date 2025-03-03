<?php
$inicio = microtime(true);

require_once 'conexion.php'; // Importa la conexión

$fin = microtime(true);
$tiempo = $fin - $inicio;

echo "Tiempo de conexión: " . number_format($tiempo, 4) . " segundos";
?>
