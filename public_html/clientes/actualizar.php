<?php
// Seguridad de sesiones
session_start();
error_reporting(0);

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';

// Obtener cliente con su plan y última factura
$id = $_GET['id'];
$sql = "SELECT 
            c.*,
            p.nombrePlan,
            f.fechaFactura,
            f.fechaVencimiento,
            f.fechaSuspencion,
            f.estadoFactura
        FROM cliente c
        LEFT JOIN plan p ON c.plan_idPlan = p.idPlan
        LEFT JOIN factura f ON f.idFactura = (
            SELECT f2.idFactura 
            FROM factura f2 
            WHERE f2.cliente_idCliente = c.idCliente
            ORDER BY f2.idFactura DESC
            LIMIT 1
        )
        WHERE c.documentoCliente = '$id'
        LIMIT 1;";
$queryCliente = mysqli_query($con, $sql);
$cliente = mysqli_fetch_assoc($queryCliente);

// Traer todos los planes activos
$sqlPlanes = "SELECT * FROM plan WHERE estadoPlan='activo';";
$queryPlanes = mysqli_query($con, $sqlPlanes);

// Calcular fecha de suspensión automática si no existe
$fechaSuspencion = $cliente['fechaSuspencion'] ?? '';
if (empty($fechaSuspencion) && !empty($cliente['fechaVencimiento'])) {
    $fechaSuspencion = date('Y-m-d', strtotime($cliente['fechaVencimiento'] . ' +5 days'));
}
?>

<body>
<?php include '../../includes/menu.php'; ?>
<?php include 'menu/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">GESTIÓN DE CLIENTES</h4>
          <p class="card-description">Actualice los datos del cliente</p>

          <form action="update.php" method="POST">

            <!-- Documento oculto para identificar cliente -->
            <input type="hidden" name="id" value="<?php echo htmlspecialchars($cliente['documentoCliente']); ?>">

            <p class="card-description">Tipo de documento:</p>
            <select class="form-select mb-3" name="td" id="td">
              <option value="C.C" <?php if($cliente['tipoDocumento']=='C.C') echo 'selected'; ?>>C.C</option>
              <option value="C.E" <?php if($cliente['tipoDocumento']=='C.E') echo 'selected'; ?>>C.E</option>
              <option value="R.C" <?php if($cliente['tipoDocumento']=='R.C') echo 'selected'; ?>>R.C</option>
              <option value="T.I" <?php if($cliente['tipoDocumento']=='T.I') echo 'selected'; ?>>T.I</option>
            </select>

            <p class="card-description">Documento cliente:</p>
            <input type="text" class="form-control mb-3" name="documentoCliente" value="<?php echo htmlspecialchars($cliente['documentoCliente']); ?>">

            <p class="card-description">Nombre cliente:</p>
            <input type="text" class="form-control mb-3" name="nombre" value="<?php echo htmlspecialchars($cliente['nombreCliente']); ?>">

            <p class="card-description">Teléfono cliente:</p>
            <input type="text" class="form-control mb-3" name="tel" value="<?php echo htmlspecialchars($cliente['telefonoCliente']); ?>">

            <p class="card-description">Correo cliente:</p>
            <input type="email" class="form-control mb-3" name="email" value="<?php echo htmlspecialchars($cliente['correoCliente']); ?>">

            <p class="card-description">Dirección cliente:</p>
            <input type="text" class="form-control mb-3" name="dir" value="<?php echo htmlspecialchars($cliente['direccion']); ?>">

            <p class="card-description">Estado cliente:</p>
            <select class="form-select mb-3" name="estado" id="estado">
              <option value="Activo" <?php if($cliente['estadoCliente']=='Activo') echo 'selected'; ?>>Activo</option>
              <option value="Inactivo" <?php if($cliente['estadoCliente']=='Inactivo') echo 'selected'; ?>>Inactivo</option>
              <option value="Suspendido" <?php if($cliente['estadoCliente']=='Suspendido') echo 'selected'; ?>>Suspendido</option>
              <option value="Archivado" <?php if($cliente['estadoCliente']=='Archivado') echo 'selected'; ?>>Archivado</option>
            </select>

            <p class="card-description">Fecha creación:</p>
            <input type="date" class="form-control mb-3" name="creacion" value="<?php echo htmlspecialchars($cliente['creado']); ?>">

            <p class="card-description">Fecha última actualización:</p>
            <input type="date" class="form-control mb-3" name="act" value="<?php echo htmlspecialchars($cliente['ultimaActualizacion']); ?>">

            <div class="form-group">
              <label for="plan" class="card-description">Seleccione el plan:</label>
              <select class="form-control mb-3" name="plan" id="plan">
                <?php while ($plan = mysqli_fetch_assoc($queryPlanes)) { ?>
                  <option value="<?php echo $plan['idPlan']; ?>" 
                    <?php if($plan['idPlan']==$cliente['plan_idPlan']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($plan['nombrePlan']); ?>
                  </option>
                <?php } ?>
              </select>
            </div>

            <!-- 🔹 Nuevo campo: Meses de gracia -->
            <p class="card-description">Meses de gracia:</p>
            <select class="form-control mb-3" name="gracia" id="gracia">
              <option value="0" <?php if(($cliente['meses_gracia'] ?? 0) == 0) echo 'selected'; ?>>0</option>
              <option value="1" <?php if(($cliente['meses_gracia'] ?? 0) == 1) echo 'selected'; ?>>1</option>
              <option value="2" <?php if(($cliente['meses_gracia'] ?? 0) == 2) echo 'selected'; ?>>2</option>
              <option value="3" <?php if(($cliente['meses_gracia'] ?? 0) == 3) echo 'selected'; ?>>3</option>
            </select>

            <p class="card-description">Fecha de emisión (factura):</p>
            <input type="date" class="form-control mb-3" name="fechaFactura" value="<?php echo htmlspecialchars($cliente['fechaFactura'] ?? ''); ?>">

            <p class="card-description">Fecha de vencimiento (pago):</p>
            <input type="date" class="form-control mb-3" name="fechaVencimiento" value="<?php echo htmlspecialchars($cliente['fechaVencimiento'] ?? ''); ?>">

            <p class="card-description">Fecha de suspensión:</p>
            <input type="date" class="form-control mb-3" name="fechaSuspencion" value="<?php echo htmlspecialchars($fechaSuspencion); ?>">

            <p class="card-description">Estado de la factura:</p>
            <select class="form-select mb-3" name="estadoFactura" id="estadoFactura">
              <option value="">Seleccione...</option>
              <option value="Pagada" <?php if(($cliente['estadoFactura'] ?? '')=='Pagada') echo 'selected'; ?>>Pagada</option>
              <option value="Pendiente" <?php if(($cliente['estadoFactura'] ?? '')=='Pendiente') echo 'selected'; ?>>Pendiente</option>
              <option value="Vencida" <?php if(($cliente['estadoFactura'] ?? '')=='Vencida') echo 'selected'; ?>>Vencida</option>
              <option value="Gratis" <?php if(($cliente['estadoFactura'] ?? '')=='Gratis') echo 'selected'; ?>>Gratis</option>
              <option value="Anulada" <?php if(($cliente['estadoFactura'] ?? '')=='Anulada') echo 'selected'; ?>>Anulada</option>
            </select>

            <br>
            <button type="submit" class="btn btn-primary btn-lg">Actualizar</button>
            <a href="tablas.php" class="btn btn-secondary btn-lg">Volver</a>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
