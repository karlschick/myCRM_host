<?php
session_start();
error_reporting(0);

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';

$idCliente = $_GET['idCliente'] ?? '';
if (empty($idCliente)) {
    header("Location: facturas.php");
    exit;
}

// --- CAMBIO DE ESTADO DE FACTURA ---
if (isset($_GET['cambiar_estado'], $_GET['id'], $_GET['nuevo'])) {
    $idFactura   = intval($_GET['id']);
    $nuevoEstado = $con->real_escape_string($_GET['nuevo']);

    // Estados permitidos
    $permitidos = ['Pagada','Pendiente','Gratis','Vencida','Anulada'];
    if (in_array($nuevoEstado, $permitidos)) {
        $sql = "UPDATE factura 
                SET estadoFactura = '$nuevoEstado', estadoManual = 1 
                WHERE idFactura = $idFactura";
        if ($con->query($sql)) {
            echo "<script>
                alert('✅ Estado cambiado manualmente a $nuevoEstado');
                window.location.href = 'facturas_antiguasXcli.php?idCliente=$idCliente';
            </script>";
        } else {
            echo "Error al actualizar: " . $con->error;
        }
        exit;
    }
}


// Obtener info del cliente
$cliente = $con->query("SELECT nombreCliente, documentoCliente FROM cliente WHERE idCliente = '$idCliente'")->fetch_assoc();
?>

<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h1 style="font-size: 32px;">Historial de facturas - <?= htmlspecialchars($cliente['nombreCliente']) ?></h1>
      <h5>Documento: <?= htmlspecialchars($cliente['documentoCliente']) ?></h5>
    </div>

    <div class="card">
      <div class="card-body">
        <a href="facturas.php" class="btn btn-secondary mb-3">Volver</a>

        <!-- Filtro por año y mes -->
        <form method="GET" class="row g-3 mb-4">
          <input type="hidden" name="idCliente" value="<?= $idCliente ?>">
          <div class="col-md-3">
            <label for="anio" class="form-label">Año</label>
            <select name="anio" id="anio" class="form-select">
              <option value="">-- Todos --</option>
              <?php
              $years = $con->query("SELECT DISTINCT YEAR(fechaFactura) AS anio FROM factura WHERE cliente_idCliente = $idCliente ORDER BY anio DESC");
              while ($y = $years->fetch_assoc()) {
                  $sel = ($_GET['anio'] ?? '') == $y['anio'] ? 'selected' : '';
                  echo "<option value='{$y['anio']}' $sel>{$y['anio']}</option>";
              }
              ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="mes" class="form-label">Mes</label>
            <select name="mes" id="mes" class="form-select">
              <option value="">-- Todos --</option>
              <?php
              $meses = [
                1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',
                5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',
                9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'
              ];
              foreach ($meses as $num => $nombre) {
                  $sel = ($_GET['mes'] ?? '') == $num ? 'selected' : '';
                  echo "<option value='$num' $sel>$nombre</option>";
              }
              ?>
            </select>
          </div>

          <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
          </div>

          <div class="col-md-3 align-self-end">
            <a href="nueva_factura.php?idCliente=<?= $idCliente ?>" class="btn btn-success w-100">
              <i class="mdi mdi-plus"></i> Crear Factura Manual
            </a>
          </div>

        </form>

        <?php
        $anio = $_GET['anio'] ?? '';
        $mes = $_GET['mes'] ?? '';
        $filtro = "";

        if ($anio != '') $filtro .= " AND YEAR(f.fechaFactura) = $anio ";
        if ($mes != '') $filtro .= " AND MONTH(f.fechaFactura) = $mes ";

        $sql = "
        SELECT 
            f.idFactura,
            f.fechaFactura,
            f.subTotal,
            f.impuestoTotal,
            f.valorTotalFactura,
            f.estadoFactura,
            p.nombrePlan
        FROM factura f
        LEFT JOIN plan p ON f.idPlan = p.idPlan
        WHERE f.cliente_idCliente = $idCliente $filtro
        ORDER BY f.fechaFactura DESC;
        ";

        $rta = $con->query($sql);
        ?>

        <div class="table-responsive mt-3">
          <table class="table table-hover table-bordered">
            <thead class="table-light">
              <tr>
                <th>Año</th>
                <th>Mes</th>
                <th>Fecha</th>
                <th>Plan</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Ver</th>
                <th>Cambiar Estado</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($rta && $rta->num_rows > 0) {
                  $meses = [
                    1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',
                    5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',
                    9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'
                  ];

                  while ($row = $rta->fetch_assoc()) {
                      $anioF = date('Y', strtotime($row['fechaFactura']));
                      $mesNumero = date('n', strtotime($row['fechaFactura']));
                      $mesF = $meses[$mesNumero];
                      $sub = number_format($row['subTotal'], 0, ',', '.');
                      $iva = number_format($row['impuestoTotal'], 0, ',', '.');
                      $tot = number_format($row['valorTotalFactura'], 0, ',', '.');
                      $estado = $row['estadoFactura'];
                      
                      // Badge por estado
                      $color = 'secondary';
                      if ($estado == 'Pagada') $color = 'success';
                      elseif ($estado == 'Pendiente') $color = 'warning';
                      elseif ($estado == 'Vencida') $color = 'danger';
                      elseif ($estado == 'Gratis') $color = 'info';
                      elseif ($estado == 'Anulada') $color = 'dark';

                      echo "<tr>
                              <td>$anioF</td>
                              <td>$mesF</td>
                              <td>{$row['fechaFactura']}</td>
                              <td>{$row['nombrePlan']}</td>
                              <td>$sub</td>
                              <td>$iva</td>
                              <td><b>$tot</b></td>
                              <td><span class='badge bg-$color'>$estado</span></td>
                              <td>
                                <a href='verfacturaAdmin.php?id={$row['idFactura']}' class='btn btn-info btn-sm'>
                                  <i class='mdi mdi-eye'></i> Ver
                                </a>
                              </td>
                              <td>
                                <select class='form-select form-select-sm' onchange=\"cambiarEstado({$row['idFactura']}, this.value)\">
                                  <option value=''>-- Seleccione --</option>
                                  <option value='Pagada'>Pagada</option>
                                  <option value='Pendiente'>Pendiente</option>
                                  <option value='Gratis'>Gratis</option>
                                  <option value='Vencida'>Vencida</option>
                                  <option value='Anulada'>Anulada</option>
                                </select>
                              </td>
                            </tr>";
                  }
              } else {
                  echo "<tr><td colspan='10' class='text-center'>No hay facturas registradas para este cliente.</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- SweetAlert para confirmar cambio -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function cambiarEstado(id, nuevo) {
  if (nuevo === '') return;
  Swal.fire({
    title: '¿Está seguro?',
    text: "¿Desea cambiar el estado de esta factura a " + nuevo + "?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, cambiar'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = 'facturas_antiguasXcli.php?cambiar_estado=1&id=' + id + '&nuevo=' + nuevo + '&idCliente=<?= $idCliente ?>';
    }
  });
}
</script>

</body>
</html>
