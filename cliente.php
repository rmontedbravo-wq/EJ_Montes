<?php include("db.php"); 
$activePage = 'clientes';
 include("includes/header.php");
 include("includes/sidebar.php"); 
  ?>



 <div id="content-wrapper" class="d-flex flex-column"> 
    <div id="content"> 

        <!-- Topbar -->
        <?php 
        // Incluye la barra superior de navegación
        include("includes/topbar.php"); 
        ?>
        <!-- End of Topbar -->
    <div class="container-fluid">
        
    <h1 class="h3 mb-4 text-gray-800">Clientes</h1>
        
       
        
        
    <a href="cliente_agregar.php" class="btn btn-primary mb-3">
        <i class="fas fa-plus"></i> Agregar Cliente
    </a>
    <div class="card shadow">
        <div class="card-body">
            <div class="d-flex justify-content-end mb-3">
    <a href="reporte_clientes.php" target="_blank" class="btn btn-primary">
        <i class="fas fa-file-pdf"></i> Generar Reporte PDF
    </a>
</div>
            <table class="table table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>N°</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>DNI</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
               <?php
    $sql = $conexion->query("SELECT * FROM cliente ORDER BY id_cliente DESC");
    $contador = 1; // Inicializamos el contador
    while ($fila = $sql->fetch_assoc()):
?>
    <tr>
        <td><?= $contador ?></td> <!-- Mostramos el número en lugar del ID -->
        <td><?= $fila['nombres'] ?></td>
        <td><?= $fila['apellidos'] ?></td>
        <td><?= $fila['dni'] ?></td>
        <td><?= $fila['telefono'] ?></td>
        <td><?= $fila['correo'] ?></td>

        <td>
            <a href="cliente_editar.php?id=<?= $fila['id_cliente'] ?>" class="btn btn-warning btn-sm">
                <i class="fas fa-edit"></i>
            </a>

            <a href="cliente_eliminar.php?id=<?= $fila['id_cliente'] ?>"
               onclick="return confirm('¿Seguro deseas eliminar?')"
               class="btn btn-danger btn-sm">
                <i class="fas fa-trash"></i>
            </a>
        </td>
    </tr>
<?php 
    $contador++; // Incrementamos el contador en cada iteración
    endwhile; 
?>
                </tbody>

            </table>

        </div>
    </div>
	</div>
    </div>    
</div>

<?php include("includes/footer.php"); ?>

