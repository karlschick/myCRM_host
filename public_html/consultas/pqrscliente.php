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
  <?php
    require_once __DIR__ . '/../../config/db.php';

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
                <img class="logo" src="../assets/images/empresa/logoEmpresa.png" alt="logo" style="max-width: 20%; height: auto" class="img-responsive" />
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

</body>

</html>