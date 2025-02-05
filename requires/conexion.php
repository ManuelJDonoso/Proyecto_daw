<?php
// Configuración de la base de datos
$host = 'manueldonoso.es';
$dbname = 'proyecto_daw';
$user = 'proyecto_daw';
$pass = 'Proy3cto_D@';

// DSN (Data Source Name) para la conexión con MySQL
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

// Opciones para mejorar la seguridad y manejo de errores
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Manejo de errores con excepciones
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Devolver los datos como array asociativo
    PDO::ATTR_EMULATE_PREPARES => false, // Desactivar la emulación de consultas preparadas
];

try {
    // Crear la conexión a la base de datos
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // En caso de error, detener el script y mostrar mensaje (evitar mostrar detalles en producción)
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>
