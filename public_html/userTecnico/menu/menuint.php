<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
    header("location:index.html");
    die();
    exit;
}

?>

<!-- CODIGO HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ATORY - Admin</title>
    <!-- Estilos de los plugins -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- Fin de los estilos de los plugins -->
    <!-- Estilos del archivo actual -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- Fin de los estilos del archivo actual -->
    <link rel="shortcut icon" href="assets/images/favicon.png">
</head>

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
                                <img class="img-xs rounded-circle" src="../assets/images/faces-clipart/pic-4.png" alt="">
                                <span class="count bg-success"></span>
                            </div>
                            <div class="profile-name">
                                <h5 class="mb-0 font-weight-normal">TECNICO</h5>
                                <span>Rol tecnico</span>
                            </div>
                        </div>
                        <!-- Ajustes de perfil -->
                    </div>
                </li>
                <li class="nav-item nav-category">
                    <span class="nav-link">PANEL DE CONTROL</span>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" href="../visitas/inicioVisitasT.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-table-large"></i>
                        </span>
                        <span class="menu-title">Visitas</span>
                    </a>
                </li>

                <li class="nav-item menu-items">
                    <a class="nav-link" href="../inventario/tablasinventario.php">
                        <span class="menu-icon">
                            <i class="mdi mdi-chart-bar"></i>
                        </span>
                        <span class="menu-title">Inventario</span>
                    </a>
                </li>

            </ul>
        </nav>
        <!-- Página parcial -->
        <div class="container-fluid page-body-wrapper">
            <!-- Menú navbar.html -->
            <nav class="navbar p-0 fixed-top d-flex flex-row">
                <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                    <a class="navbar-brand brand-logo-mini" href="index.html">
                        <img src="../assets/images/logo-mini.png" alt="logo">
                    </a>
                </div>
                <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <ul class="navbar-nav navbar-nav-right">

                        <li class="nav-item dropdown">
                            <a class="nav-link collapsed" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                                <div class="navbar-profile">
                                    <img class="img-xs rounded-circle" src="../assets/images/faces-clipart/pic-4.png" alt="">
                                    <p class="mb-0 d-none d-sm-block navbar-profile-name">TECNICO</p>
                                    <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                                <h6 class="p-3 mb-0">PERFIL</h6>
                                <div class="dropdown-divider"></div>
                                <a class="nav-link" href="../login/login.php">
                                    <div class="dropdown-item preview-item">
                                        <a href="../cerrarSesion.php">
                                            <div class="preview-thumbnail">
                                                <div class="preview-icon bg-dark rounded-circle">
                                                    <i class="mdi mdi-logout text-danger"></i>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="../cerrarSesion.php">
                                            <div class="preview-item-content">
                                                <p class="preview-subject mb-1">Cerrar sesión</p>
                                            </div>
                                        </a>
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

</body>

</html>