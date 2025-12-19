<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: documento.php");
    exit;
}

$id_expediente = intval($_POST['id_expediente']);

if (!isset($_FILES['archivo']) || $id_expediente <= 0) {
    die("Datos inválidos");
}

$archivo = $_FILES['archivo'];

$nombre_original = $archivo['name'];
$tipo = $archivo['type'];
$tmp = $archivo['tmp_name'];

$ext = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));

/* SOLO PDF */
if ($ext !== 'pdf') {
    die("Solo se permiten archivos PDF");
}

/* NOMBRE ÚNICO */
$nombre_nuevo = time() . "_" . $nombre_original;
$ruta = "uploads/documentos/" . $nombre_nuevo;

if (!move_uploaded_file($tmp, $ruta)) {
    die("Error al subir archivo");
}

/* GUARDAR EN BD */
$stmt = $conexion->prepare("
    INSERT INTO documento
    (id_expediente, nombre_archivo, ruta_archivo, tipo_archivo, fecha_subida)
    VALUES (?, ?, ?, ?, NOW())
");

$stmt->bind_param(
    "isss",
    $id_expediente,
    $nombre_original,
    $ruta,
    $tipo
);

$stmt->execute();
$stmt->close();

header("Location: documento.php?msg=subido");
exit;