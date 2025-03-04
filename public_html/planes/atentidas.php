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

// Incluye el encabezado de la página
include '../../includes/header.php';
?>
<body>
  
    <?php include '../../includes/menu.php'; ?>
  <div class="main-panel">
    <div class="content-wrapper"> 
    <div class="card">
      <div class="card-body">
        <a href="solicitudes.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Volver a Solicitudes</a>
        <?php
          require_once __DIR__ . '/../../config/db.php';

        $sql = "SELECT * FROM solicitudes WHERE estadoSolicitud='Atendido';";

        echo '<div class="table-responsive">
            <table class="table table-hover">
            <thead>
        <tr>
        <th> Id Solicitud </th>
        <th> Nombres del cliente</th>
        <th> Telefono </th>
        <th> Correo CLiente </th>
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

            </tr>
        <?php
          }
        }

        ?>

        <!-- ESTO ES LO QUE PODEMOS MODIFICAR -->

      </div>
      </div>

    </div>



  </div>

  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>

  <script src="../assets/vendors/chart.js/Chart.min.js"></script>
  <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>

  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>

  <script src="../assets/js/dashboard.js"></script>


  <div class="jvectormap-tip"></div>
</body>

</html>