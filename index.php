<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}

require_once 'db.php';
?>
  


</body>
</html>
<?php
$pageTitle='Dashboard'; $activePage='dashboard';
include 'includes/header.php';
?>
<?php include 'includes/sidebar.php'; ?>

<?php include 'grafico_expedientes.php'; ?>
<?php include 'grafico_pago.php'; ?>


<?php
$consulta_total = $conexion->query("SELECT COUNT(*) AS total FROM cliente");
$totalClientes = $consulta_total->fetch_assoc()['total'];
?>

<?php
$consulta_total_expedientes = $conexion->query("SELECT COUNT(*) AS total FROM expediente");
$totalExpedientes = $consulta_total_expedientes->fetch_assoc()['total'];
?>
    <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include 'includes/topbar.php'; ?>
                <!-- End of Topbar -->

                <!-- Inicio de contenido de la Paguina Principal-->
                <div class="container-fluid">

                    <!-- Encabezado de página -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Panel de Control</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                          class="fas fa-clipboard-list fa-2x text-gray-300"></i>  Datos </a>      
                                                                                                         
                                                                                                         
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                REGISTRO DE CLIENTES</div>
                                           <div class="h5 mb-0 font-weight-bold text-gray-800">
  											  <?php echo $totalClientes; ?>
											</div>
                                            
                                           <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Expedientes</div>
                                            
                                        <div class="h5 mb-0 font-weight-bold text-gray-800">
   											 <?php echo $totalExpedientes; ?>
										</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Pagos
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-600">100%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                       
                        <div class="col-xl-3 col-md-6 mb-4">
                           
                                </div>
                            </div>
                        </div>
                    </div>


                        
                        <!-- Content Row -->

                    <div class="row">

                    
                       <!-- Area Chart -->
					<div class="col-xl-8 col-lg-7">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">
                Expedientes por Materia
            </h6>
        </div>
        <div class="card-body">
            <div style="height:400px;">
                <canvas id="barChartDashboard"></canvas>
            </div>
        </div>
    </div>
</div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-primary">Ingresos y Egresos</h6>
                                    <div class="dropdown no-arrow">
                                        
                                        
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="piePago"></canvas> 
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                           
                                        </span>
                                        <span class="mr-2">
                                           
                                        </span>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
           		 <div class="row">

                        <!-- Content Column -->
                       

                            <!-- Project Card Example -->
                           <div class="col-lg-12 mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Historial de Expedientes</h6>
                                </div>
                                <div class="card-body">
                                    <h4 class="small font-weight-bold">Expedientes Admitidos <span
                                            class="float-right">20%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 20%"
                                            aria-valuenow="20" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <h4 class="small font-weight-bold">Expedientes Sentenciados <span
                                            class="float-right">40%</span></h4>
                                    <div class="progress mb-4">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 40%"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                   
                              </div>       
                                    
                              

                            <!-- Color System -->
                            <div class="row">
                                <div class="col-lg-6 mb-4">
                                    <div class="card bg-primary text-white shadow">
                                        <div class="card-body">
                                           MISION
                                            <div class="text-white-60 small">Brindar asesoría y defensa legal integral con ética, responsabilidad y compromiso, ofreciendo soluciones jurídicas eficientes y personalizadas que protejan los derechos e intereses de nuestros clientes, contribuyendo a la justicia y al desarrollo de la sociedad</div>
                                        </div>
                                    </div>
                                </div>
                               <div class="col-lg-6 mb-4">
                                    <div class="card bg-success text-white shadow ">
                                        <div class="card-body">
                                           VISION
                                            <div class="text-white-60 small">Ser un estudio jurídico reconocido por su excelencia profesional, confiabilidad y liderazgo en el ámbito legal, destacando por la calidad de nuestros servicios, la innovación en la gestión legal y la satisfacción de nuestros clientes a nivel regional y nacional.</div>
                                        </div>
                                    </div>
                                   
                           </div>
                               
                            </div>

                 </div>

                        <div class="col-lg-12 mb-4">

                            <!-- Illustrations -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">ESTUDIO JURIDICO MONTES BRAVO</h6>
                                </div>
                                <div class="card-body">
                                    <div class="text-center">
                                        <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width:34rem;"
                                            src="public/img/NAVIDAD.jpeg" alt="...">
                                         <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width:30rem;"
                                            src="public/img/INTERNET.jpg" alt="...">
                                         <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width:25rem;"
                                            src="public/img/NUEVO.jpg" alt="...">
                                    </div>
                                    <p>En estas fechas tan especiales, queremos expresar nuestro más sincero agradecimiento por su compromiso, dedicación y esfuerzo a lo largo del año. Su trabajo ha sido fundamental para el crecimiento y fortalecimiento de nuestra empresa.

