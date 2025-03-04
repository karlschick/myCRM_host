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

    <!-- partial -->


    <div class="main-panel">

        <div class="content-wrapper">
            <div class="page-header">
                <h1 style="font-size: 32px;">GESTIÓN TABLAS VISITAS E INSTALACIONES</h1>

            </div>

            <div class="card">
                <div class="card-body">
                    <a href="ingresarVisita.php" class="btn btn-primary btn-lg">Ingresar nueva Visita</a>
                    <a href="../visitas/consultarVisitas.php" class="btn btn-primary btn-lg ">Consultar visitas</a>
                    <a href="../visitas/tablasVisitas.php" class="btn btn-danger btn-lg ">Volver</a>
                    <a href="../excel/excelVisitas.php" class="btn btn-success btn-lg">Exportar tabla a Excel</a>

                    <?php
                    include("../conexion.php");

                    $sql = "select * from usuario
                    inner join user_visita
                    inner join visitas
                    Inner join cliente
                    where usuario.`idUsuario`=user_visita.`user_idUser`
                    and user_visita.`visita_idVisita`=visitas.`idVisita`
                    and  cliente.`idCliente`=visitas.`visita_idCliente`
                    and visitas.estadoVisita='Archivado'
                    ORDER BY visitas.`idVisita` DESC;";

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
                            $idu=$row['idUsuario'];
                            $tdu=$row['tipoDocumento'];
                            $docu = $row['documentoUsuario'];
                            $nombresu=$row['nombresUsuario'];
                            $telu=$row['telefonoUsuario'];
                            $emailu=$row['correoUsuario'];
                            $estadou=$row['estadoUsuario'];
                            $creadou=$row['creado']; 
                            $upu=$row['ultimaActualizacion'];
                            $rolu=$row['rol']; 
                            $uservisita=$row['iduser_visita'];
                            $visita_idvisita=$row['visita_idVisita'];
                            $user_idUser=$row['user_idUser'];
                            $idv=$row['idVisita'];
                            $tipov=$row['tipoVisita'];
                            $motivo = $row['motivoVisita'];
                            $diaVisita = $row['diaVisita'];
                            $eVisita = $row['estadoVisita'];
                            $visitacliente=$row['visita_idCliente'];
                            $idc=$row['idCliente'];
                            $tdc=$row['tipoDocumento'];                  
                            $docCliente = $row['documentoCliente'];
                            $nomCliente = $row['nombreCliente'];
                            $telCliente = $row['telefonoCliente'];
                            $emailCliente = $row['correoCliente'];
                            $dirCliente = $row['direccion'];
                            $estado_cliente=$row['estadoCliente'];
                            $plan_idPlan=$row['plan_idPlan'];
                            $crearcliente=$row['creado'];
                            $uacliente=$row['ultimaActualizacion'];
                    ?>
                            <tr>
                                <td> <?php echo "$idv" ?></td>
                                <td> <?php echo "$nomCliente" ?></td>
                                <td> <?php echo "$telCliente" ?></td>
                                <td> <?php echo "$nombresu" ?></td>
                                <td> <?php echo "$tipov" ?></td>
                                <td> <?php echo "$diaVisita" ?></td>

                                <th><a href="consulta.php?id=<?php echo $row['idVisita'] ?>" class="btn btn-info">Ver Visita</a>
                                </th>
                            </tr>
                    <?php
                        }
                    }

                    ?>


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