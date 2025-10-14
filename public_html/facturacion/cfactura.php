<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
            <div class="card">
                <div class="card-body">
                    <a href="facturas.php" class="btn btn-primary btn-lg active" role="button">Volver a facturas</a>
                    <?php
                    require_once __DIR__ . '/../../config/db.php';

                    // Recibir el documento del cliente (POST o GET)
                    $dc = isset($_REQUEST['id']) ? $_REQUEST['id'] : '';

                    // Consulta con JOIN al plan
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
                            p.nombrePlan AS nplan
                        FROM cliente c
                        INNER JOIN factura f ON c.idCliente = f.cliente_idCliente
                        LEFT JOIN plan p ON f.idPlan = p.idPlan
                        WHERE c.documentoCliente = '$dc'
                        ORDER BY f.fechaVencimiento DESC;
                    ";

                    echo '<div class="table-responsive">
                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Documento Cliente</th>
                                <th>Nombre Cliente</th>
                                <th>Fecha Límite de Pago</th>
                                <th>Valor Total</th>
                                <th>Estado Factura</th>
                                <th>Plan</th>
                                <th>Consultas</th>
                                <th>Volver a Pago</th>
                                <th>Editar</th>
                            </tr>
                        </thead>
                        <tbody>';

                    if ($rta = $con->query($sql)) {
                        if ($rta->num_rows === 0) {
                            echo '<tr><td colspan="9" class="text-center">No se encontraron facturas para este cliente.</td></tr>';
                        } else {
                            while ($row = $rta->fetch_assoc()) {
                                $dc = $row['documentoCliente'];
                                $nomc = $row['nombreCliente'];
                                $if = $row['idFactura'];
                                $st = $row['valorTotalFactura'];
                                $estf = $row['estadoFactura'];
                                $ffact = $row['fechaVencimiento'];
                                $nplan = $row['nplan'];
                    ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($dc); ?></td>
                                    <td><?php echo htmlspecialchars($nomc); ?></td>
                                    <td><?php echo htmlspecialchars($ffact); ?></td>
                                    <td>$<?php echo number_format($st, 0, ',', '.'); ?></td>
                                    <td><?php echo htmlspecialchars($estf); ?></td>
                                    <td><?php echo htmlspecialchars($nplan); ?></td>

                                    <td><a href="verfacturaAdmin.php?id=<?php echo $if ?>" class="btn btn-info btn-sm">Ver Factura</a></td>
                                    <td><a href="eliminarf.php?id=<?php echo $if ?>" class="btn btn-danger btn-sm">Pago</a></td>
                                    <td><a href="editfactura.php?if=<?php echo $if ?>" class="btn btn-primary btn-sm">Editar Factura</a></td>
                                </tr>
                    <?php
                            }
                        }
                    } else {
                        echo '<tr><td colspan="9" class="text-danger">Error en la consulta: ' . $con->error . '</td></tr>';
                    }

                    echo '</tbody></table></div>';
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
