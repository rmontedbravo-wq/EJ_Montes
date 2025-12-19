<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("ID no válido.");
}

$id = intval($_GET['id']); // Seguridad

// CONSULTA PREPARADA para evitar SQL Injection
$stmt = $conexion->prepare("DELETE FROM expediente WHERE id_expediente = ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();

// Redirigir a la lista correcta
header("Location: expedientes.php");
exit;
?>
