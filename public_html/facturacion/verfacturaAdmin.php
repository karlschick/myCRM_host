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

  $id = $_GET['id'];
  $sql = "SELECT * FROM cliente  
  INNER JOIN plan
  INNER JOIN factura
  WHERE cliente.plan_idPlan=plan.idPlan
  AND cliente.idCliente=factura.cliente_idCliente
  AND idFactura= '$id';";

  if ($rta = $con->query($sql)) {
    while ($row = $rta->fetch_assoc()) {
      $id = $row['idCliente'];
      $td = $row['tipoDocumento'];
      $doc = $row['documentoCliente'];
      $nomc = $row['nombreCliente'];
      $telc = $row['telefonoCliente'];
      $emailc = $row['correoCliente'];
      $dc = $row['direccion'];
      $ec = $row['estadoCliente'];
      $plancliente = $row['plan_idPlan'];
      $creado = $row['creado'];
      $uact = $row['ultimaActualizacion'];
      $idplan = $row['idPlan'];
      $codigoplan = $row['codigoPlan'];
      $tipoplan = $row['tipoPlan'];
      $vp = $row['velocidad'];
      $nombreplan = $row['nombrePlan'];
      $precioplan = $row['precioPlan'];
      $descripcionplan = $row['desPlan'];
      $estadoplan = $row['estadoPlan'];
      $if = $row['idFactura'];
      $fing = $row['fechaFactura'];
      $impt = $row['impuestoTotal'];
      $sub = $row['subTotal'];
      $st = $row['valorTotalFactura'];
      $cid = $row['cliente_idCliente'];
      $estf = $row['estadoFactura'];
      $ffact = $row['fechaVencimiento'];
      $flim = $row['fechaSuspencion'];
      $nplan = $row['nPlan'];
    }
  }
  $sql2 = "SELECT * FROM empresa WHERE id='1';";
  $query2 = mysqli_query($con, $sql2);
  $row = mysqli_fetch_array($query2);

  ?>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h2 class="page-title">FACTURA</h2>
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
                        <h4 class="card-title">Hola <?php echo "$nomc" ?></h4>
                      </center>
                      <div class="form-group">
                        <div>
                          <center><label for="cp">Con : <?php echo "$td: $doc" ?></label></center>
                        </div>
                        <div>
                          <center><label for="des"> Su telefono es <?php echo "$telc" ?></label>
                            <center>
                        </div>
                        <div>
                          <center><label for="des"> Su correo es: <?php echo "$emailc" ?></label></center>
                        </div>
                        <div>
                          <center><label for="cp">Tu factura correspondiente al : <?php echo "$fing" ?></label></center>
                        </div>
                        <div>
                          <center><label for="cp">Tu fecha limite de pago es : <?php echo "$ffact" ?></label></center>
                        </div>
                        <div>
                          <center><label for="cp">Tu fecha de suspensión de servicio : <?php echo "$flim" ?></label></center>
                        </div>
                        <div>
                          <center><label for="cp">Con el plan : <?php echo "$nplan" ?></label></center>
                        </div>
                        <div>
                          <center><label for="cp">Velocidad: <?php echo "$vp" ?></label></center>
                        </div>
                        <div>
                          <center><label for="cp">Tu factura se encuentra actualmente: <?php echo "$estf" ?> </label></center>
                        </div>
                        <br>
                        <div>
                          <center><label for="cp">Sub total: <?php echo "$sub" ?></label></center>
                        </div>
                        <div>
                          <center><label for="vel">IVA 19%: <?php echo "$impt" ?></label></center>
                        </div>
                        <div>
                          <center><label>_______________________</label></center>
                        </div>
                        <div>
                          <center><label for="plan">Valor total a pagar: <?php echo " $st" ?></label></center>
                        </div>
                      </div>
                      <center><a href="facturas.php" class="btn btn-light btn-lg active" role="button" aria-pressed="true">Volver a facturas</a>
                        <a href="facturaPDF.php?id=<?php echo $if; ?>" class="btn btn-light btn-lg active" role="button" aria-pressed="true">Imprimir PDF </a>
                      </center>
                    </form>
                  </div>
                </div>
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