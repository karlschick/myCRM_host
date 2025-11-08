<?php
session_start();
error_reporting(0);

// Seguridad de sesión
if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';

// Obtener parámetro id (documentoCliente o idCliente)
$id = $_GET['id'] ?? '';
$sql = "SELECT c.*, 
               f.fechaFactura, 
               f.fechaVencimiento, 
               f.fechaSuspencion, 
               f.estadoFactura
        FROM cliente c
        LEFT JOIN factura f ON f.idFactura = (
            SELECT f2.idFactura 
            FROM factura f2 
            WHERE f2.cliente_idCliente = c.idCliente
            ORDER BY f2.idFactura DESC
            LIMIT 1
        )
        WHERE c.documentoCliente='" . mysqli_real_escape_string($con, $id) . "' 
           OR c.idCliente='" . mysqli_real_escape_string($con, $id) . "'
        LIMIT 1";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);

// Calcular fecha de suspensión automática si no existe
$fechaSuspencion = $row['fechaSuspencion'] ?? '';
if (empty($fechaSuspencion) && !empty($row['fechaVencimiento'])) {
    $fechaSuspencion = date('Y-m-d', strtotime($row['fechaVencimiento'] . ' +5 days'));
}

// Obtener planes activos
$sqlPlanes = "SELECT * FROM plan WHERE estadoPlan='Activo' ORDER BY nombrePlan";
$queryPlanes = mysqli_query($con, $sqlPlanes);

// Obtener usuarios para vendedor y técnico
$sqlUsuarios = "SELECT idUsuario, nombresUsuario, rol FROM usuario WHERE estadoUsuario='Activo' ORDER BY nombresUsuario";
$queryUsuarios = mysqli_query($con, $sqlUsuarios);
$usuarios = [];
while ($u = mysqli_fetch_assoc($queryUsuarios)) {
    $usuarios[] = $u;
}

// Obtener clientes para referidos
$sqlClientes = "SELECT idCliente, nombreCliente, documentoCliente FROM cliente WHERE estadoCliente='Activo' ORDER BY nombreCliente";
$queryClientes = mysqli_query($con, $sqlClientes);
$clientes = [];
while ($c = mysqli_fetch_assoc($queryClientes)) {
    $clientes[] = $c;
}
?>

