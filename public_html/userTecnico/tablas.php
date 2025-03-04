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
    <?php
    include 'menu/menu.php';
    ?>
    <!-- partial -->

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card-body">
                <a href="principal.php" class="btn btn-primary " role="button" aria-pressed="true">Volver al inicio</a>
                <a href="excel/excelCliente.php" class="btn btn-success">Exportar a Excel</a>
                <?php
                include("conexion.php");

                $sql = "SELECT * FROM cliente WHERE estadoCliente='Activo';";

                echo '<div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th> Tipo identificacion </th>
              <th> Numero de documento</th>
              <th> Nombres</th>
              <th> Telefono</th>
              <th> email</th>
              <th> Dirección</th>
              <th> Estado</th>
              <th> Fecha de creacion</th>
              <th> Ultima Actualización</th>
              <th> Actualizar</th>
              <th> Eliminar</th>
            </tr>
          </thead>';

                if ($rta = $con->query($sql)) {
                    while ($row = $rta->fetch_assoc()) {
                        $td = $row['tipoDocumento'];
                        $id = $row['documentoCliente'];
                        $nombres = $row['nombreCliente'];
                        $telefono = $row['telefonoCliente'];
                        $email = $row['correoCliente'];
                        $dir = $row['direccion'];
                        $estado = $row['estadoCliente'];
                        $creacion = $row['creado'];
                        $act = $row['ultimaActualizacion'];
                ?>
                        <tr>
                            <td> <?php echo $td ?></td>
                            <td> <?php echo $id ?></td>
                            <td> <?php echo $nombres ?></td>
                            <td> <?php echo $telefono ?></td>
                            <td> <?php echo $email ?></td>
                            <td> <?php echo $dir ?></td>
                            <td> <?php echo $estado ?></td>
                            <td> <?php echo $creacion ?></td>
                            <td> <?php echo $act ?></td>
                            <td>
                                <a href="actualizar.php?id=<?php echo $row['documentoCliente'] ?>" class="btn btn-info">Editar</a>
                            </td>
                            <td>
                                <a href="delete.php?id=<?php echo $row['documentoCliente'] ?>" class="btn btn-danger">Eliminar</a>
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


    <!-- ESTO ES LO QUE PODEMOS MODIFICAR -->
    <!-- partial:partials/_footer.html -->

    <!-- partial -->
    </div>
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Atory Solution 2023</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> <a href=" " target="_blank"></a> </span>
        </div>
    </footer>
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