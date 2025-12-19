<?php include("db.php"); ?>
<?php include("includes/header.php"); ?>
<?php include("includes/sidebar.php"); ?>
<?php include("includes/topbar.php"); ?>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Juzgados</h1>

    <a href="juzgado_agregar.php" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Agregar Juzgado
    </a>

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Corte Judicial</th>
                        <th>Nombre del Juzgado</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                    $sql = $conexion->query("
                        SELECT 
                            j.id_juzgado,
                            c.nombre_corte,
                            j.nombre_juzgado,
                            j.tipo_juzgado
                        FROM juzgado j 
                        INNER JOIN corte_judicial c 
                            ON j.id_corte = c.id_corte
                        ORDER BY j.id_juzgado DESC
                    ");

                    while ($fila = $sql->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= $fila['id_juzgado'] ?></td>
                        <td><?= $fila['nombre_corte'] ?></td>
                        <td><?= $fila['nombre_juzgado'] ?></td>
                        <td><?= $fila['tipo_juzgado'] ?></td>

                        <td>
                            <a href="juzgado_editar.php?id=<?= $fila['id_juzgado'] ?>" 
                               class="btn btn-warning btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>

                            <a href="juzgado_eliminar.php?id=<?= $fila['id_juzgado'] ?>"
                               onclick="return confirm('¿Seguro deseas eliminar este juzgado?')"
                               class="btn btn-danger btn-sm">
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

<?php include("includes/footer.php"); ?>