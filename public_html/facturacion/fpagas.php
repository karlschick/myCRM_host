<?php
// facturacion/fpagas.php
session_start();
// DEBUG: para desarrollo activa errores momentáneamente
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
                <h1 style="font-size: 32px;">FACTURAS PAGADAS</h1>
            </div>
            <div class="card">
                <div class="card-body">
                    <a href="factcliente.php" class="btn btn-danger btn-lg" role="button">Ingresar factura</a>
                    <a href="facturas.php" class="btn btn-primary btn-lg" role="button">Ver facturas pendientes</a>
                    <a href="consultarf.php" class="btn btn-primary btn-lg" role="button">Consultar facturas</a>
                    <a href="../excel/excelFactura.php" class="btn btn-success btn-lg">Exportar tabla a Excel</a>

                    <hr>

                    <?php
                    // Consulta tolerante: busca cualquier estado que contenga 'pag' (pagada, Pago, etc.)
                    $sql = "
                        SELECT 
                            c.idCliente,
                            f.cliente_idCliente,
                            c.documentoCliente,
                            c.nombreCliente,
                            f.idFactura,
                            f.valorTotalFactura,
                            f.estadoFactura,
                            f.fechaVencimiento,
                            IFNULL(p.nombrePlan, '-') AS nombrePlan
                        FROM cliente c
                        INNER JOIN factura f ON c.idCliente = f.cliente_idCliente
                        LEFT JOIN plan p ON f.idPlan = p.idPlan
                        WHERE LOWER(f.estadoFactura) LIKE '%pag%'
                        ORDER BY f.fechaVencimiento ASC;
                    ";

                    // Ejecutar consulta
                    $rta = $con->query($sql);

                    // Mostrar tabla
                    echo '<div class="table-responsive"><table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Documento Cliente</th>
                                <th>Nombre Cliente</th>
                                <th>Fecha límite de pago</th>
                                <th>Valor Total</th>
                                <th>Estado factura</th>
                                <th>Plan</th>
                                <th>Ver</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>';

                    if ($rta === false) {
                        // Error SQL
                        echo '<tr><td colspan="8" class="text-danger">Error en la consulta: ' . htmlspecialchars($con->error) . '</td></tr>';
                    } elseif ($rta->num_rows === 0) {
                        echo '<tr><td colspan="8" class="text-center">No se encontraron facturas que coincidan con "pag".</td></tr>';
                    } else {
                        while ($row = $rta->fetch_assoc()) {
                            $dc = htmlspecialchars($row['documentoCliente']);
                            $nomc = htmlspecialchars($row['nombreCliente']);
                            $idf = (int)$row['idFactura'];
                            $st = number_format($row['valorTotalFactura'], 0, ',', '.');
                            $estf = htmlspecialchars($row['estadoFactura']);
                            $ffact = htmlspecialchars($row['fechaVencimiento']);
                            $nplan = htmlspecialchars($row['nombrePlan']);

                            echo "<tr>
                                    <td>{$dc}</td>
                                    <td>{$nomc}</td>
                                    <td>{$ffact}</td>
                                    <td>\${$st}</td>
                                    <td>{$estf}</td>
                                    <td>{$nplan}</td>
                                    <td><a href='verfacturaAdmin.php?id={$idf}' class='btn btn-info btn-sm'>Ver factura</a></td>
                                    <td><a href='pend.php?id={$idf}' class='btn btn-warning btn-sm'>Regresar a pendiente</a></td>
                                  </tr>";
                        }
                    }

                    echo '</tbody></table></div>';
                    ?>

                </div>
            </div>
        </div>
    </div>
</body>
</html>
