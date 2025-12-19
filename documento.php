<?php
$pageTitle = 'Documentos';
$activePage = 'documentos';

include 'includes/header.php';
include 'includes/sidebar.php';
include 'db.php';

/* LISTAR EXPEDIENTES */
$expedientes = $conexion->query("
    SELECT id_expediente, numero_expediente 
    FROM expediente 
    ORDER BY id_expediente DESC
");

/* LISTAR DOCUMENTOS */
$documentos = $conexion->query("
    SELECT d.*, e.numero_expediente
    FROM documento d
    INNER JOIN expediente e ON d.id_expediente = e.id_expediente
    ORDER BY d.fecha_subida DESC
");
?>

<div class="container-fluid">

<h1 class="h3 mb-4">Documentos</h1>

<!-- SUBIR DOCUMENTO -->
<div class="card shadow mb-4 col-md-6">
    <div class="card-body">

        <h5 class="mb-3">Subir documento (PDF)</h5>

        <form action="documento_crear.php" method="POST" enctype="multipart/form-data">

            <div class="form-group">
                <label>Expediente</label>
                <select name="id_expediente" class="form-control" required>
                    <option value="">Seleccione expediente</option>
                    <?php while($e = $expedientes->fetch_assoc()): ?>
                        <option value="<?= $e['id_expediente'] ?>">
                            <?= $e['numero_expediente'] ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Archivo PDF</label>
                <input type="file" name="archivo" class="form-control"
                       accept="application/pdf" required>
            </div>

            <button class="btn btn-primary mt-2">
                <i class="fas fa-upload"></i> Subir Documento
            </button>

        </form>

    </div>
</div>

<!-- LISTA DE DOCUMENTOS -->
<div class="card shadow mb-4">
    <div class="card-body">

        <h5 class="mb-3">Documentos subidos</h5>

        <table class="table table-bordered table-sm">
            <thead class="thead-light">
                <tr>
                    <th>Expediente</th>
                    <th>Archivo</th>
                    <th>Tipo</th>
                    <th>Fecha</th>
                    <th width="160">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while($d = $documentos->fetch_assoc()): ?>
                <tr>
                    <td><?= $d['numero_expediente'] ?></td>
                    <td><?= $d['nombre_archivo'] ?></td>
                    <td><?= $d['tipo_archivo'] ?></td>
                    <td><?= $d['fecha_subida'] ?></td>
                    <td class="text-center">

                        <!-- VER PDF -->
                        <a href="<?= $d['ruta_archivo'] ?>" target="_blank"
                           class="btn btn-sm btn-info">
                           <i class="fas fa-eye"></i>
                        </a>

                        <!-- ELIMINAR -->
                        <a href="documento_eliminar.php?id=<?= $d['id_documento'] ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('¿Seguro de eliminar este documento?')">
                           <i class="fas fa-trash"></i>
                        </a>

                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

    </div>
</div>

</div>

<?php include 'includes/footer.php'; ?>