Que esta Navidad esté llena de paz, unión y esperanza junto a sus seres queridos, y que el Año Nuevo nos traiga nuevas oportunidades, salud y muchos éxitos compartidos.
Que el próximo año nos permita seguir creciendo juntos, fortaleciendo el trabajo en equipo y alcanzando nuevas metas.
Confiamos en que, con su talento y vocación, continuaremos construyendo un futuro lleno de logros y satisfacciones.
<p class="mb-0">
¡Gracias por ser parte de este gran equipo!
Les deseamos Felices Fiestas y un próspero Año Nuevo. </p>
                                    
                                </div>
                            </div>

                            <!-- Approach -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Derecho Informatico</h6>
                                </div>
                                <div class="card-body">
                                    <p>El Derecho Informático es una rama del derecho que regula los aspectos legales relacionados con la información digital, los sistemas informáticos y las tecnologías de la información.
Su principal objetivo es proteger los derechos de las personas y organizaciones en el uso de la tecnología y la información.
Esta disciplina aborda temas como la protección de datos personales, la privacidad en internet, y la seguridad informática.
También regula los delitos informáticos, como el acceso no autorizado a sistemas, el fraude electrónico y la difusión de contenido ilícito.
                      <p class="mb-0">
El Derecho Informático incluye normas sobre contratos electrónicos, firmas digitales y comercio electrónico.
Permite establecer responsabilidades legales para empresas y usuarios que manejan información digital.
Es fundamental en la era digital, donde gran parte de las relaciones sociales y comerciales se realizan en línea.</p>
                                   .</p>
                                </div>
                            </div>

                        </div>
                    </div>
				 </div>    
          
                <!-- Fin del contenido prinicpal/.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Estudio Juridico Montes 2025</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
    <!-- End of Content Wrapper -->

<?php include 'includes/footer.php'; ?>
<!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
   

   <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>


    <!-- Page level custom scripts -->
   
    <script src="js/demo/chart-pie-demo.js"></script>


<!-- CHART.JS pie-->
<script src="vendor/chart.js/Chart.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    const ctx = document.getElementById('piePago');
    if (!ctx) {
        console.error('No existe el canvas piePago');
        return;
    }

    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: <?= json_encode($labelsPago) ?>,
            datasets: [{
                data: <?= json_encode($valuesPago) ?>,
                backgroundColor: ['#1cc88a', '#e74a3b'],
                hoverBackgroundColor: ['#17a673', '#c0392b'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
});
</script>

<!-- CHART.JS barras-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Obtener datos desde PHP
    const labels = <?= json_encode($labels) ?>;
    const dataValues = <?= json_encode($values) ?>;

    // Colores dinámicos
    const colors = [
        "#4dc9f6", "#f67019", "#f53794", "#537bc4",
        "#acc236", "#166a8f", "#00a950", "#58595b",
        "#8549ba", "#ffc300"
    ];

    // Asegurarse de que el canvas exista
    const canvas = document.getElementById('barChartDashboard');
    if (canvas) {
        const ctx = canvas.getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Número de expedientes',
                    data: dataValues,
                    backgroundColor: colors.slice(0, dataValues.length),
                    borderColor: '#1e88e5',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            label: function(context) {
                                return context.dataset.label + ': ' + context.parsed.y;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { precision: 0 },
                        title: { display: true, text: 'Cantidad de expedientes' }
                    },
                    x: {
                        title: { display: true, text: 'Materia' }
                    }
                }
            }
        });
    } else {
        console.error("No se encontró el canvas #barChartDashboard");
    }
});
</script>
