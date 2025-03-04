<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>AtorySolution</title>
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
  <style>
    .form-group>div {
      margin-bottom: 1px;
    }
  </style>
</head>

<body>
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
  $sql2 = "SELECT * FROM empresa WHERE id='1';";
  $query2 = mysqli_query($con, $sql2);
  $row = mysqli_fetch_array($query2);

  ?>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h2 class="page-title">VISITA</h2>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-6 col-12 grid-margin stretch-card mx-auto">
          <div class="card">
            <div class="card-body">
              <div style="text-align: center;">
                <img class="logo" src="../empresa/logoEmpresa.png" alt="logo" style="max-width: 20%; height: auto" class="img-responsive" />
              </div>
              <br>
              <center>
                <h2 class="card-title"><?php echo $row['nombEmpresa'] ?></h2>
              </center>


              <form class="forms-sample">

                <div class="form-group">
                  <div class="card-body">

                    <form class="forms-sample">
                      <center><class="card-title"><?php echo $row['rz'] ?></center>
                      <center><class="card-title">nit : <?php echo $row['nit'] ?></center>
                      <center><class="card-title">tel : <?php echo $row['telsede'] ?></center>
                      <center><class="card-title">tel2 : <?php echo $row['telsede2'] ?></center>
                      <br>
                      <center>
                        <h4 class="card-title">Hola <?php echo "$nombres" ?></h4>
                      </center>

                      <div class="form-group">
                        <div>
                          <center><label for="cp">Con : <?php echo "$td: $id" ?></label></center>
                        </div>
                        <div>
                          <center><label for="des"> Su telefono es <?php echo "$tel" ?></label>
                            <center>
                        </div>
                        <div>
                          <center><label for="des"> Su correo es: <?php echo "$email" ?></label></center>
                        </div>
                        <div>
                          <center><label for="cp">Tiene un tipo de contacto: <?php echo "$soli" ?></label></center>
                        </div>
                        <div>
                          <center><label for="cp">Motivo: <?php echo "$dp" ?></label></center>
                        </div>
                        <div>
                          <center><label>Se encuentra Actualmente: <?php echo "$epqr"?><label></center>
                        </div>
                          <center><label>_______________________</label></center>
                        </div>
                        <div>
                          <center><label for="plan">Respuesta: <?php echo "$com" ?></label></center>
                        </div>

                      </div>

                      <center><a href="../index.html" class="btn btn-light btn-lg active" role="button" aria-pressed="true">Volver </a>
                        <a href="../index.html" class="btn btn-light btn-lg active" role="button" aria-pressed="true">Imprimir </a>
                      </center>
                    </form>
                  </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
      <script src="../assets/js/off-canvas.js"></script>
      <script src="../assets/js/hoverable-collapse.js"></script>
      <script src="../assets/js/misc.js"></script>
      <script src="../assets/js/settings.js"></script>
      <script src="../assets/js/todolist.js"></script>
</body>

</html>