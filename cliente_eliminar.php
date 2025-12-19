<?php
// Archivo: cliente_eliminar.php

include 'db.php'; // Conexión a la BD

// Validar que el ID exista y sea numérico
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: cliente.php");
    exit();
}

$id = intval($_GET['id']);

// Ejecutar eliminación
$sql = $conexion->query("DELETE FROM cliente WHERE id_cliente = $id");

// Redirigir al listado
header("Location: cliente.php");
exit();
?>
