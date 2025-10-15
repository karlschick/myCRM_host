<?php
// Seguridad de sesiones
session_start();
error_reporting(0);

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

include '../../includes/header.php';
?>

<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h1 style="font-size: 32px;">GESTIÓN FACTURAS</h1>
    </div>

    <div class="card">
      <div class="card-body">
        <a href="factcliente.php" class="btn btn-dark btn-lg">Ingresar nueva factura</a>
        <a href="fpagas.php" class="btn btn-success btn-lg">Ver facturas pagas</a>
        <a href="fpendientes.php" class="btn btn-warning btn-lg">Ver facturas pendientes</a>
        <a href="fmora.php" class="btn btn-danger btn-lg">Ver facturas en mora</a>
        <a href="consultarf.php" class="btn btn-primary btn-lg">Consultar facturas</a>
        <a href="../excel/excelFactura.php" class="btn btn-success btn-lg">Exportar tabla a Excel</a>
        <a href="actualizar_estado.php" class="btn btn-warning btn-lg">Actualizar estados</a>
        <a href="actualizarFechas.php" class="btn btn-danger btn-lg">Actualizar fecha suspensión</a>
        <a href="cartera_por_cobrar.php" class="btn btn-danger btn-lg">Cartera por cobrar</a>
        <a href="cartera_vencida.php" class="btn btn-danger btn-lg">Cartera Vencida</a>
        <a href="cartera_pagada.php" class="btn btn-success btn-lg">Cartera Pagada</a>

        <?php
        require_once __DIR__ . '/../../config/db.php';

        $sql = "
        SELECT 
            c.idCliente,
            c.documentoCliente,
            c.nombreCliente,
            c.creado,
            p.nombrePlan,
            p.precioPlan,
            f.idFactura,
            f.estadoFactura,
            f.fechaVencimiento,
            f.fechaSuspencion,
            c.meses_gracia
        FROM cliente c
        LEFT JOIN (
            SELECT f1.*
            FROM factura f1
            INNER JOIN (
                SELECT cliente_idCliente, MAX(fechaFactura) AS ultimaFactura
                FROM factura
                GROUP BY cliente_idCliente
            ) f2 ON f1.cliente_idCliente = f2.cliente_idCliente AND f1.fechaFactura = f2.ultimaFactura
        ) f ON c.idCliente = f.cliente_idCliente
        LEFT JOIN plan p ON f.idPlan = p.idPlan
        WHERE c.estadoCliente = 'Activo'
        ORDER BY c.nombreCliente ASC;
        ";

        echo '<div class="table-responsive mt-3">
                <table class="table table-hover">
                <thead class="table-light">
                  <tr>
                    <th>Id</th>
                    <th>Nombre Cliente</th>
                    <th>Plan</th>
                    <th>Valor del Plan</th>
                    <th>Fecha Límite de Pago</th>
                    <th>Fecha Suspensión</th>
                    <th>Estado Factura</th>
                    <th>Estado de Pago</th>
                    <th>Ver Factura</th>
                    <th>Historial</th>
                  </tr>
                </thead>
                <tbody>';

        if ($rta = $con->query($sql)) {
            if ($rta->num_rows === 0) {
                echo "<tr><td colspan='10' class='text-center'>No hay clientes activos.</td></tr>";
            } else {
                $hoy = strtotime(date('Y-m-d'));

                while ($row = $rta->fetch_assoc()) {
                    $dc = $row['documentoCliente'];
                    $nomc = $row['nombreCliente'];
                    $plan = $row['nombrePlan'] ?? 'Sin plan';
                    $idFactura = $row['idFactura'];
                    $valor = isset($row['precioPlan']) ? number_format($row['precioPlan'], 0, ',', '.') : '-';
                    $vence = $row['fechaVencimiento'] ?? '-';
                    $susp = $row['fechaSuspencion'] ?? '-';
                    $estadoF = $row['estadoFactura'] ?? '-';
                    $mesesGracia = (int)($row['meses_gracia'] ?? 0);
                    $fechaCreacion = $row['creado'] ?? null;

                    $vencimiento = $row['fechaVencimiento'] ? strtotime($row['fechaVencimiento']) : null;
                    $suspension = $row['fechaSuspencion'] ? strtotime($row['fechaSuspencion']) : null;

                    // === CÁLCULO DE PERIODO DE GRACIA ===
                    $enPeriodoDeGracia = false;
                    if ($mesesGracia > 0 && !empty($fechaCreacion)) {
                        $fechaFinGraciaStr = date('Y-m-d', strtotime($fechaCreacion . " +{$mesesGracia} months"));
                        $fechaFinGracia = strtotime($fechaFinGraciaStr);
                        if ($hoy <= $fechaFinGracia) {
                            $enPeriodoDeGracia = true;
                        }
                    }

                    // === LÓGICA DE ESTADO (solo 4 palabras) ===
                    if ($enPeriodoDeGracia) {
                        $estadoPago = 'gratis';
                        $colorPago = 'blue';
                    } elseif ($vencimiento && $hoy < $vencimiento) {
                        $estadoPago = 'pagada';
                        $colorPago = 'green';
                    } elseif ($vencimiento && $suspension && $hoy >= $vencimiento && $hoy <= $suspension) {
                        $estadoPago = 'pendiente';
                        $colorPago = 'orange';
                    } elseif ($suspension && $hoy > $suspension) {
                        $estadoPago = 'vencida';
                        $colorPago = 'red';
                    } else {
                        $estadoPago = 'pendiente';
                        $colorPago = 'orange';
                    }

                    echo "<tr>
                            <td>$dc</td>
                            <td>$nomc</td>
                            <td>$plan</td>
                            <td>$valor</td>
                            <td>$vence</td>
                            <td>$susp</td>
                            <td>$estadoF</td>
                            <td>
                                <span style='
                                    display:inline-block;
                                    width:15px;
                                    height:15px;
                                    background-color:$colorPago;
                                    border-radius:50%;
                                    margin-right:8px;
                                '></span>
                                <strong style='color:$colorPago; text-transform:capitalize;'>$estadoPago</strong>
                            </td>
                            <td>";

                    if ($idFactura) {
                        echo "<a href='verfacturaAdmin.php?id=$idFactura' class='btn btn-info btn-sm'>Ver factura</a>";
                    } else {
                        echo "Sin factura";
                    }

                    echo "</td>
                          <td><a href='facturas_antiguasXcli.php?idCliente={$row['idCliente']}' class='btn btn-warning btn-sm'>Ver historial</a></td>
                          </tr>";
                }
            }
        } else {
            echo "<tr><td colspan='10' class='text-center text-danger'>Error en la consulta: " . $con->error . "</td></tr>";
        }

        echo '</tbody></table></div>';
        ?>
      </div>
    </div>
  </div>
</div>
</body>
</html>
