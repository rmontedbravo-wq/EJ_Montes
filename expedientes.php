<?php
$pageTitle = 'Lista de Expedientes';
$activePage = 'expedientes';

include 'includes/header.php';
include 'includes/sidebar.php';
include 'db.php';

// CONSULTA SQL
$sql = "
    SELECT 
        e.id_expediente AS id,
        e.numero_expediente AS numero,
        e.anio_expediente AS anio,
        e.materia,
        j.nombre_juzgado AS juzgado,
        c.nombre_corte AS corte
    FROM expediente e
    INNER JOIN juzgado j ON e.id_juzgado = j.id_juzgado
    INNER JOIN corte_judicial c ON j.id_corte = c.id_corte
    ORDER BY e.id_expediente DESC
";

$result = $conexion->query($sql);

// VALIDACIÓN DE ERROR
if (!$result) {
    die("<b>Error SQL:</b> " . $conexion->error);
}
?>

<!-- CONTENIDO PRINCIPAL -->
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Expedientes</h1>
    
     <a href="expedientes_add.php" class="btn btn-primary mb-3">+ Nuevo Expediente</a>
	
    <div class="card shadow mb-4">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th> N° </th> <!-- Numeración nueva -->
                            <th>Número</th>
                            <th>Año</th>
                            <th>Materia</th>
                            <th>Juzgado</th>
                            <th>Corte</th>
                            <th style="width: 120px;">Acciones</th>
                        </tr>
                    </thead>
						
                    
                  	 <div class="card shadow"> 
                            <div class="card-body">
                              <div class="d-flex justify-content-end mb-3"> 
                                  <a href="reporte_expedientes.php" target="_blank" class="btn btn-primary"> <i class="fas fa-file-pdf"></i> Generar Reporte PDF 
                         		 </a> 
                          	</div> 
                             </div>
              		
       
            
                    <tbody>
                        <?php 
                        $i = 1; // contador
                        while($row = $result->fetch_assoc()): 
                        ?>
                        <tr>
                            <td><?= $i++; ?></td> <!-- Muestra 1,2,3... -->
                            <td><?= $row['numero']; ?></td>
                            <td><?= $row['anio']; ?></td>
                            <td><?= $row['materia']; ?></td>
                            <td><?= $row['juzgado']; ?></td>
                            <td><?= $row['corte']; ?></td>

                            <td class="text-center">
                                <a href="expedientes_edit.php?id=<?= $row['id']; ?>" 
                                   class="btn btn-warning btn-sm mb-1">
                                    Editar
                                </a>

                                <a href="expedientes_delete.php?id=<?= $row['id']; ?>" 
                                   class="btn btn-danger btn-sm"
                                   onclick="return confirm('¿Eliminar este expediente?')">
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

</div>


<?php include 'includes/footer.php'; ?>