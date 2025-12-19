<?php
session_start();

// --- CONFIGURACIÓN DE DEBUGGING (Quitar en producción) ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// --------------------------------------------------------

require_once "db.php"; // Asegúrate de que este archivo existe y define $conexion

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST["usuario"];
    $clave   = $_POST["clave"];

    if (!isset($conexion) || $conexion->connect_error) {
        $mensaje = "Error fatal de conexión a la base de datos: " . $conexion->connect_error;
    } else {
        $sql = "SELECT usuario FROM usuarios WHERE usuario = ? AND clave = ?"; // O usa password_hash como te expliqué
        $stmt = $conexion->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ss", $usuario, $clave);
            
            if ($stmt->execute()) {
                $res = $stmt->get_result();

                if ($res->num_rows === 1) {
                    $_SESSION["usuario"] = $usuario;
                    header("Location: index.php");
                    exit;
                } else {
                    $mensaje = "Usuario o contraseña incorrectos";
                }
            } else {
                $mensaje = "Error al ejecutar la consulta: " . $stmt->error;
            }
            $stmt->close();
        } else {
            $mensaje = "Error de preparación SQL: " . $conexion->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Login — Estudio Jurídico Montes Bravo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    
    <style>
        /* Base para asegurar que todo el body ocupe el 100% de la altura de la ventana */
        html, body {
            height: 100%;
            margin: 0;
            overflow: hidden; /* Evita scrolls no deseados si el contenido es demasiado grande */
        }

        /* Contenedor principal para dividir la pantalla en dos columnas iguales */
        .split-screen-container {
            display: flex; /* Habilita Flexbox */
            height: 100%; /* Ocupa el 100% de la altura de la ventana */
            width: 100%;  /* Ocupa el 100% del ancho de la ventana */
        }

        /* Sección de la izquierda para la imagen */
        .split-screen-left {
            flex: 1.5; /* Ocupa la mitad del espacio disponible */
            background-image: url('public/img/oficina2.jpg'); /* Tu imagen */
            background-size: cover; /* Cubre toda la sección */
            background-position: center; /* Centra la imagen */
            background-repeat: no-repeat;
        }

        /* Sección de la derecha para el formulario de login */
        .split-screen-right {
            flex: 1; /* Ocupa la otra mitad del espacio disponible */
            display: flex; /* Para centrar el contenido del login */
            justify-content: center; /* Centrado horizontal */
            background-image: url('public/img/Fondo.jpg'); /* Tu imagen */
            align-items: center; /* Centrado vertical */
            background-color: #f8f9fc; /* Color de fondo claro, similar al de sb-admin-2 */
            padding: 20px; /* Espaciado interno */
            overflow-y: auto; /* Si el contenido del login es muy largo, permite scroll */
          
        }

        /* Estilo para la tarjeta del login dentro de la sección derecha */
        .login-card {
            width: 100%;
            max-width: 450px; /* Limita el ancho del formulario para que no se estire demasiado */
            padding: 30px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15); /* Sombra similar a sb-admin-2 */
            border-radius: 0.35rem; /* Bordes redondeados */
            background-color: #fff;
            
        }

        /* Estilos responsivos para pantallas pequeñas */
         
        @media (max-width: 991.98px) { /* breakpoint para md, lg en Bootstrap */
            .split-screen-container {
                flex-direction: column; /* Apila las secciones verticalmente */
                
            }
            
            .split-screen-left {
                height: 250px; /* Altura fija para la imagen en móviles */
                width: 100%;
                 
            }
            .split-screen-right {
                height: auto; /* El login ocupa el espacio restante */
                width: 100%;
                
            }
        }
    </style>

</head>

<body>

    <div class="split-screen-container">

        <div class="split-screen-left">
            </div>

        <div class="split-screen-right">
            <div class="login-card">
                <div class="text-center">
                  
                     
                    <h1 class="h4 text-gray-900 mb-4">Iniciar Sesión</h1>
                </div>

                <?php if ($mensaje): ?>
                    <div class="alert alert-danger text-center">
                        <?= $mensaje ?>
                    </div>
                <?php endif; ?>

                <form class="user" method="POST">
                    <div class="form-group">
                        <input type="text" name="usuario" class="form-control form-control-user"
                               placeholder="Usuario" required>
                    </div>
                    <div class="form-group">
                        <input type="password" name="clave" class="form-control form-control-user"
                               placeholder="Contraseña" required>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Ingresar
                    </button>
                </form>
            </div>
        </div>

    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>

</body>
</html>