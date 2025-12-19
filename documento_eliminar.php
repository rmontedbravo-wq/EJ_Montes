<?php
include 'db.php';

/* VALIDAR ID */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: documento.php");
    exit;
}

$id = intval($_GET['id']);

/* OBTENER RUTA DEL ARCHIVO */
$stmt = $conexion->prepare("SELECT ruta_archivo FROM documento WHERE id_documento = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$doc = $resultado->fetch_assoc();
$stmt->close();

if (!$doc) {
    header("Location: documento.php");
    exit;
}

/* ELIMINAR ARCHIVO FÍSICO */
$ruta = $doc['ruta_archivo'];

if (file_exists($ruta)) {
    unlink($ruta); // elimina el PDF
}

/* ELIMINAR REGISTRO BD */
$stmt = $conexion->prepare("DELETE FROM documento WHERE id_documento = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->close();

header("Location: documento.php?msg=eliminado");
exit;