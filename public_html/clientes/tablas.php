<?php
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
            <h1 style="font-size: 32px;">GESTIÓN CLIENTES</h1>
        </div>

        <div class="card">
            <div class="card-body">
                <a href="ingresar.php" class="btn btn-primary btn-lg">Crear nuevo cliente</a>
                <a href="consuCliente.php" class="btn btn-primary btn-lg">Consultar cliente</a>
                <a href="../excel/excelCliente.php" class="btn btn-success btn-lg" onclick="return confirmarExportacion();">Exportar a Excel</a>
                <a href="archivados.php" class="btn btn-warning btn-lg">Ver clientes archivados</a>

                <script>
                    function confirmarExportacion() {
                        return confirm("¿Está seguro de que desea exportar la lista a Excel?");
                    }
                </script>

                <?php include '../../includes/search.php'; ?>

                <?php
                require_once __DIR__ . '/../../config/db.php';

                $sql = "
                    SELECT 
                        c.idCliente,
                        c.tipoDocumento,
                        c.documentoCliente,
                        c.nombreCliente,
                        c.creado,
                        c.meses_gracia,
                        p.nombrePlan,
                        f.estadoFactura,
                        f.fechaFactura,
                        f.fechaVencimiento,
                        f.fechaSuspencion
                    FROM cliente c
                    INNER JOIN plan p ON c.plan_idPlan = p.idPlan
                    LEFT JOIN factura f ON f.idFactura = (
                        SELECT f2.idFactura
                        FROM factura f2
                        WHERE f2.cliente_idCliente = c.idCliente
                        ORDER BY f2.idFactura DESC
                        LIMIT 1
                    )
                    WHERE c.estadoCliente = 'Activo'
                    ORDER BY c.nombreCliente ASC;
                ";

                echo '<div class="table-responsive mt-3">
                        <table class="table table-hover">
                          <thead class="table-light">
                            <tr>
                              <th>Tipo</th>
                              <th>Número</th>
                              <th>Nombre y apellido</th>
                              <th>Plan</th>
                              <th>Estado de Pago</th>
                              <th>Detalles</th>
                              <th>Actualizar</th>
                              <th>Eliminar</th>
                            </tr>
                          </thead>
                          <tbody>';

                if ($rta = $con->query($sql)) {
                    if ($rta->num_rows === 0) {
                        echo "<tr><td colspan='8' class='text-center'>No hay clientes activos.</td></tr>";
                    } else {
                        $hoy = strtotime(date('Y-m-d'));

                        while ($row = $rta->fetch_assoc()) {
                            $idCliente = $row['idCliente'];
                            $td = $row['tipoDocumento'];
                            $doc = $row['documentoCliente'];
                            $nombres = $row['nombreCliente'];
                            $plan = $row['nombrePlan'];
                            $fechaVencimiento = $row['fechaVencimiento'];
                            $fechaSuspencion = $row['fechaSuspencion'];
                            $fechaCreacion = $row['creado'];
                            $mesesGracia = (int)($row['meses_gracia'] ?? 0);

                            $vencimiento = $fechaVencimiento ? strtotime($fechaVencimiento) : null;
                            $suspension = $fechaSuspencion ? strtotime($fechaSuspencion) : null;

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
                                    <td>$td</td>
                                    <td>$doc</td>
                                    <td>$nombres</td>
                                    <td>$plan</td>
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
                                    <td><a href='vercliente.php?id=$idCliente' class='btn btn-secondary'>Ver</a></td>
                                    <td><a href='actualizar.php?id=$doc' class='btn btn-info'>Editar</a></td>
                                    <td><a href='delete.php?id=$doc' class='borrar btn btn-danger'>Eliminar</a></td>
                                  </tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='8' class='text-center text-danger'>Error al consultar los datos.</td></tr>";
                }

                echo "</tbody></table></div>";
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
