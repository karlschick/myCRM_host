<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
    header("location:../../index.php");
    die();
    exit;
}

// Incluye el encabezado de la página
include '../../../includes/header.php';
?>


<body>
    <?php include '../../../includes/menutec.php'; ?>

    <!-- partial -->


    <div class="main-panel">

        <div class="content-wrapper">
            <div class="page-header">
                <h1 style="font-size: 32px;">Visitas tecnicas e Instalaciones</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="tablasAtendidas.php">

                        <?php
                        require_once __DIR__ . '/../../../config/db.php';
                        $id = $_POST["id"];

                        $sql = "SELECT * FROM usuario
                    INNER JOIN user_visita
                    INNER JOIN visitas
                    INNER JOIN cliente
                    WHERE usuario.`idUsuario`=user_visita.`user_idUser`
                    AND user_visita.`visita_idVisita`=visitas.`idVisita`
                    AND  cliente.`idCliente`=visitas.`visita_idCliente`
                    AND usuario.`documentoUsuario`= '$id'
                    AND estadoVisita = 'Activo';";

                        echo '<div class="table-responsive">
                <table class="table table-hover">
                <thead>
            <tr>
            <th> Visita No.</th>
            <th> Nombre Cliente</th>
            <th> Telefono Cliente</th>
            <th> Nombre técnico</th>
            <th> Tipo de visita</th>
            <th> Dia de la visita </th>
        </tr>
        </thead>
        ';
                        if ($rta = $con->query($sql)) {
                            while ($row = $rta->fetch_assoc()) {
                                $idu = $row['idUsuario'];
                                $tdu = $row['tipoDocumento'];
                                $docu = $row['documentoUsuario'];
                                $nombresu = $row['nombresUsuario'];
                                $telu = $row['telefonoUsuario'];
                                $emailu = $row['correoUsuario'];
                                $estadou = $row['estadoUsuario'];
                                $creadou = $row['creado'];
                                $upu = $row['ultimaActualizacion'];
                                $rolu = $row['rol'];
                                $uservisita = $row['iduser_visita'];
                                $visita_idvisita = $row['visita_idVisita'];
                                $user_idUser = $row['user_idUser'];
                                $idv = $row['idVisita'];
                                $tipov = $row['tipoVisita'];
                                $motivo = $row['motivoVisita'];
                                $diaVisita = $row['diaVisita'];
                                $eVisita = $row['estadoVisita'];
                                $visitacliente = $row['visita_idCliente'];
                                $idc = $row['idCliente'];
                                $tdc = $row['tipoDocumento'];
                                $docCliente = $row['documentoCliente'];
                                $nomCliente = $row['nombreCliente'];
                                $telCliente = $row['telefonoCliente'];
                                $emailCliente = $row['correoCliente'];
                                $dirCliente = $row['direccion'];
                                $estado_cliente = $row['estadoCliente'];
                                $plan_idPlan = $row['plan_idPlan'];
                                $crearcliente = $row['creado'];
                                $uacliente = $row['ultimaActualizacion'];
                        ?>
                                <tr>
                                    <td> <?php echo "$idv" ?></td>
                                    <td> <?php echo "$nomCliente" ?></td>
                                    <td> <?php echo "$telCliente" ?></td>
                                    <td> <?php echo "$nombresu" ?></td>
                                    <td> <?php echo "$tipov" ?></td>
                                    <td> <?php echo "$diaVisita" ?></td>
                                    <input type="hidden" name="id" value="<?php echo $docu ?>">
                                    <button type="submit" class="btn btn-primary btn-lg">Ver visitas Atendidas</button>

                                    <th><a href="consulta.php?id=<?php echo $row['idVisita'] ?>" class="btn btn-primary">Ver informacion de la visita</a></th>


                                    <th><a href="eliminarVisita.php?id=<?php echo $row['idVisita'] ?>" class="borrar btn btn-danger">Marcar como Atendida</a></th>
                                    </th>
                                </tr>
                        <?php
                            }
                        }

                        ?>

                        <!-- ESTO ES LO QUE PODEMOS MODIFICAR -->
                        <!-- partial:partials/_footer.html -->

                        <!-- partial -->
                </div>
                </form>
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
    <!-- Estas ultimas lineas son para la alerta DE BORRAR, INSERTA SWEET ALERT Y LUEGO ESTA EL SCRIPT PARA BORRAR-->
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
    <!-- Hasta aca va la alerta-->

</body>

</html>