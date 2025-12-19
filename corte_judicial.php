<?php
$pageTitle = "Cortes Judiciales";
$activePage = "corte_judicial";

include("db.php");
include("includes/header.php");
include("includes/sidebar.php");
include("includes/topbar.php");

// Consulta segura
$sql = "SELECT id_corte, nombre_corte, distrito FROM corte_judicial ORDER BY id_corte DESC";
$result = $conexion->query($sql);

// Validación de error SQL
if (!$result) {
    die("<div class='alert alert-danger'>Error en la consulta: " . $conexion->error . "</div>");
}
?>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Cortes Judiciales</h1>

    <a href="corte_judicial_agregar.php" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Agregar Corte Judicial
    </a>

    <div class="card shadow">
        <div class="card-body">

            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nombre de la Corte</th>
                        <th>Distrito</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php while ($fila = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= $fila['id_corte']; ?></td>
                            <td><?= $fila['nombre_corte']; ?></td>
                            <td><?= $fila['distrito']; ?></td>

                            <td>
                                <a href="corte_judicial_editar.php?id=<?= $fila['id_corte']; ?>" 
                                   class="btn btn-warning btn-sm" title="Editar">
                                    <i class="fas fa-edit"></i>
                                </a>

                                <a href="corte_judicial_eliminar.php?id=<?= $fila['id_corte']; ?>"
                                   onclick="return confirm('¿Seguro deseas eliminar esta corte judicial?')"
                                   class="btn btn-danger btn-sm" title="Eliminar">
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