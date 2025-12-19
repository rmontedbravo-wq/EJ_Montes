<?php
include 'db.php';

/* SOLO POST */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: documento.php");
    exit;
}

/* DATOS */
$id_expediente = isset($_POST['id_expediente']) ? intval($_POST['id_expediente']) : 0;

/* VALIDAR EXPEDIENTE */
if ($id_expediente <= 0) {
    die("Expediente inválido");
}

/* VALIDAR ARCHIVO */
if (!isset($_FILES['archivo']) || $_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
    die("Error al subir el archivo");
}

$archivo = $_FILES['archivo'];

$nombre_original = $archivo['name'];
$tipo_archivo    = $archivo['type'];
$tmp_archivo     = $archivo['tmp_name'];
$tamano_archivo  = $archivo['size'];

/* SOLO PDF */
$ext = strtolower(pathinfo($nombre_original, PATHINFO_EXTENSION));
if ($ext !== 'pdf') {
    die("Solo se permiten archivos PDF");
}

/* RENOMBRAR ARCHIVO (EVITA DUPLICADOS) */
$nombre_nuevo = time() . "_" . preg_replace('/[^a-zA-Z0-9_.-]/', '', $nombre_original);
$ruta = "documento" . $nombre_nuevo;

/* MOVER ARCHIVO */
if (!move_uploaded_file($tmp_archivo, $ruta)) {
    die("No se pudo guardar el archivo");
}

/* GUARDAR EN BD */
$stmt = $conexion->prepare(
    "INSERT INTO documento 
     (id_expediente, nombre_archivo, ruta_archivo, tipo_archivo, fecha_subida)
     VALUES (?, ?, ?, ?, NOW())"
);

$stmt->bind_param(
    "isss",
    $id_expediente,
    $nombre_original,
    $ruta,
    $tipo_archivo
);

if ($stmt->execute()) {
    $stmt->close();
    header("Location: documento.php?msg=subido");
    exit;
} else {
    die("Error al guardar en la base de datos");
}
?>

