<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'proyecto_daw';
$user = 'root';
$pass = 'manuel';

try {
    // Crear conexión con PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    
    // Configurar PDO para lanzar excepciones en caso de error
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Configurar PDO para usar FETCH_ASSOC por defecto
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // En caso de error, mostrar mensaje y detener la ejecución
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
// Exportar la variable $pdo para que esté disponible en otros archivos
return $pdo;
?>
