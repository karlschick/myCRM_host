<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica sesión activa
if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once __DIR__ . '/../../config/db.php';
include '../../includes/header.php';

// Helper de saneamiento
function s($v) {
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h1 style="font-size: 32px;">DETALLES DEL CLIENTE</h1>
    </div>

    <div class="card">
      <div class="card-body">

        <?php
        // Validar que venga el identificador (puede ser idCliente o documentoCliente)
        if (!isset($_GET['id']) || trim($_GET['id']) === '') {
            echo "<div class='alert alert-danger'>No se especificó un cliente.</div>";
        } else {
            $idRaw = trim($_GET['id']);
            $idParam = $idRaw;

            // Consulta todos los campos relevantes de la tabla cliente
            $sql = "
                SELECT
                    c.idCliente,
                    c.tipoDocumento,
                    c.documentoCliente,
                    c.tipoCliente,
                    c.nombreCliente,
                    c.apellidoCliente,
                    c.telefonoCliente,
                    c.correoCliente,
                    c.correoFacturacion,
                    c.pais,
                    c.ciudadCliente,
                    c.departamentoCliente,
                    c.direccion,
                    c.barrioCliente,
                    c.estrato,
                    c.codigoPostalCliente,
                    c.coordenadasGPS,
                    c.referenciaUbicacion,
                    c.zonaCobertura,
                    c.sucursal,
                    c.ciudadDian,
                    c.estadoCliente,
                    c.motivoSuspension,
                    c.vendedor_idUsuario,
                    c.tecnicoAsignado_idUsuario,
                    c.referenciadoPor_idCliente,
                    c.tieneReferidos,
                    c.origenCliente,
                    c.categoriaCliente,
                    c.cantidadSoportesMes,
                    c.ultimoSoporte,
                    c.promedioVelocidad,
                    c.calidadServicio,
                    c.observaciones,
                    c.notas,
                    c.documentosAdjuntos,
                    c.eliminado,
                    c.creadoPor,
                    c.actualizadoPor,
                    c.plan_idPlan,
                    c.creado,
                    c.fechaInstalacion,
                    c.fechaActivacion,
                    c.ultimaActualizacion,
                    c.fechaSuspension,
                    c.fechaCorte,
                    c.meses_gracia,
                    c.fechaContrato,
                    c.clausulaMeses,
                    c.mesFin,
                    c.mesesParaFinalizar,
                    c.valorAPagar,
                    c.valorInstalacion,
                    c.tipologiaRed,
                    c.nodoConexion,
                    c.puertoSwitch,
                    p.nombrePlan,
                    p.precioPlan,
                    p.velocidad AS velocidadPlan,
                    vendedor.nombresUsuario AS nombreVendedor,
                    tecnico.nombresUsuario AS nombreTecnico,
                    referido.nombreCliente AS nombreReferido,
                    f.estadoFactura,
                    f.fechaFactura,
                    f.fechaVencimiento,
                    f.fechaSuspencion,
                    f.valorTotalFactura
                FROM cliente c
                LEFT JOIN plan p ON c.plan_idPlan = p.idPlan
                LEFT JOIN usuario vendedor ON c.vendedor_idUsuario = vendedor.idUsuario
                LEFT JOIN usuario tecnico ON c.tecnicoAsignado_idUsuario = tecnico.idUsuario
                LEFT JOIN cliente referido ON c.referenciadoPor_idCliente = referido.idCliente
                LEFT JOIN factura f ON f.idFactura = (
                    SELECT f2.idFactura 
                    FROM factura f2 
                    WHERE f2.cliente_idCliente = c.idCliente
                    ORDER BY f2.idFactura DESC
                    LIMIT 1
                )
                WHERE c.documentoCliente = ? OR c.idCliente = ?
                LIMIT 1
            ";

            if ($stmt = $con->prepare($sql)) {
                $stmt->bind_param("ss", $idParam, $idParam);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    $cliente = $result->fetch_assoc();

                    // === Calcular estado de pago y condición ===
                    $estadoFactura = $cliente['estadoFactura'] ?? null;
                    $fechaSuspencion = $cliente['fechaSuspencion'] ?? null;
                    $fechaVencimiento = $cliente['fechaVencimiento'] ?? null;

                    $hoy = strtotime(date('Y-m-d'));
                    $vencimiento = $fechaVencimiento ? strtotime($fechaVencimiento) : null;
                    $suspension = $fechaSuspencion ? strtotime($fechaSuspencion) : null;

                    // Estado de PAGO
                    if ($estadoFactura === "Pagada") {
                        $estadoPago = "Pagado";
                        $colorPago = "green";
                    } elseif ($estadoFactura === "Gratis") {
                        $estadoPago = "Gratis";
                        $colorPago = "blue";
                    } elseif ($estadoFactura === "Pendiente") {
                        if ($vencimiento && $hoy <= $vencimiento) {
                            $estadoPago = "Pendiente (en plazo)";
                            $colorPago = "green";
                        } elseif ($vencimiento && $hoy > $vencimiento && $suspension && $hoy <= $suspension) {
                            $estadoPago = "Pendiente (por vencer)";
                            $colorPago = "orange";
                        } elseif ($suspension && $hoy > $suspension) {
                            $estadoPago = "En mora";
                            $colorPago = "red";
                        } else {
                            $estadoPago = "Pendiente";
                            $colorPago = "gray";
                        }
                    } elseif ($estadoFactura === "Vencida" || $estadoFactura === "Mora") {
                        if ($suspension && $hoy > $suspension) {
                            $estadoPago = "En mora";
                            $colorPago = "red";
                        } else {
                            $estadoPago = "Pendiente (por vencer)";
                            $colorPago = "orange";
                        }
                    } else {
                        $estadoPago = "Sin pago registrado";
                        $colorPago = "gray";
                    }

                    // Condición del plan
                    $condicionPlan = "Activo";
                    $colorCondicion = "green";

                    if ($cliente['estadoCliente'] === "Suspendido") {
                        $condicionPlan = "Suspendido";
                        $colorCondicion = "red";
                    } elseif ($cliente['estadoCliente'] === "Inactivo") {
                        $condicionPlan = "Inactivo";
                        $colorCondicion = "gray";
                    } elseif ($estadoFactura === "Gratis") {
                        $condicionPlan = "Gratis";
                        $colorCondicion = "blue";
                    } elseif (($estadoFactura === "Vencida" || $estadoFactura === "Mora") && $suspension && $hoy > $suspension) {
                        $condicionPlan = "En mora";
                        $colorCondicion = "red";
                    }

                    // Días restantes período de gracia
                    $diasRestantesGracia = 0;
                    $colorGracia = "gray";
                    $textoGracia = "Sin período de gracia";

                    if (!empty($cliente['creado']) && $cliente['meses_gracia'] > 0) {
                        $fechaCreacion = strtotime($cliente['creado']);
                        $mesesGracia = (int)$cliente['meses_gracia'];
                        $fechaFinGracia = strtotime("+$mesesGracia month", $fechaCreacion);

                        $diff = $fechaFinGracia - $hoy;
                        $diasRestantesGracia = floor($diff / (60 * 60 * 24));

                        if ($diasRestantesGracia > 0) {
                            $textoGracia = "Faltan $diasRestantesGracia días de gracia";
                            $colorGracia = "green";
                        } else {
                            $textoGracia = "El período de gracia ha terminado";
                            $colorGracia = "red";
                            $diasRestantesGracia = 0;
                        }
                    }

                    // Días después de suspensión
                    $diasDespuesSusp = 0;
                    if ($fechaSuspencion && !in_array($estadoFactura, ['Pagada', 'Gratis'])) {
                        $fechaSusp = strtotime($fechaSuspencion);
                        $diff = $hoy - $fechaSusp;
                        if ($diff > 0) {
                            $diasDespuesSusp = floor($diff / (60 * 60 * 24));
                        }
                    }

                    // === Consultar teléfonos adicionales ===
                    $telefonos = [];
                    $sqlTel = "SELECT tipoTelefono, numeroTelefono, nombreContacto, esPrincipal 
                               FROM cliente_telefono 
                               WHERE cliente_idCliente = ? AND activo = 1 
                               ORDER BY esPrincipal DESC, idTelefono";
                    if ($stmtTel = $con->prepare($sqlTel)) {
                        $stmtTel->bind_param("i", $cliente['idCliente']);
                        $stmtTel->execute();
                        $resultTel = $stmtTel->get_result();
                        while ($tel = $resultTel->fetch_assoc()) {
                            $telefonos[] = $tel;
                        }
                        $stmtTel->close();
                    }

                    // === Consultar servicios contratados ===
                    $servicios = [];
                    $sqlServ = "SELECT cs.*, s.nombreServicio, s.tipoServicio 
                                FROM cliente_servicio cs
                                INNER JOIN servicio s ON cs.servicio_idServicio = s.idServicio
                                WHERE cs.cliente_idCliente = ?
                                ORDER BY cs.esPrincipal DESC, cs.fechaContratacion DESC";
                    if ($stmtServ = $con->prepare($sqlServ)) {
                        $stmtServ->bind_param("i", $cliente['idCliente']);
                        $stmtServ->execute();
                        $resultServ = $stmtServ->get_result();
                        while ($serv = $resultServ->fetch_assoc()) {
                            $servicios[] = $serv;
                        }
                        $stmtServ->close();
                    }

                    // === Consultar equipos instalados ===
                    $equipos = [];
                    $sqlEquip = "SELECT * FROM cliente_equipo 
                                 WHERE cliente_idCliente = ? 
                                 ORDER BY fechaInstalacion DESC";
                    if ($stmtEquip = $con->prepare($sqlEquip)) {
                        $stmtEquip->bind_param("i", $cliente['idCliente']);
                        $stmtEquip->execute();
                        $resultEquip = $stmtEquip->get_result();
                        while ($equip = $resultEquip->fetch_assoc()) {
                            $equipos[] = $equip;
                        }
                        $stmtEquip->close();
                    }

                    // === Consultar IPs públicas ===
                    $ips_publicas = [];
                    $sqlIp = "SELECT * FROM ip_publica 
                              WHERE cliente_idCliente = ? AND activo = 1 
                              ORDER BY fechaAsignacion DESC";
                    if ($stmtIp = $con->prepare($sqlIp)) {
                        $stmtIp->bind_param("i", $cliente['idCliente']);
                        $stmtIp->execute();
                        $resultIp = $stmtIp->get_result();
                        while ($ip = $resultIp->fetch_assoc()) {
                            $ips_publicas[] = $ip;
                        }
                        $stmtIp->close();
                    }

                    // === Consultar valores agregados ===
                    $valores_agregados = [];
                    $sqlVa = "SELECT sva.*, va.nombreValorAgregado, va.descripcion 
                              FROM servicio_valor_agregado sva
                              INNER JOIN valor_agregado va ON sva.valorAgregado_id = va.idValorAgregado
                              WHERE sva.clienteServicio_id IN (
                                  SELECT idClienteServicio FROM cliente_servicio WHERE cliente_idCliente = ?
                              ) AND sva.activo = 1
                              ORDER BY sva.fechaAgregado DESC";
                    if ($stmtVa = $con->prepare($sqlVa)) {
                        $stmtVa->bind_param("i", $cliente['idCliente']);
                        $stmtVa->execute();
                        $resultVa = $stmtVa->get_result();
                        while ($va = $resultVa->fetch_assoc()) {
                            $valores_agregados[] = $va;
                        }
                        $stmtVa->close();
                    }
                    ?>

<!-- ENCABEZADO CON NOMBRE -->
<div class="text-center mb-4">
  <h3 class="fw-bold mb-0 text-secondary">
    <?php echo s($cliente['nombreCliente']) . ' ' . s($cliente['apellidoCliente']); ?>
  </h3>
  <small class="text-muted d-block"><?php echo s($cliente['tipoCliente'] . ' • ' . $cliente['categoriaCliente']); ?></small>
</div>

<!-- TABLA DETALLES -->
<div class="table-responsive">
  <table class="table table-bordered table-striped align-middle">
    <tbody>

      <!-- Información personal -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Información Personal</th></tr>
      <tr>
        <th>Nombre</th><td><?php echo s($cliente['nombreCliente']); ?></td>
        <th>Apellido</th><td><?php echo s($cliente['apellidoCliente']); ?></td>
      </tr>
      <tr>
        <th>ID Cliente</th><td><?php echo s($cliente['idCliente']); ?></td>
        <th>Tipo Documento</th><td><?php echo s($cliente['tipoDocumento']); ?></td>
      </tr>
      <tr>
        <th>Número Documento</th><td><?php echo s($cliente['documentoCliente']); ?></td>
        <th>Tipo Cliente</th><td><?php echo s($cliente['tipoCliente']); ?></td>
      </tr>
      <tr>
        <th>Correo Principal</th><td><?php echo s($cliente['correoCliente']); ?></td>
        <th>Correo Facturación</th><td><?php echo s($cliente['correoFacturacion']); ?></td>
      </tr>

      <!-- Contacto y teléfonos -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Teléfonos de Contacto</th></tr>
      <tr>
        <th>Teléfono Principal</th><td colspan="3"><?php echo s($cliente['telefonoCliente']); ?></td>
      </tr>
      <?php foreach ($telefonos as $tel): ?>
      <tr>
        <th><?php echo s($tel['tipoTelefono']) . ($tel['esPrincipal'] ? ' ★' : ''); ?></th>
        <td><?php echo s($tel['numeroTelefono']); ?></td>
        <th>Contacto</th>
        <td><?php echo s($tel['nombreContacto'] ?: 'N/A'); ?></td>
      </tr>
      <?php endforeach; ?>

      <!-- Ubicación -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Ubicación</th></tr>
      <tr>
        <th>Dirección</th><td><?php echo s($cliente['direccion']); ?></td>
        <th>Barrio</th><td><?php echo s($cliente['barrioCliente']); ?></td>
      </tr>
      <tr>
        <th>Ciudad</th><td><?php echo s($cliente['ciudadCliente']); ?></td>
        <th>Departamento</th><td><?php echo s($cliente['departamentoCliente']); ?></td>
      </tr>
      <tr>
        <th>País</th><td><?php echo s($cliente['pais']); ?></td>
        <th>Código Postal</th><td><?php echo s($cliente['codigoPostalCliente']); ?></td>
      </tr>
      <tr>
        <th>Estrato</th><td><?php echo s($cliente['estrato']); ?></td>
        <th>Zona Cobertura</th><td><?php echo s($cliente['zonaCobertura']); ?></td>
      </tr>
      <tr>
        <th>Coordenadas GPS</th><td><?php echo s($cliente['coordenadasGPS']); ?></td>
        <th>Referencia Ubicación</th><td><?php echo s($cliente['referenciaUbicacion']); ?></td>
      </tr>
      <tr>
        <th>Sucursal</th><td><?php echo s($cliente['sucursal']); ?></td>
        <th>Ciudad DIAN</th><td><?php echo s($cliente['ciudadDian']); ?></td>
      </tr>

      <!-- Plan y Servicio -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Plan y Servicio</th></tr>
      <tr>
        <th>ID Plan</th><td><?php echo s($cliente['plan_idPlan']); ?></td>
        <th>Nombre Plan</th><td><?php echo s($cliente['nombrePlan'] ?? 'Sin plan'); ?></td>
      </tr>
      <tr>
        <th>Velocidad Plan</th><td><?php echo s($cliente['velocidadPlan']); ?></td>
        <th>Precio Plan</th><td><?php echo isset($cliente['precioPlan']) ? '$' . number_format($cliente['precioPlan'], 0, ',', '.') : 'N/A'; ?></td>
      </tr>
      <tr>
        <th>Estado Cliente</th><td><?php echo s($cliente['estadoCliente']); ?></td>
        <th>Motivo Suspensión</th><td><?php echo s($cliente['motivoSuspension']); ?></td>
      </tr>
      <tr>
        <th>Condición Plan</th>
        <td>
          <span style="display:inline-block;width:15px;height:15px;background-color:<?php echo $colorCondicion; ?>;border-radius:50%;margin-right:8px;"></span>
          <strong style="color:<?php echo $colorCondicion; ?>"><?php echo $condicionPlan; ?></strong>
        </td>
        <th>Estado Pago</th>
        <td>
          <span style="display:inline-block;width:15px;height:15px;background-color:<?php echo $colorPago; ?>;border-radius:50%;margin-right:8px;"></span>
          <strong style="color:<?php echo $colorPago; ?>"><?php echo $estadoPago; ?></strong>
        </td>
      </tr>

      <!-- Servicios Contratados -->
      <?php if (!empty($servicios)): ?>
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Servicios Contratados</th></tr>
      <?php foreach ($servicios as $serv): ?>
      <tr>
        <th><?php echo s($serv['nombreServicio']) . ($serv['esPrincipal'] ? ' ★' : ''); ?></th>
        <td><?php echo s($serv['tipoServicio']); ?></td>
        <th>Valor</th>
        <td>$<?php echo number_format($serv['valorServicio'], 0, ',', '.'); ?> (<?php echo s($serv['estadoServicio']); ?>)</td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>

      <!-- Equipos Instalados -->
      <?php if (!empty($equipos)): ?>
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Equipos Instalados</th></tr>
      <?php foreach ($equipos as $equip): ?>
      <tr>
        <th><?php echo s($equip['tipoEquipo']); ?></th>
        <td><?php echo s($equip['modeloEquipo']) . ' - ' . s($equip['marcaEquipo']); ?></td>
        <th>MAC / Serial</th>
        <td><?php echo s($equip['macEquipo']) . ' / ' . s($equip['serialEquipo']); ?> (<?php echo s($equip['estadoEquipo']); ?>)</td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>

      <!-- IPs Públicas -->
      <?php if (!empty($ips_publicas)): ?>
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">IPs Públicas Asignadas</th></tr>
      <?php foreach ($ips_publicas as $ip): ?>
      <tr>
        <th>IP Inicial</th><td><?php echo s($ip['ipPublicaInicial']); ?></td>
        <th>IP Final</th><td><?php echo s($ip['ipPublicaFinal'] ?: 'N/A'); ?></td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>

      <!-- Valores Agregados -->
      <?php if (!empty($valores_agregados)): ?>
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Valores Agregados</th></tr>
      <?php foreach ($valores_agregados as $va): ?>
      <tr>
        <th><?php echo s($va['nombreValorAgregado']); ?></th>
        <td colspan="2"><?php echo s($va['descripcion']); ?></td>
        <td>$<?php echo number_format($va['valorCobrado'], 0, ',', '.'); ?></td>
      </tr>
      <?php endforeach; ?>
      <?php endif; ?>

      <!-- Red y Técnico -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Información Técnica</th></tr>
      <tr>
        <th>Tipología Red</th><td><?php echo s($cliente['tipologiaRed']); ?></td>
        <th>Nodo Conexión</th><td><?php echo s($cliente['nodoConexion']); ?></td>
      </tr>
      <tr>
        <th>Puerto Switch</th><td><?php echo s($cliente['puertoSwitch']); ?></td>
        <th>Técnico Asignado</th><td><?php echo s($cliente['nombreTecnico'] ?: 'Sin asignar'); ?></td>
      </tr>
      <tr>
        <th>Promedio Velocidad</th><td><?php echo s($cliente['promedioVelocidad']) . ' Mbps'; ?></td>
        <th>Calidad Servicio</th><td><?php echo str_repeat('⭐', $cliente['calidadServicio'] ?? 0); ?></td>
      </tr>

      <!-- Comercial -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Información Comercial</th></tr>
      <tr>
        <th>Vendedor</th><td><?php echo s($cliente['nombreVendedor'] ?: 'Sin asignar'); ?></td>
        <th>Referido Por</th><td><?php echo s($cliente['nombreReferido'] ?: 'Sin referido'); ?></td>
      </tr>
      <tr>
        <th>Tiene Referidos</th><td><?php echo s($cliente['tieneReferidos']); ?></td>
        <th>Origen Cliente</th><td><?php echo s($cliente['origenCliente']); ?></td>
      </tr>
      <tr>
        <th>Categoría</th><td><?php echo s($cliente['categoriaCliente']); ?></td>
        <th>Soportes Mes</th><td><?php echo s($cliente['cantidadSoportesMes']); ?></td>
      </tr>
      <tr>
        <th>Último Soporte</th><td colspan="3"><?php echo s($cliente['ultimoSoporte']); ?></td>
      </tr>

      <!-- Fechas -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Fechas Importantes</th></tr>
      <tr>
        <th>Fecha Creación</th><td><?php echo s($cliente['creado']); ?></td>
        <th>Fecha Instalación</th><td><?php echo s($cliente['fechaInstalacion']); ?></td>
      </tr>
      <tr>
        <th>Fecha Activación</th><td><?php echo s($cliente['fechaActivacion']); ?></td>
        <th>Última Actualización</th><td><?php echo s($cliente['ultimaActualizacion']); ?></td>
      </tr>
      <tr>
        <th>Fecha Suspensión</th><td><?php echo s($cliente['fechaSuspension']); ?></td>
        <th>Fecha Corte</th><td><?php echo s($cliente['fechaCorte']); ?></td>
      </tr>

      <!-- Facturación Actual -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Facturación Actual</th></tr>
      <tr>
        <th>Fecha Factura</th><td><?php echo s($cliente['fechaFactura']); ?></td>
        <th>Fecha Vencimiento</th><td><?php echo s($cliente['fechaVencimiento']); ?></td>
      </tr>
      <tr>
        <th>Fecha Suspensión</th><td><?php echo s($cliente['fechaSuspencion']); ?></td>
        <th>Valor Total</th><td>$<?php echo number_format($cliente['valorTotalFactura'] ?? 0, 0, ',', '.'); ?></td>
      </tr>
      <tr>
        <th>Días Gracia Restantes</th>
        <td><strong style="color:<?php echo $colorGracia; ?>"><?php echo $textoGracia; ?></strong></td>
        <th>Días Post-Suspensión</th>
        <td><strong style="color:<?php echo $diasDespuesSusp > 0 ? 'red' : 'gray'; ?>"><?php echo $diasDespuesSusp; ?> días</strong></td>
      </tr>

      <!-- Contrato -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Contrato</th></tr>
      <tr>
        <th>Fecha Contrato</th><td><?php echo s($cliente['fechaContrato']); ?></td>
        <th>Cláusula Meses</th><td><?php echo s($cliente['clausulaMeses']); ?></td>
      </tr>
      <tr>
        <th>Mes Fin</th><td><?php echo s($cliente['mesFin']); ?></td>
        <th>Meses para Finalizar</th><td><?php echo s($cliente['mesesParaFinalizar']); ?></td>
      </tr>
      <tr>
        <th>Valor a Pagar (Penalización)</th><td><?php echo isset($cliente['valorAPagar']) ? '$' . number_format($cliente['valorAPagar'], 0, ',', '.') : 'N/A'; ?></td>
        <th>Valor Instalación</th><td><?php echo isset($cliente['valorInstalacion']) ? '$' . number_format($cliente['valorInstalacion'], 0, ',', '.') : 'N/A'; ?></td>
      </tr>

      <!-- Observaciones -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Observaciones y Notas</th></tr>
      <tr>
        <th>Observaciones</th><td colspan="3"><?php echo nl2br(s($cliente['observaciones'])); ?></td>
      </tr>
      <tr>
        <th>Notas</th><td colspan="3"><?php echo nl2br(s($cliente['notas'])); ?></td>
      </tr>
      <tr>
        <th>Documentos Adjuntos</th><td colspan="3"><?php echo nl2br(s($cliente['documentosAdjuntos'])); ?></td>
      </tr>

    </tbody>
  </table>
</div>

<div class="mt-3">
    <a href="tablas.php" class="btn btn-secondary">← Volver a la lista</a>
    <a href="actualizar.php?id=<?php echo urlencode($cliente['documentoCliente'] ?: $cliente['idCliente']); ?>" class="btn btn-info">Editar Cliente</a>
    <a href="../facturacion/facturas_antiguasXcli.php?idCliente=<?php echo urlencode($cliente['idCliente']); ?>" class="btn btn-warning">Ver Historial de Facturas</a>

    <?php
    // Botón condicional según el estado
    $estado = $cliente['estadoCliente'] ?? '';
    $doc = $cliente['documentoCliente'] ?: $cliente['idCliente'];

    if (strtolower($estado) === 'activo') {
        echo "<a href='deleteCliente.php?id={$doc}&accion=archivar' class='btn btn-warning' onclick='return confirm(\"¿Archivar este cliente?\")'>Archivar</a>";
    } else {
        echo "<a href='deleteCliente.php?id={$doc}&accion=eliminar' class='btn btn-danger' onclick='return confirm(\"¿Eliminar definitivamente este cliente?\")'>Eliminar</a>";
    }
    ?>
</div>

<?php
                } else {
                    echo "<div class='alert alert-warning'>Cliente no encontrado.</div>";
                }

                $stmt->close();
            } else {
                echo "<div class='alert alert-danger'>Error en la consulta: " . s($con->error) . "</div>";
            }
        }
        ?>

      </div>
    </div>
  </div>
</div>

<style>
.section-title th {
    background-color: #1d1f20ff;
    font-weight: bold;
    font-size: 1.1em;
}
</style>

</body>
</html>