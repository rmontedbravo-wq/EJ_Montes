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
        $this->Cell(0, 10, utf8_decode('REPORTE DE EXPEDIENTES'), 0, 1, 'C');
        $this->Ln(3);

        // ENCABEZADOS
        $this->SetFont('Arial', 'B', 9);
        $this->SetFillColor(30, 115, 190);
        $this->SetTextColor(255);

        $this->SetX(5);
        $this->Cell(10, 10, 'N°', 1, 0, 'C', true);
        $this->Cell(35, 10, utf8_decode('Expediente'), 1, 0, 'C', true);
        $this->Cell(15, 10, utf8_decode('Año'), 1, 0, 'C', true);
        $this->Cell(30, 10, utf8_decode('Materia'), 1, 0, 'C', true);
        $this->Cell(30, 10, utf8_decode('Estado'), 1, 0, 'C', true);
        $this->Cell(25, 10, utf8_decode('Cliente ID'), 1, 0, 'C', true);
        $this->Cell(30, 10, utf8_decode('Fecha Inicio'), 1, 1, 'C', true);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 9);
        $this->SetTextColor(128);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 9);
$pdf->SetTextColor(0);

$inicioX = 5;

// CONSULTA A EXPEDIENTE
$sql = "SELECT * FROM expediente ORDER BY id_expediente DESC";
$resultado = $conexion->query($sql);

$contador = 1;

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {

        $pdf->SetX($inicioX);

        $pdf->Cell(10, 10, $contador, 1, 0, 'C');
        $pdf->Cell(35, 10, utf8_decode($fila['numero_expediente']), 1, 0, 'L');
        $pdf->Cell(15, 10, $fila['anio_expediente'], 1, 0, 'C');
        $pdf->Cell(30, 10, utf8_decode($fila['materia']), 1, 0, 'L');
        $pdf->Cell(30, 10, utf8_decode($fila['estado_proceso']), 1, 0, 'L');
        $pdf->Cell(25, 10, $fila['id_cliente'], 1, 0, 'C');
        $pdf->Cell(30, 10, $fila['fecha_inicio'], 1, 1, 'C');

        $contador++;
    }
} else {
    $pdf->SetX($inicioX);
    $pdf->Cell(175, 10, 'No hay expedientes registrados', 1, 1, 'C');
}

$pdf->Output('I', 'Reporte_Expedientes.pdf');
?>