<?php
// Evitar el cacheo de la página
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");
session_start();
error_reporting(0);

// Verificar si el usuario tiene una sesión activa
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion == '') {
    // Redirigir al login si no hay sesión
    header("location: index.html");
    exit(); // Asegura que no se ejecute más código
}

// Aquí puedes incluir tu encabezado o lo que necesites
include '../../includes/header.php';
?>

<body>
    <div class="container-scroller">
        <!-- Todo el slider -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <!-- Logo de Atory -->
                <a class="sidebar-brand brand-logo">
                    <img src="../assets/images/atori.png" alt="logo">
                </a>
                <!-- Volver a inicio -->
                <a class="sidebar-brand brand-logo-mini">
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
                    <a class="navbar-brand brand-logo-mini">
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

                        <div class="dropdown-item preview-item">
                            <a href="../empresa/verempresa.php">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-logout text-danger"></i>
                                    </div>
                                </div>
                            </a>
                            <a href="../empresa/verempresa.php">
                                <div class="preview-item-content">
                                    <p class="preview-subject mb-1">Ver Empresa</p>
                                </div>
                            </a>
                        </div>

                        <div class="dropdown-item preview-item">
                            <a href="../login/cerrarSesion.php">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-logout text-danger"></i>
                                    </div>
                                </div>
                            </a>
                            <a href="../login/cerrarSesion.php">
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

                <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->

    <div class="jvectormap-tip"></div>
    <!-- Estas ultimas lineas son para la alerta DE BORRAR, INSERTA SWEET ALERT Y LUEGO ESTA EL SCRIPT PARA BORRAR-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.borrar').on('click', function(e) {
            e.preventDefault();
            var self = $(this);
            console.log(self.data('title'));
            Swal.fire({
                title: 'Esta seguro que desea continuar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'No',
                background: '#34495E'
            }).then((result) => {
                if (result.isConfirmed) {

                    location.href = self.attr('href');
                }
            })
        })
    </script>
</body>

</html>