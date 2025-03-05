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

  <?php
  require_once __DIR__ . '/../../config/db.php';
  $doc = $_POST['id'];
  $sql = "SELECT * FROM cliente  
  INNER JOIN plan
  ON cliente.plan_idPlan=plan.idPlan
  WHERE documentoCliente= '$doc'";
  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);
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
      $cid = $id;
      $st = $precioplan;
      $impt = $st * 0.19;
      $sub = $st * 0.81;
    }
  }
  ?>
  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <div class="card-body">
        <h4 class="card-title">INGRESAR NUEVA FACTURA</h4>
        <p class="card-description"> Cliente: <?php echo "$doc"  ?></p>
        <p class="card-description"> Documento:<?php echo "$nomc"  ?> </p>
        <p class="card-description"> Telefono:<?php echo "$telc"  ?> </p>
        <p class="card-description"> Correo Electronico:<?php echo "$emailc"  ?> </p>
        <p class="card-description"> Dirección Cliente:<?php echo "$dc"  ?> </p>
        <p class="card-description"> Tipo plan del cliente:<?php echo "$tipoplan"  ?> </p>
        <p class="card-description"> Plan del cliente:<?php echo "$nombreplan"  ?> </p>
        <p class="card-description"> velocidad del plan:<?php echo "$vp"  ?> </p>
        <p class="card-description"> Subtotal a pagar: <?php echo "$sub"  ?> </p>
        <p class="card-description"> Impuestos: <?php echo "$impt"  ?> </p>
        <p class="card-description"> Total: <?php echo "$st"  ?> </p>
        <p class="card-description"> Ingrese fechas:</p>
        <form action="actfactura.php" method="POST">
          <input type="hidden" name="if" value="<?php echo "$if"  ?>">
          <input type="hidden" name="id" value="<?php echo "$id"  ?>">
          <input type="hidden" name="cid" value="<?php echo "$cid"  ?>">
          <input type="hidden" name="nplan" value="<?php echo "$nombreplan"  ?>">
          <label for="f">Fecha de ingreso factura</label>
          <input type="date" class="form-control mb-3" name="fing" placeholder="Fecha de Ingreso">
          <input type="hidden" name="impt" value="<?php echo "$impt"  ?>">
          <input type="hidden" name="sub" value="<?php echo "$sub"  ?>">
          <input type="hidden" name="st" value="<?php echo "$st"  ?>">

          <input type="submit" class="btn btn-primary btn-lg" value="crear" formmethod="post" formaction=ingresarfactura.php>
          <input type="submit" class="btn btn-primary btn-lg" value="cancelar" formmethod="post" formaction=facturas.php>
        </form>
        <div class="row">
          <div>
            <div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
  </div>
</body>

</html>