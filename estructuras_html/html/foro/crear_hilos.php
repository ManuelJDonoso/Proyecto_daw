<?php
$pdo = include_once 'db/conexion.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    //die("Debes iniciar sesión para crear un tema.");
}
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $title =" $_POST['title']";
    $user_id = $_SESSION['user_id'];
    
    $stmt = $pdo->prepare("INSERT INTO hilos (title, fk_id_user) VALUES (?, ?)");
    $stmt->execute([$title, $user_id]);
    header("Location: index.php");
}

