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
        <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
            <div class="card-body">
                <h4 class="card-title">GESTION DE VISITAS</h4>
                <p class="card-description"> Ingrese los datos de la visita</p>
                <form class="forms-sample">

                    <div class="form-group">
                        <label for="docC">Ingrese documento del Cliente</label>
                        <input type="text" class="form-control" name="docC" id="docC" placeholder="Numero de documento">
                    </div>
                    <div class="form-group">
                        <label for="nomC">Ingrese nombre del Cliente</label>
                        <input type="text" class="form-control" name="nomC" id="nomC" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="telC">Ingrese telefono del Cliente</label>
                        <input type="text" class="form-control" name="telC" id="telC" placeholder="Telefono">
                    </div>
                    <div class="form-group">
                        <label for="emailC">Ingrese Correo del Cliente</label>
                        <input type="email" class="form-control" name="emailC" id="emailC" placeholder="Correo electronico">
                    </div>
                    <div class="form-group">
                        <label for="dir">Ingrese direccion del Cliente</label>
                        <input type="text" class="form-control" name="dir" id="dir" placeholder="Direccion">
                    </div>
                    <div class="form-group">
                        <label for="docT">Ingrese documento del tecnico</label>
                        <input type="text" class="form-control" name="docT" id="docT" placeholder="Numero de documento">
                    </div>
                    <div class="form-group">
                        <label for="nomT">Seleccione el tecnico</label>
                        <select class="form-control" name="nomT" id="nomT">
                            <option value="Cristian Muñoz">Cristian Muñoz</option>
                            <option value="Fabian Quimbay">Fabian Quimbay</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="telT">Ingrese telefono del Tecnico</label>
                        <input type="text" class="form-control" name="telT" id="telT" placeholder="Ingrese telefono">
                    </div>

                    <!--valor de email-->
                    <div class="form-group">
                        <label for="emailT">Ingrese Correo del tecnico</label>
                        <input type="email" class="form-control" name="emailT" id="emailT" placeholder="Correo electronico">
                    </div>

                    <!--valor de motivo-->
                    <div class="form-group">
                        <label for="motivo">Ingrese motivo de la visita</label>
                        <input type="text" class="form-control" name="motivo" id="motivo" placeholder="Motivo">
                    </div>
                    <div class="form-group">
                        <label for="dia">Ingrese dia de la visita</label>
                        <input type="date" class="form-control" name="dia" id="dia" placeholder="">
                    </div>
                    <!--
                    <div class="form-group">
                        <label for="est">Seleccione estado de la visita</label>
                        <select class="form-control" name="est" id="est">
                            <option value="Activo">Activo</option>
                            <option value="Atendida">Atendida</option>
                            <option value="Eliminada">Eliminada</option>
                        </select>
                    </div>
                    -->
                    <div>
                        <br>
                        <button id="submit" type="submit" formmethod="post" formaction="insertarVisita.php" class="btn btn-primary">Guardar</button>
                        <button id="submit" type="submit" formmethod="post" formaction="tablasVisitas.php" class="btn btn-primary"> Volver a tablas </button>

                    </div>
                </form>

                <div class="row">
                    <div>
                        <div>

                        </div>
                    </div>

                </div>




            </div>
            <!-- ESTO ES LO QUE PODEMOS MODIFICAR -->
            <!-- partial:partials/_footer.html -->

            <!-- partial -->
        </div>

        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->


    </div>

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->

    <div class="jvectormap-tip"></div>
</body>

</html>