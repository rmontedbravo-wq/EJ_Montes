<?php
// includes/sidebar.php
// Espera $activePage definido por cada página (ej: 'dashboard', 'clientes')
if (!isset($activePage)) $activePage = '';
?>

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-balance-scale"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Abogados Montes Bravo</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?= $activePage == 'dashboard' ? 'active' : '' ?>">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Panel</span>
        </a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interfaz
    </div>

    <!-- Nav Item - Clientes -->
    <li class="nav-item <?= $activePage == 'clientes' ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseClientes"
            aria-expanded="true" aria-controls="collapseClientes">
            <i class="fas fa-fw fa-users"></i>
            <span>Clientes</span>
        </a>
        <div id="collapseClientes" class="collapse" aria-labelledby="headingClientes" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones:</h6>
                <a class="collapse-item" href="cliente.php">Relación de Clientes</a>
                <a class="collapse-item" href="reporte_clientes.php">Reporte Clientes</a>
       
            </div>
        </div>
    </li>
    

    <!-- Nav Item - Expedientes -->
    <li class="nav-item <?= $activePage == 'expediente' ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseexpediente"
            aria-expanded="true" aria-controls="collapseexpediente">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Expedientes</span>
        </a>
               
        <div id="collapseexpediente" class="collapse" aria-labelledby="headingexpediente"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones:</h6>
                <a class="collapse-item" href="expedientes.php">Expediente Total</a>
                <a class="collapse-item" href="reporte_expedientes.php">Reporte Expediente</a>
          		
            </div>
        </div>
    </li>
    <!-- Nav Item - Pagos -->
	<li class="nav-item <?= $activePage == 'pago' ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsepago"
            aria-expanded="true" aria-controls="collapsepago">
            <i class="fas fa-fw fa-folder-open"></i>
            <span>Pagos</span>
        </a>
        <div id="collapsepago" class="collapse" aria-labelledby="headingpago"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Opciones:</h6>
                <a class="collapse-item" href="pago.php">Pago Total</a>
                <a class="collapse-item" href="reporte_pago.php">Reporte Pago</a>
         	</div>
        </div>
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Complementos
    </div>

    <!-- Nav Item - Páginas -->
    <li class="nav-item <?= $activePage == 'paginas' ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Páginas</span>
        </a>
	
        <div id="collapsePages" class="collapse"
            aria-labelledby="headingPages" data-parent="#accordionSidebar">

            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Accesos:</h6>

                <!-- LOGIN CORREGIDO (login.php) -->
                <a class="collapse-item" href="login.php">Iniciar Sesión</a>

                <!-- Registros (si tienes register.php) -->
                <a class="collapse-item" href="register.php">Registrarse</a>

                <!-- Recuperar contraseña (forgot-password.php) -->
                <a class="collapse-item" href="forgot-password.php">Olvidé mi Contraseña</a>

                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Otras Páginas:</h6>

                <a class="collapse-item" href="blank.php">Página en Blanco</a>
            </div>
        </div>
    </li>
    <li class="nav-item <?= ($activePage == 'documentos') ? 'active' : '' ?>">
    <a class="nav-link" href="documento.php">
        <i class="fas fa-file-pdf"></i>
        <span>Documentos</span>
    </a>
	</li>

    <!-- Nav Item - Charts -->
   

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->