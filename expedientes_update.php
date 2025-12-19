<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: expedientes.php");
    exit;
}

$id = isset($_POST['id_expediente']) ? intval($_POST['id_expediente']) : 0;
$numero   = isset($_POST['numero_expediente']) ? trim($_POST['numero_expediente']) : '';
$anio     = isset($_POST['anio_expediente']) ? intval($_POST['anio_expediente']) : null;
$materia  = isset($_POST['materia']) ? trim($_POST['materia']) : '';
$id_juzgado = isset($_POST['id_juzgado']) ? intval($_POST['id_juzgado']) : null;
$fecha_inicio = !empty($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : null;

if ($id <= 0 || $numero === '' || $anio === 0 || $materia === '' || $id_juzgado === 0) {
    die("Datos inválidos.");
}

$stmt = $conexion->prepare("UPDATE expediente SET numero_expediente = ?, anio_expediente = ?, materia = ?, id_juzgado = ?, fecha_inicio = ? WHERE id_expediente = ?");
$stmt->bind_param("sisisi", $numero, $anio, $materia, $id_juzgado, $fecha_inicio, $id);

if ($stmt->execute()) {
    $stmt->close();
    header("Location: expedientes.php?msg=actualizado");
    exit;
} else {
    echo "Error al actualizar: " . $conexion->error;
    $stmt->close();
}
