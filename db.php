<?php
$host = "localhost";
$user = "usuario_db";
$pass = "password_db";
$db   = "nombre_bd";

$conexion = new mysqli($servidor, $usuario, $clave, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

?>
