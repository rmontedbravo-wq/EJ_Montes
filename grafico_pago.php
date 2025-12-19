<?php
// grafico_pago.php
// ===============================
// DATOS PARA GRÁFICO PIE (PAGADO VS FALTA PAGAR)
// ===============================

include 'db.php';

// Etiquetas del gráfico
$labelsPago = ['Pagado', 'Falta pagar'];
$valuesPago = [0, 0];

// Consulta SQL basada en tu estructura REAL
$sql = "
SELECT 
    CASE 
        WHEN monto_pagado > 0 THEN 'Pagado'
        ELSE 'Falta pagar'
    END AS estado,
    COUNT(*) AS total
FROM pago
GROUP BY estado
";

$resultado = $conexion->query($sql);

// Validación básica
if ($resultado) {
    while ($fila = $resultado->fetch_assoc()) {
        if ($fila['estado'] === 'Pagado') {
            $valuesPago[0] = (int)$fila['total'];
        } else {
            $valuesPago[1] = (int)$fila['total'];
        }
    }
}
?>