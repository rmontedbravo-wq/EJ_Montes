<?php
$pageTitle = 'Agregar Cliente';
$activePage = 'cliente';

include 'includes/header.php';
include 'includes/sidebar.php';
include 'db.php';

// Si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    // Insertar en la BD
    $sql = "INSERT INTO cliente (nombres, apellidos, dni, telefono, correo)
            VALUES ('$nombres', '$apellidos', '$dni', '$telefono', '$correo')";

    if ($conexion->query($sql)) {
        echo "<script>
            alert('Cliente agregado correctamente');
            window.location='cliente.php';
        </script>";
    } else {
        echo "<script>alert('Error al guardar');</script>";
    }
}
?>

<div id="content-wrapper" class="d-flex flex-column">
<div id="content">

<?php include 'includes/topbar.php'; ?>

<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Agregar Cliente</h1>

    <div class="card shadow">
        <div class="card-body">

            <form method="POST">

                <div class="form-group">
                    <label>Nombres</label>
                    <input type="text" name="nombres" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" name="apellidos" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>DNI</label>
                    <input type="text" name="dni" class="form-control" required>
                </div>

                <div class="form-group">
                    <label>Teléfono</label>
                    <input type="text" name="telefono" class="form-control">
                </div>

                <div class="form-group">
                    <label>Correo</label>
                    <input type="email" name="correo" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">Guardar</button>

                <a href="clientes.php" class="btn btn-secondary">Regresar</a>

            </form>

        </div>
    </div>

</div>

</div>
<?php include 'includes/footer.php'; ?>