<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="card-body" style="max-width:1100px; margin:0 auto;">
      <h1 style="font-size:32px; text-align:center;">GESTIÓN DE CLIENTES</h1>
      <p class="card-description" style="text-align:center;">Actualice los datos del Cliente</p>

      <form action="update.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['documentoCliente']); ?>">
        <input type="hidden" name="idCliente" value="<?php echo htmlspecialchars($row['idCliente']); ?>">

        <!-- IDENTIFICACIÓN PERSONAL -->
        <h3 style="text-align:center; color:#666; margin-top:16px;">Identificación del Cliente</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-3">
            <label>ID Cliente</label>
            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['idCliente']); ?>" readonly>
          </div>
          <div class="col-md-3">
            <label>Tipo Documento</label>
            <select class="form-select" name="tipoDocumento">
              <option value="C.C" <?php echo $row['tipoDocumento']=='C.C'?'selected':''; ?>>C.C</option>
              <option value="C.E" <?php echo $row['tipoDocumento']=='C.E'?'selected':''; ?>>C.E</option>
              <option value="NIT" <?php echo $row['tipoDocumento']=='NIT'?'selected':''; ?>>NIT</option>
              <option value="Pasaporte" <?php echo $row['tipoDocumento']=='Pasaporte'?'selected':''; ?>>Pasaporte</option>
            </select>
          </div>
          <div class="col-md-3">
            <label>Número Documento</label>
            <input type="text" class="form-control" name="documentoCliente" value="<?php echo htmlspecialchars($row['documentoCliente']); ?>">
          </div>
          <div class="col-md-3">
            <label>Tipo Cliente</label>
            <select class="form-select" name="tipoCliente">
              <option value="Residencial" <?php echo $row['tipoCliente']=='Residencial'?'selected':''; ?>>Residencial</option>
              <option value="Empresarial" <?php echo $row['tipoCliente']=='Empresarial'?'selected':''; ?>>Empresarial</option>
              <option value="Corporativo" <?php echo $row['tipoCliente']=='Corporativo'?'selected':''; ?>>Corporativo</option>
              <option value="Rural" <?php echo $row['tipoCliente']=='Rural'?'selected':''; ?>>Rural</option>
            </select>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Nombre del Cliente</label>
            <input type="text" class="form-control" name="nombreCliente" value="<?php echo htmlspecialchars($row['nombreCliente']); ?>" required>
          </div>
          <div class="col-md-4">
            <label>Apellido del Cliente</label>
            <input type="text" class="form-control" name="apellidoCliente" value="<?php echo htmlspecialchars($row['apellidoCliente']); ?>">
          </div>
          <div class="col-md-4">
            <label>Categoría Cliente</label>
            <select class="form-select" name="categoriaCliente">
              <option value="Regular" <?php echo $row['categoriaCliente']=='Regular'?'selected':''; ?>>Regular</option>
              <option value="VIP" <?php echo $row['categoriaCliente']=='VIP'?'selected':''; ?>>VIP</option>
              <option value="Moroso" <?php echo $row['categoriaCliente']=='Moroso'?'selected':''; ?>>Moroso</option>
            </select>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-6">
            <label>Origen Cliente</label>
            <select class="form-select" name="origenCliente">
              <option value="Referido" <?php echo $row['origenCliente']=='Referido'?'selected':''; ?>>Referido</option>
              <option value="Web" <?php echo $row['origenCliente']=='Web'?'selected':''; ?>>Web</option>
              <option value="Redes" <?php echo $row['origenCliente']=='Redes'?'selected':''; ?>>Redes</option>
              <option value="Puerta a puerta" <?php echo $row['origenCliente']=='Puerta a puerta'?'selected':''; ?>>Puerta a puerta</option>
              <option value="Otro" <?php echo $row['origenCliente']=='Otro'?'selected':''; ?>>Otro</option>
            </select>
          </div>
        </div>

        <!-- CONTACTO -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Información de Contacto</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Teléfono Principal</label>
            <input type="text" class="form-control" name="telefonoCliente" value="<?php echo htmlspecialchars($row['telefonoCliente']); ?>">
          </div>
          <div class="col-md-4">
            <label>Correo Electrónico</label>
            <input type="email" class="form-control" name="correoCliente" value="<?php echo htmlspecialchars($row['correoCliente']); ?>">
          </div>
          <div class="col-md-4">
            <label>Correo Facturación</label>
            <input type="email" class="form-control" name="correoFacturacion" value="<?php echo htmlspecialchars($row['correoFacturacion']); ?>">
          </div>
        </div>

        <!-- UBICACIÓN -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Ubicación</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-6">
            <label>Dirección</label>
            <input type="text" class="form-control" name="direccion" value="<?php echo htmlspecialchars($row['direccion']); ?>">
          </div>
          <div class="col-md-3">
            <label>Barrio</label>
            <input type="text" class="form-control" name="barrioCliente" value="<?php echo htmlspecialchars($row['barrioCliente']); ?>">
          </div>
          <div class="col-md-3">
            <label>Estrato</label>
            <input type="number" class="form-control" name="estrato" value="<?php echo htmlspecialchars($row['estrato']); ?>" min="1" max="6">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-3">
            <label>Ciudad</label>
            <input type="text" class="form-control" name="ciudadCliente" value="<?php echo htmlspecialchars($row['ciudadCliente']); ?>">
          </div>
          <div class="col-md-3">
            <label>Departamento</label>
            <input type="text" class="form-control" name="departamentoCliente" value="<?php echo htmlspecialchars($row['departamentoCliente']); ?>">
          </div>
          <div class="col-md-3">
            <label>País</label>
            <input type="text" class="form-control" name="pais" value="<?php echo htmlspecialchars($row['pais']); ?>">
          </div>
          <div class="col-md-3">
            <label>Código Postal</label>
            <input type="text" class="form-control" name="codigoPostalCliente" value="<?php echo htmlspecialchars($row['codigoPostalCliente']); ?>">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Coordenadas GPS</label>
            <input type="text" class="form-control" name="coordenadasGPS" value="<?php echo htmlspecialchars($row['coordenadasGPS']); ?>" placeholder="lat,lng">
          </div>
          <div class="col-md-4">
            <label>Zona Cobertura</label>
            <input type="text" class="form-control" name="zonaCobertura" value="<?php echo htmlspecialchars($row['zonaCobertura']); ?>">
          </div>
          <div class="col-md-4">
            <label>Sucursal</label>
            <input type="text" class="form-control" name="sucursal" value="<?php echo htmlspecialchars($row['sucursal']); ?>">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-6">
            <label>Referencia Ubicación</label>
            <textarea class="form-control" name="referenciaUbicacion" rows="2"><?php echo htmlspecialchars($row['referenciaUbicacion']); ?></textarea>
          </div>
          <div class="col-md-6">
            <label>Ciudad DIAN</label>
            <input type="text" class="form-control" name="ciudadDian" value="<?php echo htmlspecialchars($row['ciudadDian']); ?>">
          </div>
        </div>

        <!-- PLAN Y SERVICIO -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Plan y Servicio</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-6">
            <label>Seleccione el Plan</label>
            <select class="form-control" name="plan_idPlan">
              <?php 
              mysqli_data_seek($queryPlanes, 0);
              while ($plan = mysqli_fetch_assoc($queryPlanes)) { ?>
                <option value="<?php echo $plan['idPlan']; ?>" 
                  <?php if($plan['idPlan']==$row['plan_idPlan']) echo 'selected'; ?>>
                  <?php echo htmlspecialchars($plan['nombrePlan'] . ' - ' . $plan['velocidad'] . ' - $' . number_format($plan['precioPlan'], 0, ',', '.')); ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-3">
            <label>Estado Cliente</label>
            <select class="form-select" name="estadoCliente">
              <option value="Activo" <?php echo $row['estadoCliente']=='Activo'?'selected':''; ?>>Activo</option>
              <option value="Suspendido" <?php echo $row['estadoCliente']=='Suspendido'?'selected':''; ?>>Suspendido</option>
              <option value="Inactivo" <?php echo $row['estadoCliente']=='Inactivo'?'selected':''; ?>>Inactivo</option>
              <option value="Archivado" <?php echo $row['estadoCliente']=='Archivado'?'selected':''; ?>>Archivado</option>
            </select>
          </div>
          <div class="col-md-3">
            <label>Meses de Gracia</label>
            <select class="form-control" name="meses_gracia">
              <option value="0" <?php if(($row['meses_gracia'] ?? 0) == 0) echo 'selected'; ?>>0</option>
              <option value="1" <?php if(($row['meses_gracia'] ?? 0) == 1) echo 'selected'; ?>>1</option>
              <option value="2" <?php if(($row['meses_gracia'] ?? 0) == 2) echo 'selected'; ?>>2</option>
              <option value="3" <?php if(($row['meses_gracia'] ?? 0) == 3) echo 'selected'; ?>>3</option>
            </select>
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-6">
            <label>Motivo Suspensión</label>
            <input type="text" class="form-control" name="motivoSuspension" value="<?php echo htmlspecialchars($row['motivoSuspension']); ?>">
          </div>
          <div class="col-md-3">
            <label>Valor Instalación</label>
            <input type="number" step="0.01" class="form-control" name="valorInstalacion" value="<?php echo htmlspecialchars($row['valorInstalacion']); ?>">
          </div>
          <div class="col-md-3">
            <label>Valor a Pagar (Penalización)</label>
            <input type="number" step="0.01" class="form-control" name="valorAPagar" value="<?php echo htmlspecialchars($row['valorAPagar']); ?>">
          </div>
        </div>

        <!-- INFORMACIÓN TÉCNICA -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Información Técnica</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Tipología Red</label>
            <input type="text" class="form-control" name="tipologiaRed" value="<?php echo htmlspecialchars($row['tipologiaRed']); ?>" placeholder="FTTH, FTTC, Radio, etc.">
          </div>
          <div class="col-md-4">
            <label>Nodo Conexión</label>
            <input type="text" class="form-control" name="nodoConexion" value="<?php echo htmlspecialchars($row['nodoConexion']); ?>">
          </div>
          <div class="col-md-4">
            <label>Puerto Switch</label>
            <input type="text" class="form-control" name="puertoSwitch" value="<?php echo htmlspecialchars($row['puertoSwitch']); ?>">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Promedio Velocidad (Mbps)</label>
            <input type="number" step="0.01" class="form-control" name="promedioVelocidad" value="<?php echo htmlspecialchars($row['promedioVelocidad']); ?>">
          </div>
          <div class="col-md-4">
            <label>Calidad Servicio (1-5)</label>
            <select class="form-select" name="calidadServicio">
              <?php for ($i = 1; $i <= 5; $i++) { ?>
                <option value="<?php echo $i; ?>" <?php if($row['calidadServicio']==$i) echo 'selected'; ?>>
                  <?php echo str_repeat('⭐', $i); ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-4">
            <label>Cantidad Soportes/Mes</label>
            <input type="number" class="form-control" name="cantidadSoportesMes" value="<?php echo htmlspecialchars($row['cantidadSoportesMes']); ?>">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-6">
            <label>Último Soporte</label>
            <input type="date" class="form-control" name="ultimoSoporte" value="<?php echo htmlspecialchars($row['ultimoSoporte']); ?>">
          </div>
          <div class="col-md-6">
            <label>Técnico Asignado</label>
            <select class="form-control" name="tecnicoAsignado_idUsuario">
              <option value="">Sin asignar</option>
              <?php foreach ($usuarios as $u) { 
                if ($u['rol'] == 'Tecnico' || $u['rol'] == 'Administrador') { ?>
                  <option value="<?php echo $u['idUsuario']; ?>" 
                    <?php if($u['idUsuario']==$row['tecnicoAsignado_idUsuario']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($u['nombresUsuario']); ?>
                  </option>
              <?php }} ?>
            </select>
          </div>
        </div>

        <!-- INFORMACIÓN COMERCIAL -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Información Comercial</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Vendedor Asignado</label>
            <select class="form-control" name="vendedor_idUsuario">
              <option value="">Sin asignar</option>
              <?php foreach ($usuarios as $u) { ?>
                <option value="<?php echo $u['idUsuario']; ?>" 
                  <?php if($u['idUsuario']==$row['vendedor_idUsuario']) echo 'selected'; ?>>
                  <?php echo htmlspecialchars($u['nombresUsuario']); ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <div class="col-md-4">
            <label>Referenciado Por</label>
            <select class="form-control" name="referenciadoPor_idCliente">
              <option value="">Sin referido</option>
              <?php foreach ($clientes as $c) { 
                if ($c['idCliente'] != $row['idCliente']) { ?>
                  <option value="<?php echo $c['idCliente']; ?>" 
                    <?php if($c['idCliente']==$row['referenciadoPor_idCliente']) echo 'selected'; ?>>
                    <?php echo htmlspecialchars($c['nombreCliente'] . ' - ' . $c['documentoCliente']); ?>
                  </option>
              <?php }} ?>
            </select>
          </div>
          <div class="col-md-4">
            <label>Tiene Referidos</label>
            <input type="number" class="form-control" name="tieneReferidos" value="<?php echo htmlspecialchars($row['tieneReferidos']); ?>" readonly>
          </div>
        </div>

        <!-- FECHAS IMPORTANTES -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Fechas Importantes</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-3">
            <label>Fecha Creación</label>
            <input type="date" class="form-control" name="creado" value="<?php echo htmlspecialchars($row['creado']); ?>">
          </div>
          <div class="col-md-3">
            <label>Fecha Instalación</label>
            <input type="date" class="form-control" name="fechaInstalacion" value="<?php echo htmlspecialchars($row['fechaInstalacion']); ?>">
          </div>
          <div class="col-md-3">
            <label>Fecha Activación</label>
            <input type="date" class="form-control" name="fechaActivacion" value="<?php echo htmlspecialchars($row['fechaActivacion']); ?>">
          </div>
          <div class="col-md-3">
            <label>Última Actualización</label>
            <input type="date" class="form-control" name="ultimaActualizacion" value="<?php echo htmlspecialchars($row['ultimaActualizacion']); ?>">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Fecha Suspensión</label>
            <input type="date" class="form-control" name="fechaSuspension" value="<?php echo htmlspecialchars($row['fechaSuspension']); ?>">
          </div>
          <div class="col-md-4">
            <label>Fecha Corte</label>
            <input type="date" class="form-control" name="fechaCorte" value="<?php echo htmlspecialchars($row['fechaCorte']); ?>">
          </div>
          <div class="col-md-4">
            <label>Fecha Contrato</label>
            <input type="date" class="form-control" name="fechaContrato" value="<?php echo htmlspecialchars($row['fechaContrato']); ?>">
          </div>
        </div>

        <!-- FACTURACIÓN ACTUAL -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Facturación Actual</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-3">
            <label>Fecha Factura</label>
            <input type="date" class="form-control" name="fechaFactura" value="<?php echo htmlspecialchars($row['fechaFactura'] ?? ''); ?>">
          </div>
          <div class="col-md-3">
            <label>Fecha Vencimiento</label>
            <input type="date" class="form-control" name="fechaVencimiento" value="<?php echo htmlspecialchars($row['fechaVencimiento'] ?? ''); ?>">
          </div>
          <div class="col-md-3">
            <label>Fecha Suspensión (Factura)</label>
            <input type="date" class="form-control" name="fechaSuspencion" value="<?php echo htmlspecialchars($fechaSuspencion); ?>">
          </div>
          <div class="col-md-3">
            <label>Estado Factura</label>
            <select class="form-select" name="estadoFactura">
              <option value="">Seleccione...</option>
              <option value="Pagada" <?php if(($row['estadoFactura'] ?? '')=='Pagada') echo 'selected'; ?>>Pagada</option>
              <option value="Pendiente" <?php if(($row['estadoFactura'] ?? '')=='Pendiente') echo 'selected'; ?>>Pendiente</option>
              <option value="Vencida" <?php if(($row['estadoFactura'] ?? '')=='Vencida') echo 'selected'; ?>>Vencida</option>
              <option value="Gratis" <?php if(($row['estadoFactura'] ?? '')=='Gratis') echo 'selected'; ?>>Gratis</option>
              <option value="Anulada" <?php if(($row['estadoFactura'] ?? '')=='Anulada') echo 'selected'; ?>>Anulada</option>
            </select>
          </div>
        </div>

        <!-- CONTRATO -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Información de Contrato</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Cláusula Meses (Permanencia)</label>
            <input type="number" class="form-control" name="clausulaMeses" value="<?php echo htmlspecialchars($row['clausulaMeses']); ?>">
          </div>
          <div class="col-md-4">
            <label>Mes Fin Contrato</label>
            <input type="date" class="form-control" name="mesFin" value="<?php echo htmlspecialchars($row['mesFin']); ?>">
          </div>
          <div class="col-md-4">
            <label>Meses para Finalizar</label>
            <input type="number" class="form-control" name="mesesParaFinalizar" value="<?php echo htmlspecialchars($row['mesesParaFinalizar']); ?>" readonly>
          </div>
        </div>

        <!-- AUDITORÍA -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Auditoría y Trazabilidad</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-3">
            <label>Creado Por (ID)</label>
            <input type="text" class="form-control" name="creadoPor" value="<?php echo htmlspecialchars($row['creadoPor']); ?>">
          </div>
          <div class="col-md-3">
            <label>Actualizado Por (ID)</label>
            <input type="text" class="form-control" name="actualizadoPor" value="<?php echo htmlspecialchars($row['actualizadoPor']); ?>">
          </div>
          <div class="col-md-3">
            <label>Eliminado</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="eliminado" value="1" <?php echo $row['eliminado'] ? 'checked' : ''; ?>>
              <label class="form-check-label">Registro eliminado (lógico)</label>
            </div>
          </div>
        </div>

        <!-- OBSERVACIONES Y NOTAS -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Observaciones y Notas</h3>
        <hr>

        <div class="mb-2">
          <label>Observaciones</label>
          <textarea class="form-control" name="observaciones" rows="3"><?php echo htmlspecialchars($row['observaciones']); ?></textarea>
        </div>

        <div class="mb-2">
          <label>Notas</label>
          <textarea class="form-control" name="notas" rows="4"><?php echo htmlspecialchars($row['notas']); ?></textarea>
        </div>

        <div class="mb-3">
          <label>Documentos Adjuntos (texto/JSON/rutas)</label>
          <textarea class="form-control" name="documentosAdjuntos" rows="3"><?php echo htmlspecialchars($row['documentosAdjuntos']); ?></textarea>
        </div>

        <!-- BOTONES -->
        <div style="text-align:center; margin-top:18px;">
          <input type="submit" class="btn btn-primary btn-lg" value="Actualizar Cliente">
          <a href="tablas.php" class="btn btn-secondary btn-lg" style="margin-left:8px;">Volver</a>
          <a href="vercliente.php?id=<?php echo urlencode($row['documentoCliente']); ?>" class="btn btn-info btn-lg" style="margin-left:8px;">Ver Detalles</a>
        </div>

      </form>
    </div>
  </div>
</div>

</body>
</html>
<style>
/* === TEMA OSCURO GENERAL === */
body {
  background-color: #1a1a1a;
  color: #e0e0e0;
}

.main-panel {
  background-color: #1a1a1a;
}

.content-wrapper {
  background-color: #1a1a1a;
}

.card-body {
  background-color: #2a2a2a;
  padding: 30px;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.5);
}

/* === TÍTULOS Y ENCABEZADOS === */
h1 {
  color: #ffffff !important;
  margin-bottom: 20px;
}

h3 {
  color: #ffffff !important;
  background-color: #1d1f20 !important;
  padding: 12px 20px;
  border-radius: 6px;
  margin-bottom: 20px;
  margin-top: 25px;
  border-left: 4px solid #4a9eff;
}

.card-description {
  color: #b0b0b0 !important;
  margin-bottom: 25px;
}

/* === LABELS === */
label {
  color: #e0e0e0 !important;
  font-weight: 500;
  margin-bottom: 6px;
  display: block;
}

/* === INPUTS Y SELECTS === */
.form-control,
.form-select {
  background-color: #333333 !important;
  color: #ffffff !important;
  border: 1px solid #4a4a4a !important;
  border-radius: 4px;
  padding: 8px 12px;
}

.form-control:focus,
.form-select:focus {
  background-color: #3a3a3a !important;
  color: #ffffff !important;
  border-color: #4a9eff !important;
  box-shadow: 0 0 0 0.2rem rgba(74, 158, 255, 0.25);
  outline: none;
}

.form-control::placeholder {
  color: #888888;
}

/* === CAMPOS DE SOLO LECTURA === */
input.form-control[readonly],
textarea.form-control[readonly],
select.form-control[readonly],
input.form-control:disabled,
textarea.form-control:disabled,
select.form-control:disabled {
  background-color: #252525 !important;
  color: #999999 !important;
  border: 1px solid #3a3a3a !important;
  opacity: 1 !important;
  cursor: not-allowed;
}

/* === TEXTAREAS === */
textarea.form-control {
  min-height: 80px;
  resize: vertical;
}

/* === CHECKBOXES === */
.form-check {
  padding-top: 8px;
}

.form-check-input {
  background-color: #333333;
  border: 1px solid #4a4a4a;
}

.form-check-input:checked {
  background-color: #4a9eff;
  border-color: #4a9eff;
}

.form-check-label {
  color: #e0e0e0 !important;
  margin-left: 8px;
}

/* === SEPARADORES === */
hr {
  margin: 20px 0;
  border: 0;
  border-top: 2px solid #3a3a3a;
  opacity: 1;
}

/* === BOTONES === */
.btn {
  padding: 10px 24px;
  border-radius: 5px;
  font-weight: 500;
  transition: all 0.3s ease;
}

.btn-primary {
  background-color: #4a9eff;
  border-color: #4a9eff;
  color: #ffffff;
}

.btn-primary:hover {
  background-color: #3a8eef;
  border-color: #3a8eef;
  transform: translateY(-1px);
  box-shadow: 0 4px 8px rgba(74, 158, 255, 0.3);
}

.btn-secondary {
  background-color: #555555;
  border-color: #555555;
  color: #ffffff;
}

.btn-secondary:hover {
  background-color: #666666;
  border-color: #666666;
  transform: translateY(-1px);
}

.btn-info {
  background-color: #17a2b8;
  border-color: #17a2b8;
  color: #ffffff;
}

.btn-info:hover {
  background-color: #138496;
  border-color: #138496;
  transform: translateY(-1px);
}

.btn-lg {
  padding: 12px 32px;
  font-size: 16px;
}

/* === ESPACIADO === */
.row.mb-2 {
  margin-bottom: 18px;
}

.mb-2 {
  margin-bottom: 18px;
}

.mb-3 {
  margin-bottom: 24px;
}

/* === RESPONSIVO === */
@media (max-width: 768px) {
  .card-body {
    padding: 20px;
  }
  
  h1 {
    font-size: 24px !important;
  }
  
  h3 {
    font-size: 18px !important;
    padding: 10px 15px;
  }
  
  .btn-lg {
    padding: 10px 20px;
    font-size: 14px;
  }
}

/* === SCROLLBAR OSCURO === */
::-webkit-scrollbar {
  width: 10px;
  height: 10px;
}

::-webkit-scrollbar-track {
  background: #1a1a1a;
}

::-webkit-scrollbar-thumb {
  background: #4a4a4a;
  border-radius: 5px;
}

::-webkit-scrollbar-thumb:hover {
  background: #5a5a5a;
}

/* === SELECT OPTIONS === */
select.form-control option,
select.form-select option {
  background-color: #333333;
  color: #ffffff;
}

/* === ANIMACIONES SUTILES === */
.form-control,
.form-select,
.btn {
  transition: all 0.2s ease;
}
</style>