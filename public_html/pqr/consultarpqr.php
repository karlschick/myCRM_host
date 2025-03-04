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
<html lang="en">

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
  <!-- End Plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>

<body>
  <?php
  include '../menu/menuint.php';
  ?>
  <!-- partial -->
  <?php
  include_once "conexion.php";
  $i = $_GET["i"];
  $sql = "SELECT * FROM pqr2 WHERE idPqr= '$i';";
  if ($rta = $con->query($sql)) {
    while ($row = $rta->fetch_assoc()) {
      $td = $row['tipoDocumento'];
      $id = $row['nDocumento'];
      $nombres = $row['nombresCliente'];
      $tel = $row['telefonoCliente'];
      $email = $row['emailCliente'];
      $soli = $row['tPqr'];
      $dp = $row['desPqr'];
      $epqr = $row['estadoPqr'];
      $com = $row['comentario'];
    }
  }
  ?>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h1 style="font-size: 32px;">Contacto cliente</h1>
        <h3 class="page-title">Tipo <?php echo "$soli" ?> </h3>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Cliente: <?php echo "$nombres" ?></h4>
              <form class="forms-sample">
                <div class="form-group">
                  <label for="cp">Motivo: <?php echo "$soli" ?></label>
                </div>
                <div class="form-group">
                  <label for="vel">Documento Cliente: <?php echo "$id" ?></label>
                </div>
                <div class="form-group">
                  <label for="plan">Estado Actual: <?php echo " $epqr" ?></label>
                </div>
                <div class="form-group">
                  <label for="des"> Razón de contacto: <?php echo "$dp" ?></label>
                </div>
                <div class="form-group">
                  <h3 class="page-tittle"> Contactar al cliente: </h3>
                </div>
                <div class="form-group">
                  <label for="des"> Numero de telefono: <?php echo "$tel" ?></label>
                </div>
                <div class="form-group">
                  <label for="des"> Correo Electronico: <?php echo "$email" ?></label>
                </div>
                <div class="form-group">
                  <label for="des"> Comentarios y respuesta del Administrador: <?php echo "$com" ?></label>
                </div>

                <div class="form-button mt-5">
                  <button id="submit" type="submit" formmethod="post" formaction="pqr.php" class="btn btn-primary">Volver a PQR</button>
                  <button id="submit" type="submit" formmethod="post" formaction="inpqr.php" class="btn btn-primary">Ver PQR Respondidos</button>
                </div>

              </form>
            </div>
          </div>
        </div>
      </div>

    </div>
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
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>