<?php 
$pageTitle = 'Editar Expediente';
$activePage = 'expedientes';

include 'includes/header.php';
include 'includes/sidebar.php';
include 'db.php';

$id = $_GET['id'];

$exp = $conexion->query("SELECT * FROM expediente WHERE id_expediente = $id")->fetch_assoc();
$juzgados = $conexion->query("SELECT * FROM juzgado");
?>

<div class="container-fluid">

<h1 class="h3 mb-4">Editar Expediente</h1>

<div class="card shadow col-md-6 p-4">

<form action="expedientes_update.php" method="POST">
    <input type="hidden" name="id_expediente" value="<?= $exp['id_expediente'] ?>">

    <div class="form-group">
        <label>Número</label>
        <input name="numero_expediente" class="form-control" 
               value="<?= $exp['numero_expediente'] ?>" required>
    </div>

    <div class="form-group">
        <label>Año</label>
        <input name="anio_expediente" type="number" class="form-control" 
               value="<?= $exp['anio_expediente'] ?>" required>
    </div>

    <div class="form-group">
        <label>Materia</label>
        <input name="materia" class="form-control" 
               value="<?= $exp['materia'] ?>" required>
    </div>

    <div class="form-group">
        <label>Juzgado</label>
        <select name="id_juzgado" class="form-control" required>
            <?php while($j = $juzgados->fetch_assoc()): ?>
                <option value="<?= $j['id_juzgado'] ?>" 
                    <?= $j['id_juzgado'] == $exp['id_juzgado'] ? 'selected' : '' ?>>
                    <?= $j['nombre_juzgado'] ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <button class="btn btn-primary mt-3">Actualizar</button>

</form>

</div>
</div>

<?php include 'includes/footer.php'; ?>