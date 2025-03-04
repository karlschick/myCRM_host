<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion= $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header ("location:index.html");
    die();
    exit;
}

/* 
include "login/claseSeguridad.php";

$seguridad = new Seguridad();
if ($seguridad->getUsuario()==null) {
    header ('location:index.html');
}
*/
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
        <?php
        include 'menu.php';
        ?>


            <!-- Hasta aca es toda la barra lateral y la barra superior (lo que se deja igual en todas las paginas de admin) -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h1 style="font-size: 32px;">GESTIÓN CLIENTES</h1>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page">Esta usted en el módulo de gestión</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-12 grid-margin stretch-card">
                            <div class="card">
                                <!-- CONTENIDO -->
                                <h4 class="card-title">BASE DE DATOS DE CLIENTES</h4>
                                <form class="forms-sample">
                                    <div class="form-group">
                                        <label for="id">Ingrese identificación de cliente</label>
                                        <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese Número de Identificación">
                                    </div>
                                    <div>
                                        <br>
                                        <button id="submit" type="submit" formmethod="post" formaction="consultar.php" class="btn btn-primary">Consultar</button>
                                        <button id="submit" type="submit" formmethod="post" formaction="tablas.php" class="btn btn-primary">Ver tabla de clientes</button>
                                        <button id="submit" type="submit" formmethod="post" formaction="ingresar.html" class="btn btn-primary">Ingresar nuevo cliente</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Extremos del contenedor de contenido -->
                <!-- FOOTER o pie de pagina-->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Derechos de autor © atory.com 2023</span>
                        <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                            <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">atory.com</a>
                        </span>
                    </div>
                </footer>
                <!-- Parcial -->
            </div>
            <!-- main-panel fin -->
        </div>
        <!-- page-body-wrapper fin -->
    </div>
    <!-- container-scroller -->
    <!-- Scripts -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- Fin de los scripts -->
</body>
</html>
