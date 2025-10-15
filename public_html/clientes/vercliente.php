<?php
session_start();
error_reporting(0);

// Verifica sesión activa
if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

require_once __DIR__ . '/../../config/db.php';
include '../../includes/header.php';
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
        if (!isset($_GET['id'])) {
            echo "<div class='alert alert-danger'>No se especificó un cliente.</div>";
        } else {
            $id = intval($_GET['id']);

            // Consulta cliente + última factura (incluye fechaSuspencion)
            $sql = "SELECT 
                        c.idCliente,
                        c.tipoDocumento,
                        c.documentoCliente,
                        c.nombreCliente,
                        c.telefonoCliente,
                        c.correoCliente,
                        c.direccion,
                        c.estadoCliente,
                        c.plan_idPlan,
                        p.nombrePlan,
                        p.precioPlan,
                        c.creado,
                        c.ultimaActualizacion,
                        c.meses_gracia,
                        f.estadoFactura,
                        f.fechaFactura,
                        f.fechaVencimiento,
                        f.fechaSuspencion
                    FROM cliente c
                    LEFT JOIN plan p ON c.plan_idPlan = p.idPlan
                    LEFT JOIN factura f ON f.idFactura = (
                        SELECT f2.idFactura 
                        FROM factura f2 
                        WHERE f2.cliente_idCliente = c.idCliente
                        ORDER BY f2.idFactura DESC
                        LIMIT 1
                    )
                    WHERE c.idCliente = ? LIMIT 1";

            if ($stmt = $con->prepare($sql)) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    $cliente = $result->fetch_assoc();

                    // --- Variables de factura ---
                    $estadoFactura = $cliente['estadoFactura'] ?? null;
                    $fechaFactura = $cliente['fechaFactura'] ?? null;
                    $fechaVencimiento = $cliente['fechaVencimiento'] ?? null;
                    $fechaSuspencion = $cliente['fechaSuspencion'] ?? null;

                    $hoy = strtotime(date('Y-m-d'));
                    $vencimiento = $fechaVencimiento ? strtotime($fechaVencimiento) : null;
                    $suspension = $fechaSuspencion ? strtotime($fechaSuspencion) : null;

                    // === Calcular días restantes del período de gracia ===
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

                    // === Estado de PAGO ===
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

                    // === Condición del plan ===
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

                    // === Calcular días después de suspensión ===
                    $diasDespuesSusp = 0;
                    if ($fechaSuspencion && !in_array($estadoFactura, ['Pagada', 'Gratis'])) {
                        $fechaSusp = strtotime($fechaSuspencion);
                        $diff = $hoy - $fechaSusp;
                        if ($diff > 0) {
                            $diasDespuesSusp = floor($diff / (60 * 60 * 24));
                        }
                    }
                    ?>

                    <div class="table-responsive mt-3">
                      <table class="table table-bordered table-striped">
                        <tbody>
                          <tr><th>ID Cliente</th><td><?php echo htmlspecialchars($cliente['idCliente']); ?></td></tr>
                          <tr><th>Tipo de Documento</th><td><?php echo htmlspecialchars($cliente['tipoDocumento']); ?></td></tr>
                          <tr><th>Número de Documento</th><td><?php echo htmlspecialchars($cliente['documentoCliente']); ?></td></tr>
                          <tr><th>Nombre del Cliente</th><td><?php echo htmlspecialchars($cliente['nombreCliente']); ?></td></tr>
                          <tr><th>Teléfono</th><td><?php echo htmlspecialchars($cliente['telefonoCliente']); ?></td></tr>
                          <tr><th>Correo Electrónico</th><td><?php echo htmlspecialchars($cliente['correoCliente']); ?></td></tr>
                          <tr><th>Dirección</th><td><?php echo htmlspecialchars($cliente['direccion']); ?></td></tr>
                          <tr><th>Estado del Cliente</th><td><?php echo htmlspecialchars($cliente['estadoCliente']); ?></td></tr>

                          <!-- Plan -->
                          <tr><th>ID del Plan</th><td><?php echo htmlspecialchars($cliente['plan_idPlan']); ?></td></tr>
                          <tr><th>Nombre del Plan</th><td><?php echo htmlspecialchars($cliente['nombrePlan'] ?? 'Sin plan asignado'); ?></td></tr>
                          <tr><th>Valor Actual del Plan</th><td><?php echo isset($cliente['precioPlan']) ? '$' . number_format($cliente['precioPlan'], 0, ',', '.') : 'Sin valor'; ?></td></tr>

                          <!-- Fechas -->
                          <tr><th>Fecha de Creación del Cliente</th><td><?php echo htmlspecialchars($cliente['creado']); ?></td></tr>
                          <tr><th>Última Actualización de Datos</th><td><?php echo htmlspecialchars($cliente['ultimaActualizacion']); ?></td></tr>
                          <tr><th>Fecha de Emisión de la Última Factura</th><td><?php echo $fechaFactura ? htmlspecialchars($fechaFactura) : 'Sin registro'; ?></td></tr>
                          <tr><th>Fecha Límite de Pago</th><td><?php echo $fechaVencimiento ? htmlspecialchars($fechaVencimiento) : 'Sin registro'; ?></td></tr>
                          <tr><th>Fecha de Suspensión</th><td><?php echo $fechaSuspencion ? htmlspecialchars($fechaSuspencion) : 'Sin registro'; ?></td></tr>

                          <!-- Días restantes del período de gracia -->
                          <tr>
                            <th>Días restantes del período de gracia</th>
                            <td><strong style="color:<?php echo $colorGracia; ?>"><?php echo $textoGracia; ?></strong></td>
                          </tr>

                          <!-- Días después de suspensión -->
                          <tr>
                            <th>Días transcurridos después de la suspensión</th>
                            <td>
                              <?php 
                                echo $diasDespuesSusp > 0 
                                  ? "<strong style='color:red;'>{$diasDespuesSusp} días</strong>" 
                                  : "<strong style='color:gray;'>0 días</strong>"; 
                              ?>
                            </td>
                          </tr>

                          <!-- Estado de pago -->
                          <tr>
                            <th>Estado de Pago</th>
                            <td>
                              <span style="display:inline-block;width:15px;height:15px;background-color:<?php echo $colorPago; ?>;border-radius:50%;margin-right:8px;"></span>
                              <strong style="color:<?php echo $colorPago; ?>"><?php echo $estadoPago; ?></strong>
                            </td>
                          </tr>

                          <!-- Condición del plan -->
                          <tr>
                            <th>Condición actual del Plan</th>
                            <td>
                              <span style="display:inline-block;width:15px;height:15px;background-color:<?php echo $colorCondicion; ?>;border-radius:50%;margin-right:8px;"></span>
                              <strong style="color:<?php echo $colorCondicion; ?>"><?php echo $condicionPlan; ?></strong>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>

                    <div class="mt-3">
                      <a href="tablas.php" class="btn btn-secondary">← Volver a la lista</a>
                      <a href="actualizar.php?id=<?php echo urlencode($cliente['documentoCliente']); ?>" class="btn btn-info">Editar Cliente</a>
                      <a href="../facturacion/facturas_antiguasXcli.php?idCliente=<?php echo urlencode($cliente['idCliente']); ?>" class="btn btn-warning">Ver historial de facturas</a>
                    </div>

                    <?php
                } else {
                    echo "<div class='alert alert-warning'>Cliente no encontrado.</div>";
                }

                $stmt->close();
            } else {
                echo "<div class='alert alert-danger'>Error en la consulta: " . htmlspecialchars($con->error) . "</div>";
            }
        }
        ?>

      </div>
    </div>
  </div>
</div>
</body>
</html>
