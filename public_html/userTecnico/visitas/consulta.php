<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Atory-Visita consulta</title>
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
  $id = $_GET["id"];
  $sql = "SELECT * FROM usuario
                      INNER JOIN user_visita
                      INNER JOIN visitas
                      INNER JOIN cliente
                      INNER JOIN plan
                      WHERE usuario.`idUsuario`=user_visita.`user_idUser`
                      AND user_visita.`visita_idVisita`=visitas.`idVisita`
                      AND  cliente.`idCliente`=visitas.`visita_idCliente`
                      AND cliente.`plan_idPlan`=plan.`idPlan`
                      AND idVisita=$id;";
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
      $comentario = $row['comentario'];
    }
  }
  ?>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h1 class="page-title">Visita: <?php echo "$idv" ?> </h1>
        <h1 class="page-title">Tipo de visita: <?php echo "$tipov" ?> </h1>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Información de la visita</h4>
              <h4 class="card-title">Nombre del cliente: <?php echo "$nomCliente" ?></h4>
              <form class="forms-sample">
                <div class="form-group">
                  <label for="">Telefono Cliente: <?php echo "$telCliente" ?></label>
                </div>
                <div class="form-group">
                  <label for="vel">Direccion Cliente : <?php echo "$dirCliente" ?></label>
                </div>
                <div class="form-group">
                  <label for="plan">Nombre Tecnico : <?php echo " $nombresu" ?></label>
                </div>
                <div class="form-group">
                  <label for="plan">Número del técnico : <?php echo " $telu" ?></label>
                </div>
                <div class="form-group">
                  <label for="plan">Motivo de la visita : <?php echo " $motivo" ?></label>
                </div>
                <div class="form-group">
                  <label for="plan">Plan contratado: <?php echo " $nombreplan" ?> del tipo <?php echo "$tipoplan" ?></label>
                </div>
                <div class="form-group">
                  <label for="plan">Velocidad del plan: <?php echo " $velplan" ?></label>
                </div>
                <div class="form-group">
                  <label for="plan">Fecha de la visita : <?php echo " $diaVisita" ?></label>
                </div>
                <div class="form-group">
                  <label for="plan">Estado de la visita: <?php echo " $eVisita" ?></label>
                </div>
                <div class="form-group">
                  <label for="plan">Comentarios: <?php echo " $comentario" ?></label>
                </div>
                <div class="form-button mt-5">
                  <a href="actualizarVisita.php?id=<?php echo "$id" ?>" class="btn btn-danger btn-lg">Agregar Comentario</a>
                  <button id="submit" type="submit" formmethod="post" formaction="../visitas/inicioVisitasT.php" class="btn btn-primary btn-lg">Volver</button>

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