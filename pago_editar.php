<?php 
$pageTitle = 'Editar Pago';
$activePage = 'pago';

include 'includes/header.php';
include 'includes/sidebar.php';
include 'db.php';

/* VALIDAR ID */
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: pago.php");
    exit;
}

$id = (int) $_GET['id'];

/* OBTENER DATOS DEL PAGO */
$stmt = $conexion->prepare("SELECT * FROM pago WHERE id_pago = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
$pago = $resultado->fetch_assoc();
$stmt->close();

if (!$pago) {
    header("Location: pago.php");
    exit;
}

/* LISTAR ETAPAS */
$etapas = $conexion->query("SELECT * FROM etapa");
?>

<div class="container-fluid">

    <h1 class="h3 mb-4">Editar Pago</h1>

    <div class="card shadow col-md-6 p-4">

        <form action="pago_update.php" method="POST">

            <input type="hidden" name="id_pago" value="<?= $pago['id_pago']; ?>">

            <!-- ETAPA -->
            <div class="form-group">
                <label>Etapa</label>
                <select name="id_etapa" class="form-control" required>
                    <option value="">Seleccione etapa</option>
                    <?php while ($e = $etapas->fetch_assoc()): ?>
                        <option value="<?= $e['id_etapa']; ?>"
                            <?= ($e['id_etapa'] == $pago['id_etapa']) ? 'selected' : ''; ?>>
                            <?= $e['nombre_etapa']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <!-- FECHA -->
            <div class="form-group">
                <label>Fecha de Pago</label>
                <input type="datetime-local"
                       name="fecha_pago"
                       class="form-control"
                       value="<?= date('Y-m-d\TH:i', strtotime($pago['fecha_pago'])); ?>"
                       required>
            </div>

            <!-- MONTO -->
            <div class="form-group">
                <label>Monto Pagado</label>
                <input type="number"
                       step="0.01"
                       name="monto_pagado"
                       class="form-control"
                       value="<?= $pago['monto_pagado']; ?>"
                       required>
            </div>

            <!-- MEDIO DE PAGO -->
            <div class="form-group">
                <label>Medio de Pago</label>
                <input type="text"
                       name="medio_pago"
                       class="form-control"
                       value="<?= $pago['medio_pago']; ?>"
                       required>
            </div>

            <!-- OBSERVACIÓN -->
            <div class="form-group">
                <label>Observación</label>
                <textarea name="observacion"
                          class="form-control"
                          rows="3"><?= $pago['observacion']; ?></textarea>
            </div>

            <button class="btn btn-primary mt-3">
                Actualizar
            </button>

            <a href="pago.php" class="btn btn-secondary mt-3">
                Cancelar
            </a>

        </form>

    </div>
</div>

<?php include 'includes/footer.php'; ?>