<?php
require('fpdf/fpdf.php');
include('db.php'); // Conexión a la BD

class PDF extends FPDF
{
    function Header()
    {
        // ---- LOGO ----
        $this->Image('public/img/Logo.jpg', 10, 8, 25); // (ruta, x, y, tamaño)

        // ---- NOMBRE DE LA EMPRESA ----
        $this->SetFont('Arial', 'B', 14);
        $this->SetTextColor(30, 115, 190); // Azul suave
        $this->Cell(0, 7, utf8_decode('ESTUDIO JURÍDICO MONTES'), 0, 1, 'C');

        // ---- DIRECCIÓN ----
        $this->SetFont('Arial', '', 11);
        $this->SetTextColor(0);
        $this->Cell(0, 6, utf8_decode('Avenida Billingurts 1125 Of. 305  San Juan de Miraflores'), 0, 1, 'C');

        // ---- FECHA ----
        $this->Cell(0, 6, 'Fecha: ' . date("d/m/Y"), 0, 1, 'C');

        // Separación
        $this->Ln(5);

        // ---- TÍTULO DEL REPORTE ----
        $this->SetFont('Arial', 'B', 13);
        $this->SetTextColor(30, 115, 190);
        $this->Cell(0, 10, utf8_decode('REPORTE DE CLIENTES'), 0, 1, 'C');
        $this->Ln(3);

        // ---- ENCABEZADOS DE TABLA ----
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(30, 115, 190); // Azul suave
        $this->SetTextColor(255);

        // Mover tabla al centro (X = 5 para tabla de 200mm)
        $this->SetX(5);

        $this->Cell(20, 10, utf8_decode('N°'), 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode('Nombres'), 1, 0, 'C', true);
        $this->Cell(40, 10, utf8_decode('Apellidos'), 1, 0, 'C', true);
        $this->Cell(25, 10, utf8_decode('DNI'), 1, 0, 'C', true);
        $this->Cell(30, 10, utf8_decode('Teléfono'), 1, 0, 'C', true);
        $this->Cell(45, 10, utf8_decode('Correo'), 1, 1, 'C', true);
    }

    function Footer()
    {
        // Posición
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 9);
        $this->SetTextColor(128);

        // Número de página
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);
$pdf->SetTextColor(0);

// Margen X centrado para la tabla
$inicioX = 5;

// Consulta
$sql = "SELECT * FROM cliente ORDER BY id_cliente DESC";
$resultado = $conexion->query($sql);

$contador = 1;

if ($resultado->num_rows > 0) {
    while ($fila = $resultado->fetch_assoc()) {

        // Fila centrada
        $pdf->SetX($inicioX);

        $pdf->Cell(20, 10, $contador, 1, 0, 'C');
        $pdf->Cell(40, 10, utf8_decode($fila['nombres']), 1, 0, 'L');
        $pdf->Cell(40, 10, utf8_decode($fila['apellidos']), 1, 0, 'L');
        $pdf->Cell(25, 10, $fila['dni'], 1, 0, 'C');
        $pdf->Cell(30, 10, $fila['telefono'], 1, 0, 'C');
        $pdf->Cell(45, 10, utf8_decode($fila['correo']), 1, 1, 'L');

        $contador++;
    }
} else {
    $pdf->SetX($inicioX);
    $pdf->Cell(200, 10, 'No hay clientes registrados', 1, 1, 'C');
}

$pdf->Output('I', 'Reporte_Clientes.pdf');
?>