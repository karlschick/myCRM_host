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

  $id = $_GET['id'];
  $sql = "SELECT * FROM usuario
  INNER JOIN user_visita
  INNER JOIN visitas
  INNER JOIN cliente
  INNER JOIN plan
  WHERE usuario.`idUsuario`=user_visita.`user_idUser`
  AND user_visita.`visita_idVisita`=visitas.`idVisita`
  AND  cliente.`idCliente`=visitas.`visita_idCliente`
  AND cliente.`plan_idPlan`=plan.`idPlan`
  AND idVisita='$id';";
if ($rta = $con->query($sql)) {
while ($row = $rta->fetch_assoc()) {
$idu = $row['idUsuario'];
$tdu = $row['tipoDocumento'];
$docu = $row['documentoUsuario'];
$nombresu = $row['nombresUsuario'];
$telu = $row['telefonoUsuario'];
$emailu = $row['correoUsuario'];
$estadou = $row['estadoUsuario'];
$creadou = $row['creado'];
$upu = $row['ultimaActualizacion'];
$rolu = $row['rol'];
$uservisita = $row['iduser_visita'];
$visita_idvisita = $row['visita_idVisita'];
$user_idUser = $row['user_idUser'];
$idv = $row['idVisita'];
$tipov = $row['tipoVisita'];
$motivo = $row['motivoVisita'];
$diaVisita = $row['diaVisita'];
$eVisita = $row['estadoVisita'];
$visitacliente = $row['visita_idCliente'];
$comentario = $row['comentario'];
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
$velplan = $row['velocidad'];
$nombreplan = $row['nombrePlan'];
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
                        <h4 class="card-title">Hola <?php echo "$nomCliente" ?></h4>
                      </center>

                      <div class="form-group">
                        <div>
                          <center><label for="cp">Con : <?php echo "$tdc: $docCliente" ?></label></center>
                        </div>
                        <div>
                          <center><label for="des"> Su telefono es <?php echo "$telCliente" ?></label>
                            <center>
                        </div>
                        <div>
                          <center><label for="des"> Su correo es: <?php echo "$emailCliente" ?></label></center>
                        </div>
                        <div>
                          <center><label for="cp">Tiene un plan: <?php echo "$nombreplan" ?></label></center>
                        </div>
                        <div>
                          <center><label for="cp">Su visita es : <?php echo "$diaVisita" ?></label></center>
                        </div>
                        <div>
                          <center><label for="cp">Motivo: <?php echo "$tipov" ?></label></center>
                        </div>
                        <div>
                          <center><label> Detalles de la visita: <?php echo "$motivo"?><label></center>
                        </div>
                          <center><label>_______________________</label></center>
                        </div>
                        <div>
                          <center><label for="plan">Estado de la visita: <?php echo "$eVisita " ?></label></center>
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