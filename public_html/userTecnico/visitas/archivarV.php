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
      <div class="card-body">
        <h4 class="card-title">GESTION DE VISITAS</h4>
        <p class="card-description"> Ingrese Comentario sobre la visita </p>
        <?php
        include_once "conexion.php";
        $id = $_GET["id"];
        $sql = "SELECT * FROM visitas WHERE idVisita='$id';";
        if ($rta = $con->query($sql)) {
          while ($row = $rta->fetch_assoc()) {
            $nomCliente = $row['nombreCliente'];
            $telCliente = $row['telefonoCliente'];
            $dirCliente = $row['direccionCliente'];
            $nomTec = $row['nombreTecnico'];
            $motivo = $row['motivoVisita'];
            $diaVisita = $row['diaVisita'];
            $comentario = $row['comentario'];
          }
        }
        ?>

        <h3 class="page-title">Visitas: </h3>

        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title"><?php echo "$nomCliente" ?></h4>
                <form class="forms-sample">
                  <div class="form-group">
                    <label for="">Telefono Cliente: <?php echo "$telCliente" ?></label>
                  </div>
                  <div class="form-group">
                    <label for="vel">Direccion Cliente : <?php echo "$dirCliente" ?></label>
                  </div>
                  <div class="form-group">
                    <label for="plan">Nombre Tecnico : <?php echo " $nomTec" ?></label>
                  </div>
                  <div class="form-group">
                    <label for="plan">Motivo de la visita : <?php echo " $motivo" ?></label>
                  </div>
                  <div class="form-group">
                    <label for="plan">Fecha de la visita : <?php echo " $diaVisita" ?></label>
                  </div>
                  <div class="form-group">
                    <label for="plan">Comentarios del tecnico en visita : <?php echo " $comentario" ?></label>
                  </div>
                  <div class="form-button mt-5">
                    <button id="submit" type="submit" formmethod="post" formaction="../visitas/actualizarVisita.php" class="btn btn-primary">Editar comentario </button>
                  </div>
                  <div class="form-button mt-5">
                    <button id="submit" type="submit" formmethod="post" formaction="../visitas/eliminarVisita.php" class="btn btn-primary">Marcar como Atendida</button>
                  </div>

                </form>
              </div>
            </div>
          </div>
        </div>
        <form action="updateComentario.php" method="POST">

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