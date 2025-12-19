<?php
require('fpdf/fpdf.php');
include('db.php');

class PDF extends FPDF
{
    function Header()
    {
        // LOGO
        $this->Image('public/img/Logo.jpg', 10, 8, 25);

        // NOMBRE DEL ESTUDIO
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(30, 115, 190);
        $this->Cell(0, 7, utf8_decode('ESTUDIO JURÍDICO MONTES'), 0, 1, 'C');

        // DIRECCIÓN
        $this->SetFont('Arial', '', 11);
        $this->SetTextColor(0);
        $this->Cell(0, 6, utf8_decode('Av. Billinghurst 1125 Of. 305 - San Juan de Miraflores'), 0, 1, 'C');

        // FECHA
        $this->Cell(0, 6, 'Fecha: ' . date("d/m/Y"), 0, 1, 'C');
        $this->Ln(5);

        // TÍTULO
        $this->SetFont('Arial', 'B', 13);
        $this->SetTextColor(30, 115, 190);
        $this->Cell(0, 10, utf8_decode('REPORTE DE PAGOS'), 0, 1, 'C');
        $this->Ln(3);

        // ENCABEZADOS
        $this->SetFont('Arial', 'B', 9);
        $this->SetFillColor(30, 115, 190);
        $this->SetTextColor(255);

        $this->SetX(5);
        $this->Cell(10, 10, 'N°', 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode('Fecha Pago'), 1, 0, 'C', true);
        $this->Cell(30, 10, utf8_decode('Monto S/'), 1, 0, 'C', true);
        $this->Cell(35, 10, utf8_decode('Medio Pago'), 1, 0, 'C', true);
        $this->Cell(70, 10, utf8_decode('Observación'), 1, 1, 'C', true);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 9);
        $this->SetTextColor(128);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }
}

// Crear PDF
$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(0);

$inicioX = 5;

// CONSULTA A PAGOS
$sql = "SELECT * FROM pago ORDER BY id_pago ASC";
$resultado = $conexion->query($sql);

$contador = 1;

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {
        $pdf->SetX($inicioX);
        $pdf->Cell(10, 10, $contador, 1, 0, 'C');
        $pdf->Cell(40, 10, $fila['fecha_pago'], 1, 0, 'C');
        $pdf->Cell(30, 10, number_format($fila['monto_pagado'], 2), 1, 0, 'R');
        $pdf->Cell(35, 10, utf8_decode($fila['medio_pago']), 1, 0, 'C');
        $pdf->Cell(70, 10, utf8_decode($fila['observacion']), 1, 1, 'L');

        $contador++;
    }
} else {
    $pdf->SetX($inicioX);
    $pdf->Cell(185, 10, 'No hay pagos registrados', 1, 1, 'C');
}

$pdf->Output('I', 'Reporte_Pagos.pdf');
?>