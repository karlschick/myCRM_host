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
<!DOCTYPE html>
<html>

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Atory Solutions</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.png">
  <style type="text/css">
    /* Chart.js */
    @keyframes chartjs-render-animation {
      from {
        opacity: .99
      }

      to {
        opacity: 1
      }
    }

    .chartjs-render-monitor {
      animation: chartjs-render-animation 1ms
    }

    .chartjs-size-monitor,
    .chartjs-size-monitor-expand,
    .chartjs-size-monitor-shrink {
      position: absolute;
      direction: ltr;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      overflow: hidden;
      pointer-events: none;
      visibility: hidden;
      z-index: -1
    }

    .chartjs-size-monitor-expand>div {
      position: absolute;
      width: 1000000px;
      height: 1000000px;
      left: 0;
      top: 0
    }

    .chartjs-size-monitor-shrink>div {
      position: absolute;
      width: 200%;
      height: 200%;
      left: 0;
      top: 0
    }
  </style>
</head>

<body>
  <?php
  include '../menu/menuint.php';
  ?>
  <!-- partial -->


  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <div class="card">
        <div class="card-body">
          <a href="atentidas.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Consultar solicitudes atendidas</a>
          <?php

          require_once __DIR__ . '/../config/db.php';

          $sql = "SELECT * FROM solicitudes WHERE estadoSolicitud='Activo';";

          echo '<div class="table-responsive">
            <table class="table table-hover">
            <thead>
        <tr>
        <th> Id Solicitud </th>
        <th> Nombres del cliente</th>
        <th> Telefono </th>
        <th> Correo CLiente </th>
        <th> Responder solicitud</th>
    </tr>
    </thead>
    ';

          if ($rta = $con->query($sql)) {
            while ($row = $rta->fetch_assoc()) {
              $i = $row['idSolicitud'];
              $nombres = $row['nombres'];
              $tel = $row['telefono'];
              $email = $row['email'];
              $epqr = $row['estadoSolicitud'];
          ?>
              <tr>
                <td> <?php echo "$i" ?></td>
                <td> <?php echo "$nombres" ?></td>
                <td> <?php echo "$tel" ?></td>
                <td> <?php echo "$email" ?></td>

                <th><a href="elisoli.php?i=<?php echo $row['idSolicitud'] ?>" class="btn btn-danger">Responder</a></th>
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