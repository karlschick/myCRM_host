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
  $if = $_GET['if'];
  $sql = "SELECT * FROM cliente  
  INNER JOIN factura
  ON cliente.idCliente=factura.cliente_idCliente
  WHERE idFactura= '$if';";
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
      $creado = $row['creado'];
      $uact = $row['ultimaActualizacion'];
      $if = $row['idFactura'];
      $ffact = $row['fechaFactura'];
      $impt = $row['impuestoTotal'];
      $sub = $row['subTotal'];
      $st = $row['valorTotalFactura'];
      $cid = $row['cliente_idCliente'];
      $estf = $row['estadoFactura'];
    }
    
  }
  ?>

  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <div class="card-body">

        <h1 style="font-size: 32px;">GESTIÓN FACTURA</h1>
        <h4 class="card-title">Actualizacion FACTURA </h4>
        <p class="card-description"> Cliente: <?php echo "$doc"  ?></p>
        <p class="card-description"> Documento:<?php echo "$nomc"  ?> </p>
        <p class="card-description"> Ingrese Nueva información</p>
        <form action="actfactura.php" method="POST">
          <input type="hidden" class="form-control mb-3" name="if" value="<?php echo "$if"  ?>">
          <input type="hidden" class="form-control mb-3" name="id" value="<?php echo "$id"  ?>">

          <input type="hidden" class="form-control mb-3" name="cid" value="<?php echo "$cid"  ?>">
          <p class="card-description"> Fecha de facturacion: </p>
          <input type="date" class="form-control mb-3" name="ffact" placeholder="Velocidad Plan" value="<?php echo "$ffact"  ?>">
          <p class="card-description" name = "impt" id ="impt"> Impuesto: <?php echo  "$impt"?>  </p>
          <input type="hidden" class="form-control mb-3" name="impt" value="<?php echo "$impt"  ?>">
          <p class="card-description"> SubTotal: <?php echo "$sub"  ?> </p>
          <input type="hidden" class="form-control mb-3" name="sub" value="<?php echo "$sub"  ?>">
          <p class="card-description"> Valor total factura: </p>
          <input type="text" class="form-control mb-3" name="st" placeholder="Descripcion del plan" value="<?php echo "$st" ?>">
          <p class="card-description"> Estado de factura: </p>
          <select class="form-select" aria-label="Default select example" name="estf" id="estf" value="<?php echo  "$estf" ?>">
            <option value="Pendiente">Pendiente </option>
            <option value="Pago">Pago</option>
          </select>
          <p></p>
          <input type="submit" class="btn btn-primary btn-lg" value="Actualizar" formmethod="post" formaction=actfactura.php>
          <input type="submit" class="btn btn-primary btn-lg" value="Volver" formmethod="post" formaction=facturas.php>
        </form>

      </div>
    </div>
  </div>
  </div>
</body>

</html>