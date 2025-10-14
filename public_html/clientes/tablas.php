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

                // Consulta: cliente + plan + última factura (incluye fechaSuspencion)
                $sql = "
                    SELECT 
                        c.idCliente,
                        c.tipoDocumento,
                        c.documentoCliente,
                        c.nombreCliente,
                        p.nombrePlan,
                        f.estadoFactura,
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
                              <th>Tipo identificación</th>
                              <th>Número de documento</th>
                              <th>Nombres</th>
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
                            $estadoFactura = $row['estadoFactura'] ?? 'Pendiente';
                            $fechaVencimiento = $row['fechaVencimiento'];
                            $fechaSuspencion = $row['fechaSuspencion'];

                            $vencimiento = $fechaVencimiento ? strtotime($fechaVencimiento) : null;
                            $suspension = $fechaSuspencion ? strtotime($fechaSuspencion) : null;

                            // === Lógica mejorada de estado de pago ===
                            if ($estadoFactura === "Pagada") {
                                $estadoPago = "Pagado";
                                $colorPago = "green";
                            } elseif ($estadoFactura === "Gratis") {
                                $estadoPago = "Gratis";
                                $colorPago = "blue";
                            } elseif ($estadoFactura === "Pendiente") {
                                if ($vencimiento && $hoy <= $vencimiento) {
                                    // Antes del vencimiento
                                    $estadoPago = "Pendiente";
                                    $colorPago = "green";
                                } elseif ($vencimiento && $hoy > $vencimiento && $suspension && $hoy <= $suspension) {
                                    // Entre vencimiento y suspensión
                                    $estadoPago = "Pendiente";
                                    $colorPago = "orange";
                                } elseif ($suspension && $hoy > $suspension) {
                                    // Pasó la fecha de suspensión
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
                                    $estadoPago = "Pendiente";
                                    $colorPago = "orange";
                                }
                            } elseif ($estadoFactura === "Anulada") {
                                $estadoPago = "Sin factura válida";
                                $colorPago = "gray";
                            } else {
                                $estadoPago = "Sin registro";
                                $colorPago = "gray";
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
                                        <strong style='color:$colorPago'>$estadoPago</strong>
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
