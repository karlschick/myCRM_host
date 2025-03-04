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

/* 
include "login/claseSeguridad.php";

$seguridad = new Seguridad();
if ($seguridad->getUsuario()==null) {
    header ('location:index.html');
}
*/
include '../../includes/header.php';
?>



<body>
    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>
    <!-- partial -->

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h1 style="font-size: 32px;">GESTIÓN CLIENTES</h1>

            </div>
            <div class="card">
                <div class="card-body">
                    <a href="ingresar.php" class="btn btn-primary btn-lg " role="button" aria-pressed="true">Crear nuevo cliente</a>
                    <a href="principal.php" class="btn btn-primary btn-lg " role="button" aria-pressed="true">Consultar cliente</a>

                    <a href="excel/excelCliente.php" class="btn btn-success btn-lg">Exportar a Excel</a>
                    <?php
                    include("conexion.php");

                    $sql = "SELECT cliente.tipoDocumento,cliente.documentoCliente,cliente.nombreCliente,plan.nombrePlan FROM cliente 
                    INNER JOIN plan
                    ON cliente.plan_idPlan=plan.idPlan
                    WHERE estadoCliente='Activo'
                    ORDER BY nombreCliente ASC;";

                    echo
                    '<div class="table-responsive">
                    
        <table class="table table-hover ">
          <thead>
            <tr>
              <th> Tipo identificacion </th>
              <th> Numero de documento</th>
              <th> Nombres</th>
              <th> Plan</th>
              <th> Actualizar</th>
              <th> Eliminar</th>
            </tr>
          </thead>';

                    if ($rta = $con->query($sql)) {
                        while ($row = $rta->fetch_assoc()) {
                            $td = $row['tipoDocumento'];
                            $id = $row['documentoCliente'];
                            $nombres = $row['nombreCliente'];
                            $plan = $row['nombrePlan'];
                    ?>
                            <tr>
                                <td> <?php echo $td ?></td>
                                <td> <?php echo $id ?></td>
                                <td> <?php echo $nombres ?></td>
                                <td> <?php echo $plan ?></td>
                                <td>
                                    <a href="actualizar.php?id=<?php echo $row['documentoCliente'] ?>" class="btn btn-info">Editar</a>
                                </td>
                                <td>
                                    <a class="borrar btn btn-danger" href="delete.php?id=<?php echo $row['documentoCliente'] ?>">Eliminar</a>
                                </td>



                            </tr>
                    <?php
                        }
                    }
                    ?>
                    </table>
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