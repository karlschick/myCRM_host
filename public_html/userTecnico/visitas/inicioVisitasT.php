<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
    header("location:../../index.html");
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
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- Fin de los estilos de los plugins -->
    <!-- Estilos del archivo actual -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- Fin de los estilos del archivo actual -->
    <link rel="shortcut icon" href="../assets/images/favicon.png">
</head>

<body>
    <?php
    include '../menu/menuint.php';
    ?>

    <!-- partial -->


    <div class="main-panel">

        <div class="content-wrapper">
            <div class="page-header">
                <h1 style="font-size: 32px;">Visitas tecnicas e Instalaciones</h1>
            </div>
            <div class="col-6 grid-margin ">
                <div class="card">
                    <!-- CONTENIDO -->
                    <div class="card-body">
                        <h4 class="card-title">CONSULTAR VISITAS ASIGNADAS</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="id">Ingrese su numero de identificación</label>
                                <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese Número de Identificación">
                            </div>
                            <div>
                                <br>
                                <button id="submit" type="submit" formmethod="post" formaction="tablasVisitas.php" class="btn btn-info btn-lg">Consultar Visitas Activas</button>
                                <button id="submit" type="submit" formmethod="post" formaction="tablasAtendidas.php" class="btn btn-danger btn-lg">Consultar Visitas Atendidas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->


    </div>

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


</body>

</html>