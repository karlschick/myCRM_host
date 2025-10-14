<?php
session_start();
if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}
require_once __DIR__ . '/../../config/db.php';

$idCliente = $_GET['idCliente'] ?? '';
if (empty($idCliente)) {
    header("Location: facturas.php");
    exit;
}

// Obtener cliente
$sqlCliente = "SELECT nombreCliente, documentoCliente FROM cliente WHERE idCliente = $idCliente LIMIT 1";
$queryCliente = mysqli_query($con, $sqlCliente);
$cliente = mysqli_fetch_assoc($queryCliente);

// Obtener planes activos
$sqlPlanes = "SELECT idPlan, nombrePlan, precioPlan FROM plan WHERE estadoPlan='Activo' ORDER BY nombrePlan ASC";
$queryPlanes = mysqli_query($con, $sqlPlanes);

include '../../includes/header.php';
?>

<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">FACTURACIÓN MANUAL</h4>
          <p class="card-description">
            Crear una nueva factura manual para <b><?= htmlspecialchars($cliente['nombreCliente']) ?></b>
          </p>

          <form action="guardar_factura.php" method="POST">
            <input type="hidden" name="idCliente" value="<?= $idCliente ?>">

            <p class="card-description">Fecha de factura:</p>
            <input type="date" name="fecha" class="form-control mb-3" required>

            <p class="card-description">Seleccione el plan:</p>
            <select name="idPlan" id="idPlan" class="form-select mb-3" required onchange="actualizarPrecio()">
              <option value="" data-precio="0">-- Seleccione un plan --</option>
              <?php while($plan = mysqli_fetch_assoc($queryPlanes)) { ?>
                <option value="<?= $plan['idPlan'] ?>" data-precio="<?= $plan['precioPlan'] ?>">
                  <?= $plan['nombrePlan'] ?> - $<?= number_format($plan['precioPlan'],0,',','.') ?>
                </option>
              <?php } ?>
            </select>

            <p class="card-description">Subtotal:</p>
            <input type="number" step="0.01" id="subTotal" name="subTotal"
                   class="form-control mb-3 text-dark" readonly>

            <p class="card-description">IVA (19%):</p>
            <input type="number" step="0.01" id="impuestoTotal" name="impuestoTotal"
                   class="form-control mb-3 text-dark" readonly>

            <p class="card-description">Total:</p>
            <input type="number" step="0.01" id="valorTotalFactura" name="valorTotalFactura"
                   class="form-control mb-3 text-dark fw-bold" readonly>

            <p class="card-description">Estado de factura:</p>
            <select name="estadoFactura" class="form-select mb-3" required>
              <option value="Pendiente">Pendiente</option>
              <option value="Pagada">Pagada</option>
              <option value="Gratis">Gratis</option>
              <option value="Vencida">Vencida</option>
              <option value="Anulada">Anulada</option>
            </select>

            <br>
            <button type="submit" class="btn btn-primary btn-lg">Guardar Factura</button>
            <a href="facturas_antiguas.php?idCliente=<?= $idCliente ?>" class="btn btn-secondary btn-lg">Cancelar</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>

<script>
function actualizarPrecio() {
    let select = document.getElementById('idPlan');
    let precio = parseFloat(select.options[select.selectedIndex].getAttribute('data-precio')) || 0;

    let iva = precio * 0.19;
    let total = precio + iva;

    document.getElementById('subTotal').value = precio.toFixed(2);
    document.getElementById('impuestoTotal').value = iva.toFixed(2);
    document.getElementById('valorTotalFactura').value = total.toFixed(2);
}
</script>

</body>
</html>
