<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';

$if = $_GET['if'] ?? 0;

$sql = "SELECT 
            c.idCliente,
            c.documentoCliente,
            c.nombreCliente,
            f.idFactura,
            f.fechaFactura,
            f.impuestoTotal,
            f.subTotal,
            f.valorTotalFactura,
            f.estadoFactura,
            f.cliente_idCliente,
            f.idPlan,
            f.fechaVencimiento,
            f.fechaSuspencion,
            p.nombrePlan
        FROM cliente c
        INNER JOIN factura f ON c.idCliente = f.cliente_idCliente
        LEFT JOIN plan p ON f.idPlan = p.idPlan
        WHERE f.idFactura = '$if'";

$rta = $con->query($sql);
$row = $rta->fetch_assoc();

$id     = $row['idCliente'];
$doc    = $row['documentoCliente'];
$nomc   = $row['nombreCliente'];
$if     = $row['idFactura'];
$ffact  = $row['fechaFactura'];
$impt   = $row['impuestoTotal'];
$sub    = $row['subTotal'];
$st     = $row['valorTotalFactura'];
$cid    = $row['cliente_idCliente'];
$estf   = $row['estadoFactura'];
$idPlan = $row['idPlan'];
$fven   = $row['fechaVencimiento'];
$fsusp  = $row['fechaSuspencion'];
?>

<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="card p-4 shadow">
      
      <h2 class="mb-3">Gestión de Factura</h2>
      <h5 class="text-muted">Editar datos de la factura</h5>
      <hr>

      <p><strong>Cliente:</strong> <?php echo htmlspecialchars($nomc); ?></p>
      <p><strong>Documento:</strong> <?php echo htmlspecialchars($doc); ?></p>

      <form action="actfactura.php" method="POST" id="formFactura">

        <input type="hidden" name="if" value="<?php echo $if; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <input type="hidden" name="cid" value="<?php echo $cid; ?>">

        <!-- Fecha Factura -->
        <div class="mb-3">
          <label class="form-label">Fecha de Facturación</label>
          <input type="date" class="form-control bg-white text-dark" name="ffact" id="fechaFactura" value="<?php echo $ffact; ?>">
        </div>

        <!-- Fecha Vencimiento -->
        <div class="mb-3">
          <label class="form-label">Fecha de Vencimiento</label>
          <input type="date" class="form-control bg-white text-dark" name="fechaVencimiento" id="fechaVencimiento" value="<?php echo $fven; ?>">
        </div>

        <!-- Fecha Suspensión -->
        <div class="mb-3">
          <label class="form-label">Fecha de Suspensión</label>
          <input type="date" class="form-control bg-white text-dark" name="fechaSuspencion" id="fechaSuspencion" value="<?php echo $fsusp; ?>">
        </div>

        <!-- Botón recalcular -->
        <div class="mb-3">
          <button type="button" class="btn btn-warning" onclick="recalcularFechas()">Recalcular Fechas</button>
          <small class="text-muted d-block">Ajusta vencimiento a +30 días y suspensión a +45 días desde la fecha de factura.</small>
        </div>

        <!-- Plan -->
        <div class="mb-3">
          <label class="form-label">Plan</label>
          <select class="form-select bg-white text-dark" name="idPlan" id="idPlan">
            <option value="">-- Seleccione un plan --</option>
            <?php
            $planes = $con->query("SELECT idPlan, nombrePlan FROM plan ORDER BY nombrePlan ASC");
            while ($p = $planes->fetch_assoc()) {
                $sel = ($p['idPlan'] == $idPlan) ? 'selected' : '';
                echo "<option value='{$p['idPlan']}' $sel>{$p['nombrePlan']}</option>";
            }
            ?>
          </select>
        </div>

        <!-- Subtotal -->
        <div class="mb-3">
          <label class="form-label">SubTotal</label>
          <input type="text" class="form-control bg-white text-dark" name="sub" id="sub" value="<?php echo $sub; ?>">
        </div>

        <!-- Impuesto -->
        <div class="mb-3">
          <label class="form-label">Impuesto</label>
          <input type="text" class="form-control bg-white text-dark" name="impt" id="impt" value="<?php echo $impt; ?>">
        </div>

        <!-- Total -->
        <div class="mb-3">
          <label class="form-label">Valor Total</label>
          <input type="text" class="form-control bg-white text-dark" name="st" id="st" value="<?php echo $st; ?>">
        </div>

        <!-- Estado -->
        <div class="mb-3">
          <label class="form-label">Estado de Factura</label>
          <select class="form-select bg-white text-dark" name="estf" id="estf">
            <option value="Pendiente" <?php if ($estf=="Pendiente") echo "selected"; ?>>Pendiente</option>
            <option value="Pagada" <?php if ($estf=="Pagada") echo "selected"; ?>>Pagada</option>
            <option value="Gratis" <?php if ($estf=="Gratis") echo "selected"; ?>>Gratis</option>
            <option value="Anulada" <?php if ($estf=="Anulada") echo "selected"; ?>>Anulada</option>
          </select>
        </div>

        <!-- Botones -->
        <div class="d-flex gap-2">
          <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
          <a href="facturas.php" class="btn btn-secondary btn-lg">Volver</a>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
// AJAX: actualizar totales al cambiar de plan
document.getElementById('idPlan').addEventListener('change', function() {
    let idPlan = this.value;
    if(idPlan){
        fetch('getPlan.php?idPlan=' + idPlan)
          .then(res => res.json())
          .then(data => {
              if(!data.error){
                  document.getElementById('sub').value = data.subTotal;
                  document.getElementById('impt').value = data.impuesto;
                  document.getElementById('st').value  = data.total;
              }
          });
    }
});

// Recalcular fechas
function recalcularFechas() {
    let fechaFactura = document.getElementById("fechaFactura").value;
    if(!fechaFactura){
        alert("Debes ingresar primero la fecha de facturación.");
        return;
    }

    let f = new Date(fechaFactura);
    if(isNaN(f.getTime())){
        alert("Fecha de factura inválida.");
        return;
    }

    // +30 días
    let venc = new Date(f);
    venc.setDate(venc.getDate() + 30);

    // +45 días
    let susp = new Date(f);
    susp.setDate(susp.getDate() + 45);

    document.getElementById("fechaVencimiento").value = venc.toISOString().split('T')[0];
    document.getElementById("fechaSuspencion").value = susp.toISOString().split('T')[0];
}
</script>

</body>
</html>
