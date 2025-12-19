<?php
include 'db.php';

if (!isset($_GET['id'])) {
    die("ID no válido.");
}

$id = intval($_GET['id']); // Seguridad

// CONSULTA PREPARADA para evitar SQL Injection
$stmt = $conexion->prepare("DELETE FROM pago WHERE id_pago= ?");
$stmt->bind_param("i", $id);
$stmt->execute();

$stmt->close();

// Redirigir a la lista correcta
header("Location: pago.php");
exit;
?>
