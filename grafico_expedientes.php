<?php
include 'db.php';

// CONSULTA: EXPEDIENTES POR MATERIA
$labels = [];
$values = [];

$sql = "SELECT materia, COUNT(*) AS total
        FROM expediente
        GROUP BY materia
        ORDER BY total DESC";

$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    $labels[] = $fila['materia'];
    $values[] = (int)$fila['total'];
}
?>
