    <!-- actualizado -->

<?php
// Seguridad de sesiones (prueba 1)
session_start();
error_reporting(0);

// Verifica si el usuario tiene una sesión activa
$varsesion = $_SESSION['usuario'];
if (empty($varsesion)) {
    header("Location: ../index.php");
    die(); // No es necesario usar exit después de die()
}

// Incluye el encabezado de la página
include '../../includes/header.php';
?>

<body>
    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>


    <div class="main-panel">
        <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
            <div class="card-body">
                <a href="principal.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Volver al inicio</a>
                <?php
                require_once __DIR__ . '/../../config/db.php';


                $doc = $_POST['id'];
                $sql = "SELECT * FROM cliente  
                    INNER JOIN plan
                    ON cliente.plan_idPlan=plan.idPlan
                    WHERE documentoCliente= '$doc';";


                if ($rta = $con->query($sql)) {
                    while ($row = $rta->fetch_assoc()) {
                        $id = $row['idCliente'];
                        $td = $row['tipoDocumento'];
                        $doc = $row['documentoCliente'];
                        $nombres = $row['nombreCliente'];
                        $telefono = $row['telefonoCliente'];
                        $email = $row['correoCliente'];
                        $dir = $row['direccion'];
                        $estado = $row['estadoCliente'];
                        $plan = $row['plan_idPlan'];
                        $creacion = $row['creado'];
                        $act = $row['ultimaActualizacion'];
                        $idplan = $row['idPlan'];
                        $codigoplan = $row['codigoPlan'];
                        $tipoplan = $row['tipoPlan'];
                        $velocidad = $row['velocidad'];
                        $nombreplan = $row['nombrePlan'];
                        $precioplan = $row['precioPlan'];
                        $desplan = $row['desPlan'];
                        $estadoplan = $row['estadoPlan'];
                ?>
                        <div class="main-panel">
                            <div class="content-wrapper">
                                <div class="page-header">
                                    <h2 class="page-title">Cliente</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">El cliente <?php echo "$nombres" ?>, identificado con <?php echo "$td: $doc" ?></h4>
                                                <form class="forms-sample">
                                                    <div class="form-group">
                                                        <div class="card-body">


                                                            <form class="forms-sample">
                                                                <div class="form-group">
                                                                    <label for="cp"> Telefono: <?php echo "$telefono" ?> </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="cp">Email: <?php echo "$email" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="plan">Direccion: <?php echo "$dir" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="plan">Creado: <?php echo "$creacion" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="plan">Actualizado: <?php echo "$act" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="des">Tipo de plan: <?php echo "$tipoplan" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="des">Nombre Plan: <?php echo "$nombreplan"  ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="des">Velocidad: <?php echo "$velocidad" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="des">Precio: <?php echo "$precioplan" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="des">Descripción: <?php echo "$desplan" ?></label>
                                                                </div>
                                                                <td>
                                                                    <a href="actualizar.php?id=<?php echo $row['documentoCliente'] ?>" class="btn btn-info btn-lg">Editar</a>
                                                                </td>
                                                                <a href="tablas.php" class="btn btn-light btn-lg active" role="button" aria-pressed="true">Volver</a>
                                                            </form>
                                                        </div>
                                                    </div>
                                            </div>

                                            <!-- content-wrapper ends -->
                                            <!-- partial:../../partials/_footer.html -->


                                        </div>
                                        <!-- partial -->
                                    </div>
                                    <!-- main-panel ends -->
                                </div>
                                <!-- page-body-wrapper ends -->
                            </div>
                    <?php
                    }
                }

                    ?>

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