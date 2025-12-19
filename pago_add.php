<?php include("includes/header.php"); ?>
<?php include("db.php"); ?>

<?php
if ($_POST) {
    $expediente = $_POST['expediente'];
    $fecha = $_POST['fecha'];
    $monto = $_POST['monto'];
    $descripcion = $_POST['descripcion'];

    $sql = "INSERT INTO pago (expediente_id, fecha_pago, monto, descripcion)
            VALUES ('$expediente', '$fecha', '$monto', '$descripcion')";

    if ($conexion->query($sql)) {
        echo "<script>alert('Pago registrado correctamente'); window.location='pago.php';</script>";
    }
}
?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Registrar Pago</h1>

    <form method="POST">
        <div class="card shadow p-4">

            <div class="form-group">
                <label>Expediente</label>
                <select name="expediente" class="form-control" required>
                    <option value="">Seleccione</option>
                    <?php
                    $exp = $conexion->query("SELECT * FROM expediente");
                    while ($e = $exp->fetch_assoc()):
                    ?>
                        <option value="<?= $e['id']; ?>"><?= $e['numero_expediente']; ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Fecha del Pago</label>
                <input type="date" name="fecha" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Monto</label>
                <input type="number" step="0.01" name="monto" class="form-control" required>
            </div>

            <div class="form-group">
                <label>Descripción</label>
                <textarea name="descripcion" class="form-control"></textarea>
            </div>

            <button class="btn btn-success">Guardar</button>
            <a href="pago.php" class="btn btn-secondary">Cancelar</a>

        </div>
    </form>
</div>

<?php include("includes/footer.php"); ?>
