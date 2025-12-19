<?php
include 'db.php';

/* SOLO PERMITIR POST */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: pago.php");
    exit;
}

/* DATOS DEL FORMULARIO */
$id_pago     = isset($_POST['id_pago']) ? intval($_POST['id_pago']) : 0;
$id_etapa    = isset($_POST['id_etapa']) ? intval($_POST['id_etapa']) : 0;
$fecha_pago  = $_POST['fecha_pago'] ?? '';
$monto       = $_POST['monto_pagado'] ?? '';
$medio_pago  = trim($_POST['medio_pago'] ?? '');
$observacion = trim($_POST['observacion'] ?? '');

/* VALIDACIONES */
if ($id_pago <= 0 || $id_etapa <= 0 || $fecha_pago === '' || $monto === '') {
    die("Datos inválidos");
}

/* ACTUALIZAR PAGO */
$stmt = $conexion->prepare(
    "UPDATE pago 
     SET id_etapa = ?, 
         fecha_pago = ?, 
         monto_pagado = ?, 
         medio_pago = ?, 
         observacion = ?
     WHERE id_pago = ?"
);

$stmt->bind_param(
    "isdssi",
    $id_etapa,
    $fecha_pago,
    $monto,
    $medio_pago,
    $observacion,
    $id_pago
);

if ($stmt->execute()) {
    $stmt->close();
    header("Location: pago.php");
    exit;
} else {
    die("Error al actualizar pago: " . $conexion->error);
}
?>