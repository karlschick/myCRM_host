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
    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>

  <!-- partial -->
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

  </div>

  </div>

  </div>

</body>

</html>