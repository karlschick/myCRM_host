<?php
// Evitar el cacheo de la página para asegurar que siempre se cargue la versión más reciente
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Iniciar la sesión y deshabilitar reportes de errores
session_start();
error_reporting(0);

// Verificar si el usuario tiene una sesión activa
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion == '') {
    // Redirigir al login si no hay sesión activa
    header("location: index.html");
    exit(); // Asegura que no se ejecute más código
}

// Incluir encabezado
include '../../includes/header.php';
?>

<body>
    <div class="container-scroller">
        <!-- Todo el slider -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <!-- Logo de Atory -->
                <a class="sidebar-brand brand-logo" href="../dashboard/principal.php">
                    <img src="../assets/images/atori.png" alt="logo">
                </a>
                <a class="sidebar-brand brand-logo-mini" href="../dashboard/principal.php">
                    <img src="../assets/images/logo-mini.png" alt="logo">
                </a>

            </div>
            <ul class="nav">
                <li class="nav-item profile">
                    <div class="profile-desc">
                        <div class="profile-pic">
                            <div class="count-indicator">
                                <img class="img-xs rounded-circle" src="../assets/images/faces-clipart/pic-8.png" alt="">
                                <span class="count bg-success"></span>
                            </div>

                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal">ADMINISTRATIVO</h5>

                            </div>
                        </div>
                        <!-- Ajustes de perfil -->
                    </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">PANEL DE CONTROL</span>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../clientes/tablas.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">Gestión clientes</span>

                    </a>

                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../usuarios/tablasUser.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-table-large"></i>
                        </span>
                        <span class="menu-title">Gestión Usuarios</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../planes/tablaplanes.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-laptop"></i>
                        </span>
                        <span class="menu-title">Gestión Planes</span>

                    </a>

                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../facturacion/facturas.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-playlist-play"></i>
                        </span>
                        <span class="menu-title">Gestión Facturación</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../inventario/tablasinventario.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-chart-bar"></i>
                        </span>
                        <span class="menu-title">Gestión Inventario</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../pqr/pqr.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-contacts"></i>
                        </span>
                        <span class="menu-title">Atencion al cliente</span>
                    </a>
                </li>
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../visitas/tablasVisitas.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-table-large"></i>
                        </span>
                        <span class="menu-title">Gestión Visitas</span>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- Página parcial -->
        <div class="container-fluid page-body-wrapper">
            <!-- Menú navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="../dashboard/principal.php">
                        <img src="../assets/images/logo-mini.png" alt="logo">
                    </a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav navbar-nav-right">
                        <a href="../planes/solicitudes.php" class="btn btn-info " role="button" aria-pressed="true">Nuevos Clientes</a>
                        <li class="nav-item dropdown">
                            <a class="nav-link collapsed" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                <div class="navbar-profile">
                                    <img class="img-xs rounded-circle" src="../assets/images/faces-clipart/pic-8.png" alt="">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">ADMINISTRATIVO</p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                                <h6 class="p-3 mb-0">PERFIL</h6>
                                <div class="dropdown-divider"></div>
                                <a class="nav-link" href="../login/login.php">

                                <a class="dropdown-item preview-item" href="../empresa/verempresa.php">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-office-building text-primary"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject mb-1">informacion de la Empresa</p>
                                </div>
                            </a>

                            <!-- Opción Cerrar sesión -->
                            <a class="dropdown-item preview-item" href="../login/cerrarSesion.php">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-logout text-danger"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject mb-1">Cerrar sesión</p>
                                </div>
                            </a>
                        </div>

                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-format-line-spacing"></span>
                    </button>
                </div>
            </nav>
    <!-- Carga de los plugins JavaScript principales -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- Fin de la inyección de plugins -->

    <!-- Plugins específicos para esta página -->
    <script src="../assets/vendors/chart.js/Chart.min.js"></script> <!-- Plugin para gráficos -->
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script> <!-- Plugin para barras de progreso -->
    <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script> <!-- Plugin de mapas interactivos -->
    <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script> <!-- Datos del mapa mundial -->
    <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script> <!-- Plugin para carruseles de imágenes -->
    <!-- Fin de la carga de plugins específicos -->

    <!-- Inyección de scripts principales del sistema -->
    <script src="../assets/js/off-canvas.js"></script> <!-- Manejo de menú lateral -->
    <script src="../assets/js/hoverable-collapse.js"></script> <!-- Animaciones de colapso -->
    <script src="../assets/js/misc.js"></script> <!-- Scripts misceláneos -->
    <script src="../assets/js/settings.js"></script> <!-- Configuraciones generales -->
    <script src="../assets/js/todolist.js"></script> <!-- Manejo de lista de tareas -->
    <!-- Fin de la inyección de scripts -->

    <!-- Script personalizado para esta página -->
    <script src="../assets/js/dashboard.js"></script> <!-- Lógica específica del panel de control -->
    <!-- Fin del script personalizado -->

    <!-- Elemento de tooltip para el mapa interactivo -->
    <div class="jvectormap-tip"></div>

    <!-- Importación de SweetAlert para mostrar alertas visuales -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script para manejar la funcionalidad de eliminación con SweetAlert -->
    <script>
        $('.borrar').on('click', function(e) {
            e.preventDefault(); // Previene la acción por defecto del enlace

            var self = $(this); // Guarda la referencia del elemento clickeado

            console.log(self.data('title')); // Muestra en consola el título del elemento (si tiene)

            // Muestra una alerta de confirmación antes de proceder con la acción
            Swal.fire({
                title: '¿Está seguro que desea continuar?', // Mensaje de la alerta
                icon: 'warning', // Icono de advertencia
                showCancelButton: true, // Muestra el botón de cancelar
                confirmButtonColor: '#3085d6', // Color del botón de confirmar
                cancelButtonColor: '#d33', // Color del botón de cancelar
                confirmButtonText: 'Confirmar', // Texto del botón de confirmación
                cancelButtonText: 'No', // Texto del botón de cancelación
                background: '#34495E' // Color de fondo de la alerta
            }).then((result) => {
                if (result.isConfirmed) { // Si el usuario confirma
                    location.href = self.attr('href'); // Redirige a la URL del enlace
                }
            })
        })
    </script>
</body>

</html>