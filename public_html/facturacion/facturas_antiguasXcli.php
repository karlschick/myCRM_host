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

// --- ARCHIVAR/DESARCHIVAR FACTURA ---
if (isset($_GET['archivar'], $_GET['id'])) {
    $idFactura = intval($_GET['id']);
    $archivar = intval($_GET['archivar']); // 1 = archivar, 0 = desarchivar
    
    $sql = "UPDATE factura SET archivada = $archivar WHERE idFactura = $idFactura";
    if ($con->query($sql)) {
        $mensaje = $archivar ? "archivada" : "desarchivada";
        echo "<script>
            alert('✅ Factura $mensaje correctamente');
            window.location.href = 'facturas_antiguasXcli.php?idCliente=$idCliente';
        </script>";
    }
    exit;
}

// Obtener info del cliente
$cliente = $con->query("SELECT nombreCliente, apellidoCliente, documentoCliente 
                        FROM cliente WHERE idCliente = '$idCliente'")->fetch_assoc();
$nombreCompleto = trim(($cliente['nombreCliente'] ?? '') . ' ' . ($cliente['apellidoCliente'] ?? ''));
?>

<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h1 style="font-size: 32px;">📄 Historial de Facturas</h1>
      <h4><?= htmlspecialchars($nombreCompleto) ?></h4>
      <h6 class="text-muted">Documento: <?= htmlspecialchars($cliente['documentoCliente']) ?></h6>
    </div>

    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <a href="javascript:history.back()" class="btn btn-secondary">
            <i class="mdi mdi-arrow-left"></i> Volver
          </a>
          <a href="nueva_factura.php?idCliente=<?= $idCliente ?>" class="btn btn-success">
            <i class="mdi mdi-plus"></i> Crear Factura Manual
          </a>
        </div>

        <!-- FILTROS -->
        <form method="GET" class="row g-3 mb-4">
          <input type="hidden" name="idCliente" value="<?= $idCliente ?>">
          
          <div class="col-md-2">
            <label for="anio" class="form-label">Año</label>
            <select name="anio" id="anio" class="form-select">
              <option value="">-- Todos --</option>
              <?php
              $years = $con->query("SELECT DISTINCT anio_fiscal AS anio 
                                    FROM factura 
                                    WHERE cliente_idCliente = $idCliente 
                                    ORDER BY anio DESC");
              while ($y = $years->fetch_assoc()) {
                  $sel = ($_GET['anio'] ?? '') == $y['anio'] ? 'selected' : '';
                  echo "<option value='{$y['anio']}' $sel>{$y['anio']}</option>";
              }
              ?>
            </select>
          </div>

          <div class="col-md-2">
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

          <div class="col-md-2">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" id="estado" class="form-select">
              <option value="">-- Todos --</option>
              <?php
              $estados = ['Pagada','Pendiente','Gratis','Vencida','Anulada'];
              foreach ($estados as $est) {
                  $sel = ($_GET['estado'] ?? '') == $est ? 'selected' : '';
                  echo "<option value='$est' $sel>$est</option>";
              }
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label for="archivadas" class="form-label">Mostrar</label>
            <select name="archivadas" id="archivadas" class="form-select">
              <option value="0" <?= ($_GET['archivadas'] ?? '0') == '0' ? 'selected' : '' ?>>Solo Activas</option>
              <option value="1" <?= ($_GET['archivadas'] ?? '0') == '1' ? 'selected' : '' ?>>Solo Archivadas</option>
              <option value="all" <?= ($_GET['archivadas'] ?? '0') == 'all' ? 'selected' : '' ?>>Todas</option>
            </select>
          </div>

          <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-primary w-100">
              <i class="mdi mdi-filter"></i> Filtrar
            </button>
          </div>

          <div class="col-md-2 align-self-end">
            <a href="facturas_antiguasXcli.php?idCliente=<?= $idCliente ?>" class="btn btn-outline-secondary w-100">
              <i class="mdi mdi-refresh"></i> Limpiar
            </a>
          </div>
        </form>

        <?php
        // CONSTRUIR FILTROS
        $anio = $_GET['anio'] ?? '';
        $mes = $_GET['mes'] ?? '';
        $estado = $_GET['estado'] ?? '';
        $archivadas = $_GET['archivadas'] ?? '0';
        $filtro = "";

        if ($anio != '') $filtro .= " AND f.anio_fiscal = $anio ";
        if ($mes != '') $filtro .= " AND f.mes_fiscal = $mes ";
        if ($estado != '') $filtro .= " AND f.estadoFactura = '" . $con->real_escape_string($estado) . "' ";
        
        if ($archivadas === '0') {
            $filtro .= " AND f.archivada = 0 ";
        } elseif ($archivadas === '1') {
            $filtro .= " AND f.archivada = 1 ";
        }
        // Si es 'all', no agregamos filtro de archivada

        // PAGINACIÓN
        $registrosPorPagina = 20;
        $pagina = isset($_GET['pagina']) ? max(1, (int)$_GET['pagina']) : 1;
        $offset = ($pagina - 1) * $registrosPorPagina;

        // CONTAR TOTAL DE REGISTROS
        $sqlTotal = "SELECT COUNT(*) as total 
                     FROM factura f
                     WHERE f.cliente_idCliente = $idCliente $filtro";
        $resultTotal = $con->query($sqlTotal);
        $totalRegistros = $resultTotal->fetch_assoc()['total'];
        $totalPaginas = ceil($totalRegistros / $registrosPorPagina);

        // CONSULTA PRINCIPAL
        $sql = "
        SELECT 
            f.idFactura,
            f.fechaFactura,
            f.anio_fiscal,
            f.mes_fiscal,
            f.subTotal,
            f.impuestoTotal,
            f.valorTotalFactura,
            f.estadoFactura,
            f.estadoManual,
            f.archivada,
            f.fechaVencimiento,
            p.nombrePlan,
            DATEDIFF(CURDATE(), f.fechaVencimiento) AS diasVencida
        FROM factura f
        LEFT JOIN plan p ON f.idPlan = p.idPlan
        WHERE f.cliente_idCliente = $idCliente $filtro
        ORDER BY f.fechaFactura DESC
        LIMIT $registrosPorPagina OFFSET $offset;
        ";

        $rta = $con->query($sql);
        ?>

        <!-- ESTADÍSTICAS -->
        <div class="row mb-3">
          <?php
          $sqlStats = "SELECT 
                        COUNT(*) as total,
                        SUM(CASE WHEN estadoFactura = 'Pagada' THEN 1 ELSE 0 END) as pagadas,
                        SUM(CASE WHEN estadoFactura = 'Pendiente' THEN 1 ELSE 0 END) as pendientes,
                        SUM(CASE WHEN estadoFactura = 'Vencida' THEN 1 ELSE 0 END) as vencidas,
                        SUM(CASE WHEN archivada = 1 THEN 1 ELSE 0 END) as archivadas,
                        SUM(valorTotalFactura) as total_facturado
                       FROM factura 
                       WHERE cliente_idCliente = $idCliente";
          $stats = $con->query($sqlStats)->fetch_assoc();
          ?>
          <div class="col-md-2">
            <div class="card bg-primary text-white">
              <div class="card-body p-2 text-center">
                <h6>Total Facturas</h6>
                <h3><?= $stats['total'] ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card bg-success text-white">
              <div class="card-body p-2 text-center">
                <h6>Pagadas</h6>
                <h3><?= $stats['pagadas'] ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card bg-warning text-white">
              <div class="card-body p-2 text-center">
                <h6>Pendientes</h6>
                <h3><?= $stats['pendientes'] ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card bg-danger text-white">
              <div class="card-body p-2 text-center">
                <h6>Vencidas</h6>
                <h3><?= $stats['vencidas'] ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card bg-secondary text-white">
              <div class="card-body p-2 text-center">
                <h6>Archivadas</h6>
                <h3><?= $stats['archivadas'] ?></h3>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card bg-info text-white">
              <div class="card-body p-2 text-center">
                <h6>Total $</h6>
                <h5>$<?= number_format($stats['total_facturado'], 0, ',', '.') ?></h5>
              </div>
            </div>
          </div>
        </div>

        <div class="table-responsive mt-3">
          <p class="text-muted">Mostrando <?= min($offset + 1, $totalRegistros) ?> - <?= min($offset + $registrosPorPagina, $totalRegistros) ?> de <?= $totalRegistros ?> facturas</p>
          
          <table class="table table-hover table-bordered">
            <thead class="table-light">
              <tr>
                <th>ID</th>
                <th>Año</th>
                <th>Mes</th>
                <th>Fecha</th>
                <th>Plan</th>
                <th>Subtotal</th>
                <th>IVA</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Días</th>
                <th>Ver</th>
                <th>Estado</th>
                <th>Archivar</th>
              </tr>
            </thead>
            <tbody>
              <?php
              if ($rta && $rta->num_rows > 0) {
                  $mesesNombre = [
                    1=>'Enero',2=>'Febrero',3=>'Marzo',4=>'Abril',
                    5=>'Mayo',6=>'Junio',7=>'Julio',8=>'Agosto',
                    9=>'Septiembre',10=>'Octubre',11=>'Noviembre',12=>'Diciembre'
                  ];

                  while ($row = $rta->fetch_assoc()) {
                      $anioF = $row['anio_fiscal'];
                      $mesF = $mesesNombre[$row['mes_fiscal']];
                      $sub = number_format($row['subTotal'], 0, ',', '.');
                      $iva = number_format($row['impuestoTotal'], 0, ',', '.');
                      $tot = number_format($row['valorTotalFactura'], 0, ',', '.');
                      $estado = $row['estadoFactura'];
                      $archivada = $row['archivada'];
                      $diasVencida = $row['diasVencida'];
                      
                      // Badge por estado
                      $color = 'secondary';
                      if ($estado == 'Pagada') $color = 'success';
                      elseif ($estado == 'Pendiente') $color = 'warning';
                      elseif ($estado == 'Vencida') $color = 'danger';
                      elseif ($estado == 'Gratis') $color = 'info';
                      elseif ($estado == 'Anulada') $color = 'dark';

                      // Días vencida
                      $diasTexto = '';
                      $diasColor = 'text-muted';
                      if ($estado == 'Vencida' && $diasVencida > 0) {
                          $diasTexto = "$diasVencida días";
                          $diasColor = 'text-danger fw-bold';
                      } elseif ($estado == 'Pendiente') {
                          $diasFaltantes = -$diasVencida;
                          if ($diasFaltantes > 0) {
                              $diasTexto = "$diasFaltantes días";
                              $diasColor = 'text-success';
                          }
                      }

                      // Indicador manual
                      $manualIcon = $row['estadoManual'] ? '<i class="mdi mdi-hand-pointing-right text-warning" title="Modificado manualmente"></i> ' : '';

                      // Indicador archivada
                      $archivoIcon = $archivada ? '<i class="mdi mdi-archive text-secondary" title="Archivada"></i> ' : '';

                      echo "<tr class='" . ($archivada ? 'table-secondary' : '') . "'>
                              <td><strong>#{$row['idFactura']}</strong> $archivoIcon</td>
                              <td>$anioF</td>
                              <td>$mesF</td>
                              <td>{$row['fechaFactura']}</td>
                              <td>{$row['nombrePlan']}</td>
                              <td>\$$sub</td>
                              <td>\$$iva</td>
                              <td><b>\$$tot</b></td>
                              <td>$manualIcon<span class='badge bg-$color'>$estado</span></td>
                              <td class='$diasColor'>$diasTexto</td>
                              <td>
                                <a href='verfacturaAdmin.php?id={$row['idFactura']}' class='btn btn-info btn-sm' title='Ver detalle'>
                                  <i class='mdi mdi-eye'></i>
                                </a>
                              </td>
                              <td>
                                <select class='form-select form-select-sm' onchange=\"cambiarEstado({$row['idFactura']}, this.value)\">
                                  <option value=''>-- Cambiar --</option>
                                  <option value='Pagada'>Pagada</option>
                                  <option value='Pendiente'>Pendiente</option>
                                  <option value='Gratis'>Gratis</option>
                                  <option value='Vencida'>Vencida</option>
                                  <option value='Anulada'>Anulada</option>
                                </select>
                              </td>
                              <td>
                                <button class='btn btn-sm " . ($archivada ? "btn-outline-primary" : "btn-outline-secondary") . "' 
                                        onclick=\"archivarFactura({$row['idFactura']}, " . ($archivada ? '0' : '1') . ")\"
                                        title='" . ($archivada ? "Desarchivar" : "Archivar") . "'>
                                  <i class='mdi mdi-" . ($archivada ? "package-up" : "archive") . "'></i>
                                </button>
                              </td>
                            </tr>";
                  }
              } else {
                  echo "<tr><td colspan='13' class='text-center'>No hay facturas registradas con los filtros seleccionados.</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>

        <!-- PAGINACIÓN -->
        <?php if ($totalPaginas > 1): ?>
        <nav aria-label="Paginación de facturas">
          <ul class="pagination justify-content-center">
            <!-- Primera página -->
            <li class="page-item <?= $pagina == 1 ? 'disabled' : '' ?>">
              <a class="page-link" href="?idCliente=<?= $idCliente ?>&pagina=1&anio=<?= $anio ?>&mes=<?= $mes ?>&estado=<?= $estado ?>&archivadas=<?= $archivadas ?>">
                <i class="mdi mdi-page-first"></i>
              </a>
            </li>
            
            <!-- Anterior -->
            <li class="page-item <?= $pagina == 1 ? 'disabled' : '' ?>">
              <a class="page-link" href="?idCliente=<?= $idCliente ?>&pagina=<?= $pagina - 1 ?>&anio=<?= $anio ?>&mes=<?= $mes ?>&estado=<?= $estado ?>&archivadas=<?= $archivadas ?>">
                <i class="mdi mdi-chevron-left"></i>
              </a>
            </li>

            <!-- Páginas -->
            <?php
            $rango = 2;
            for ($i = max(1, $pagina - $rango); $i <= min($totalPaginas, $pagina + $rango); $i++):
            ?>
              <li class="page-item <?= $i == $pagina ? 'active' : '' ?>">
                <a class="page-link" href="?idCliente=<?= $idCliente ?>&pagina=<?= $i ?>&anio=<?= $anio ?>&mes=<?= $mes ?>&estado=<?= $estado ?>&archivadas=<?= $archivadas ?>">
                  <?= $i ?>
                </a>
              </li>
            <?php endfor; ?>

            <!-- Siguiente -->
            <li class="page-item <?= $pagina == $totalPaginas ? 'disabled' : '' ?>">
              <a class="page-link" href="?idCliente=<?= $idCliente ?>&pagina=<?= $pagina + 1 ?>&anio=<?= $anio ?>&mes=<?= $mes ?>&estado=<?= $estado ?>&archivadas=<?= $archivadas ?>">
                <i class="mdi mdi-chevron-right"></i>
              </a>
            </li>

            <!-- Última página -->
            <li class="page-item <?= $pagina == $totalPaginas ? 'disabled' : '' ?>">
              <a class="page-link" href="?idCliente=<?= $idCliente ?>&pagina=<?= $totalPaginas ?>&anio=<?= $anio ?>&mes=<?= $mes ?>&estado=<?= $estado ?>&archivadas=<?= $archivadas ?>">
                <i class="mdi mdi-page-last"></i>
              </a>
            </li>
          </ul>
        </nav>
        <?php endif; ?>

      </div>
    </div>
  </div>
</div>

<!-- SweetAlert -->
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
    confirmButtonText: 'Sí, cambiar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = 'facturas_antiguasXcli.php?cambiar_estado=1&id=' + id + '&nuevo=' + nuevo + '&idCliente=<?= $idCliente ?>';
    }
  });
}

function archivarFactura(id, archivar) {
  const accion = archivar ? 'archivar' : 'desarchivar';
  const texto = archivar ? 'Esta factura pasará al historial archivado' : 'Esta factura volverá a las facturas activas';
  
  Swal.fire({
    title: '¿Está seguro?',
    text: texto,
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Sí, ' + accion,
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      window.location = 'facturas_antiguasXcli.php?archivar=' + archivar + '&id=' + id + '&idCliente=<?= $idCliente ?>';
    }
  });
}
</script>

</body>
</html>