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
  $sql = "SELECT * FROM cliente
  INNER JOIN plan
  WHERE plan.`idPlan`=cliente.`plan_idPlan`
  AND idCliente='$id';";

  if ($rta = $con->query($sql)) {
    while ($row = $rta->fetch_assoc()) {
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
      $tipoplan = $row['tipoPlan'];
      $nombreplan = $row['nombrePlan'];
    }
  };

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
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title">NUEVA VISITA</h1>
            <h2 class="card-title">Información del cliente</h2>
            <h4 class="card-title">Nombre del cliente: <?php echo "$nomCliente" ?></h4>
            <form class="forms-sample">
              <div class="form-group">
                <h4 for="">Telefono Cliente: <?php echo "$telCliente" ?></h4>
              </div>
              <div class="form-group">
                <h4 for="">nombre del plan: <?php echo "$nombreplan" ?> del tipo: <?php echo "$tipoplan" ?></h4>
              </div>
              <div>
                <h1 class="card-tittle">Información de la visita</h1>
                <form action="insertarVisita.php" method="POST">
                  <input type="hidden" name="idCliente" value="<?php echo $row['idCliente']  ?>">
                  <label for="tipoVisita">Tipo de visita: </label>
                  <select class="form-control" name="tipoVisita" id="tipoVisita" placeholder="Tipo de visita">
                    <option value="Instalacion">Instalacion</option>
                    <option value="Desinstalacion">Desinstalacion</option>
                    <option value="Reparacion">Reparacion</option>
                  </select>

                  <p></p>
                  <label>Motivo de la visita</label>
                  <input type="text" class="form-control mb-3" name="motivoVisita" placeholder="Motivo de la visita">
                  <label>Dia de la visita</label>
                  <input type="date" class="form-control mb-3" name="diaVisita" placeholder="Dia de la visita">
                  <label for="">Estado de la visita</label>
                  <select class="form-control" name="estadoVisita" id="estadoVisita" placeholder="Estado de visita">
                    <option value="Activo">Activo</option>
                    <option value="Completado">Completado</option>
                    <option value="Archivado">Archivado</option>
                  </select>
                  <p></p>
                  <label for="">Tecnico asignado</label>
                  <select class="form-control" aria-label="Default select example" name="idTecnico" id="idTecnico" placeholder="Técnico asignado">

                    <?php
                    $sql = "SELECT * FROM usuario WHERE rol='Tecnico' and estadoUsuario='Activo';";
                    $query = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($query);
                    if ($rta = $con->query($sql)) {
                      while ($row = $rta->fetch_assoc()) {
                        $idUsuario = $row['idUsuario'];
                        $nombresUsuario = $row['nombresUsuario'];

                    ?>
                        <option value="<?php echo $idUsuario ?>"><?php echo "$nombresUsuario" ?> </option>

                    <?php
                      }
                    }
                    ?>
                    <input type="submit" class="btn btn-primary btn-block" value="Crear Visita" formmethod="post" formaction=../visitas/insertarVisita.php>
                    <input type="submit" class="btn btn-danger btn-block" value="Cancelar" formmethod="post" formaction=../visitas/tablasVisitas.php>
                </form>


              </div>
              <!-- ESTO ES LO QUE PODEMOS MODIFICAR -->
              <!-- partial:partials/_footer.html -->

              <!-- partial -->
          </div>
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