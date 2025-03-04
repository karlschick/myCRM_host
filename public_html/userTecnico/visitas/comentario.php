<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
  header("location:../index.html");
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
  <?php
  include("../conexion.php");
  $id = $_GET['id'];
  $sql = "SELECT * FROM visitas WHERE idVisita='$id'";
  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);
  ?>
  <title>ATORY - Admin</title>
  <!-- Estilos de los plugins -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- Fin de los estilos de los plugins -->
  <!-- Estilos del archivo actual -->
  <link rel="stylesheet" href="../assets/css/style.css">
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
      <div class="row">
        <div class="col-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">GESTION DE VISITAS</h4>
              <p class="card-description"> Ingrese los datos </p>
              <form action="updateVisita.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['idVisita']  ?>">
                <input type="text" class="form-control mb-3" name="comentario" placeholder="comentario" value="<?php echo $row['comentario']  ?>">

                <input type="submit" class="btn btn-primary btn-lg" value="Agregar comentario" formmethod="post" formaction=../visitas/updateComentario.php>
                <input type="submit" class="btn btn-danger btn-lg" value="Volver" formmethod="post" formaction=../visitas/inicioVisitasT.php>
              </form>

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