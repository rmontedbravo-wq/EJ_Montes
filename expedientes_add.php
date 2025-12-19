<?php 
$pageTitle = 'Agregar Expediente';
$activePage = 'expedientes';

include 'includes/header.php';
include 'includes/sidebar.php';
include 'db.php';

$juzgados = $conexion->query("SELECT * FROM juzgado");
?>

<div class="container-fluid">

<h1 class="h3 mb-4 text-gray-800">Nuevo Expediente</h1>

<div class="card shadow col-md-6 p-4">
<form action="expedientes_save.php" method="POST">

    <div class="form-group">
        <label>Número de Expediente</label>
        <input type="text" name="numero_expediente" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Año</label>
        <input type="number" name="anio_expediente" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Materia</label>
        
        <select name="materia" class="form-control" required>
    <option value="">Seleccione la materia</option>
    <option value="Laboral">Laboral</option>
    <option value="Civil">Civil</option>
    <option value="Penal">Penal</option>
    <option value="Familia">Familia</option>
    <option value="Constitucional">Constitucional</option>
</select>
        
    </div>

    <div class="form-group">
        <label>Juzgado</label>
                <select name="id_juzgado" class="form-control" required>
            <option value="">Seleccione</option>
            <?php while($j = $juzgados->fetch_assoc()): ?>
                <option value="<?= $j['id_juzgado'] ?>">
                    <?= $j['nombre_juzgado'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <button class="btn btn-success mt-3">Guardar</button>
</form>
</div>

</div>

<?php include 'includes/footer.php'; ?>