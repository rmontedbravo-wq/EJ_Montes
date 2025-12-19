<?php 
include 'db.php';

$numero = $_POST['numero_expediente'];
$anio = $_POST['anio_expediente'];
$materia = $_POST['materia'];
$id_juzgado = $_POST['id_juzgado'];

$sql = "INSERT INTO expediente (numero_expediente, anio_expediente, materia, id_juzgado)
        VALUES ('$numero', '$anio', '$materia', '$id_juzgado')";

$conexion->query($sql);

header("Location: expedientes.php");