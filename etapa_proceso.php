<?php include("includes/header.php"); ?>

<?php include("db.php"); ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Etapas del Proceso</h1>

    <a href="etapa_proceso_add.php" class="btn btn-primary mb-3">➕ Nueva Etapa</a>

    <div class="card shadow">
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Expediente</th>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Costo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php
                $sql = "SELECT ep.*, ex.numero_expediente 
                        FROM etapa_proceso ep
                        INNER JOIN expediente ex ON ep.expediente_id = ex.id";
                $resultado = $conexion->query($sql);

                while ($fila = $resultado->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= $fila['id']; ?></td>
                        <td><?= $fila['numero_expediente']; ?></td>
                        <td><?= $fila['fecha']; ?></td>
                        <td><?= $fila['descripcion']; ?></td>
                        <td>S/ <?= number_format($fila['costo'], 2); ?></td>

                        <td>
                            <a href="etapa_proceso_edit.php?id=<?= $fila['id']; ?>" class="btn btn-warning btn-sm">Editar</a>
                            <a href="etapa_proceso_delete.php?id=<?= $fila['id']; ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('¿Seguro de eliminar esta etapa?');">
                               Eliminar
                           </a>
                        </td>
                    </tr>

                <?php endwhile; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>