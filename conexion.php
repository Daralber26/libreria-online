<?php
$host = "sql202.infinityfree.com";
$nombre_bd = "if0_42596192_libreria";
$usuario = "if0_42596192";
$contrasena = "Dariel123456";

try {
    $conexion = new PDO("mysql:host=$host;dbname=$nombre_bd;charset=utf8mb4", $usuario, $contrasena);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>