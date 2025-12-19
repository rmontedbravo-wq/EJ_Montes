
<?php include("db.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/sidebar.php"); ?>


<div id="content-wrapper" class="d-flex flex-column"> 
    <div id="content"> 

        <!-- Topbar -->
        <?php 
        // Incluye la barra superior de navegación
        include("includes/topbar.php"); 
        ?>
        <!-- End of Topbar -->
  

<div class="container-fluid">
    
    
    
    <h1 class="h3 mb-4 text-gray-800">Pagos</h1>

    <a href="pago_add.php" class="btn btn-primary mb-3">➕ Registrar Pago</a>

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        
                        <th>Etapa del Proceso</th>
                        <th>Fecha de Pago</th>
                        <th>Monto Pagado</th>
                        <th>Medio de Pago</th>
                        <th>Observación</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                <?php
                // Consulta con INNER JOIN correcto
                $sql = "
                    SELECT 
                        p.id_pago,
                        p.fecha_pago,
                        p.monto_pagado,
                        p.medio_pago,
                        p.observacion,
                        e.nombre_etapa
                    FROM pago p
                    INNER JOIN etapa_proceso e 
                        ON p.id_etapa = e.id_etapa
                    ORDER BY p.id_pago DESC
                ";

                $resultado = $conexion->query($sql);

                if ($resultado->num_rows > 0):
                    while ($fila = $resultado->fetch_assoc()):
                ?>

                    <tr>
                        
                        <td><?= $fila['nombre_etapa'] ?></td>
                        <td><?= $fila['fecha_pago'] ?></td>
                        <td><strong>S/ <?= number_format($fila['monto_pagado'], 2) ?></strong></td>
                        <td><?= $fila['medio_pago'] ?></td>
                        <td><?= $fila['observacion'] ?></td>

                        <td>
                            <a href="pago_edit.php?id=<?= $fila['id_pago']; ?>" class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <a href="pago_delete.php?id=<?= $fila['id_pago']; ?>"
                               onclick="return confirm('¿Desea eliminar este pago?');"
                               class="btn btn-danger btn-sm">
                                Eliminar
                            </a>
                        </td>
                    </tr>

                <?php 
                    endwhile;
                else:
                ?>

                <tr>
                    <td colspan="7" class="text-center">No hay pagos registrados.</td>
                </tr>

                <?php endif; ?>

                </tbody>
            </table>

        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>
