<?php
$pageTitle = 'Editar Cliente';
$activePage = 'clientes';

include 'includes/header.php';
include 'includes/sidebar.php';
include 'db.php'; // Conexión a BD

// Verificar que llega el ID
if (!isset($_GET['id'])) {
    die("<div class='alert alert-danger mt-4'>Error: ID no especificado.</div>");
}

$id = intval($_GET['id']); // Seguridad básica

// Obtener datos del cliente
$resultado = $conexion->query("SELECT * FROM cliente WHERE id_cliente = $id");

if ($resultado->num_rows == 0) {
    die("<div class='alert alert-danger mt-4'>Cliente no encontrado.</div>");
}

$cliente = $resultado->fetch_assoc();

// Si enviaron el formulario
if ($_POST) {

    $nombres = $_POST['nombres'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $correo = $_POST['correo'];

    $conexion->query("UPDATE cliente SET 
        nombres='$nombres',
        apellidos='$apellidos',
        dni='$dni',
        direccion='$direccion',
        telefono='$telefono',
        correo='$correo'
        WHERE id_cliente=$id
    ");

    echo '<div class="alert alert-success mt-3">Cambios guardados correctamente.</div>';
}
?>

<div class="container">

    <h2 class="mt-4">Editar Cliente</h2>

    <form method="POST" class="mt-3">

        <div class="form-group">
            <label>Nombres</label>
            <input type="text" name="nombres" class="form-control"
                   value="<?= $cliente['nombres'] ?>" required>
        </div>

        <div class="form-group">
            <label>Apellidos</label>
            <input type="text" name="apellidos" class="form-control"
                   value="<?= $cliente['apellidos'] ?>" required>
        </div>

        <div class="form-group">
            <label>DNI</label>
            <input type="text" name="dni" class="form-control"
                   value="<?= $cliente['dni'] ?>">
        </div>

        <div class="form-group">
            <label>Dirección</label>
            <input type="text" name="direccion" class="form-control"
                   value="<?= $cliente['direccion'] ?>">
        </div>

        <div class="form-group">
            <label>Teléfono</label>
            <input type="text" name="telefono" class="form-control"
                   value="<?= $cliente['telefono'] ?>">
        </div>

        <div class="form-group">
            <label>Correo</label>
            <input type="email" name="correo" class="form-control"
                   value="<?= $cliente['correo'] ?>">
        </div>

        <button class="btn btn-primary">Guardar Cambios</button>
        <a href="cliente.php" class="btn btn-secondary">Volver</a>

    </form>

</div>

<?php include 'includes/footer.php'; ?>