<?php
// Incluye el encabezado de la página
include '../../includes/header.php';
?>

<body>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card">
                <div class="card-body">
                    <div class="text-center w-100">
                        <img class="logo d-block mx-auto mb-3" src="../assets/images/empresa/logoEmpresa.png"
                            alt="logo" style="max-width: 40%; height: auto;" />

                        <a href="consultarfC.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">
                            Volver a facturas
                        </a>
                    </div>
                </div>

                <?php
                require_once __DIR__ . '/../../config/db.php';
                $dc = $_POST['id'];

                // Consulta corregida: unimos la tabla plan para obtener el nombre del plan
                $sql = "SELECT 
                            cliente.idCliente, 
                            factura.cliente_idCliente, 
                            cliente.documentoCliente, 
                            cliente.nombreCliente, 
                            factura.idFactura, 
                            factura.valorTotalFactura, 
                            factura.estadoFactura, 
                            factura.fechaVencimiento,
                            plan.nombrePlan AS nplan
                        FROM cliente
                        INNER JOIN factura ON cliente.idCliente = factura.cliente_idCliente
                        LEFT JOIN plan ON factura.idPlan = plan.idPlan
                        WHERE cliente.documentoCliente = '$dc' 
                          AND factura.estadoFactura != 'Archivada'";

                $rta = $con->query($sql);

                if ($rta && $rta->num_rows > 0) {
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
                                </tr>
                            </thead>
                            <tbody>';

                    while ($row = $rta->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars($row['documentoCliente']) ?></td>
                            <td><?= htmlspecialchars($row['nombreCliente']) ?></td>
                            <td><?= htmlspecialchars($row['fechaVencimiento']) ?></td>
                            <td><?= htmlspecialchars($row['valorTotalFactura']) ?></td>
                            <td><?= htmlspecialchars($row['estadoFactura']) ?></td>
                            <td><?= htmlspecialchars($row['nplan'] ?? 'Sin Plan') ?></td>
                            <td>
                                <a href="verfacturaClie.php?id=<?= $row['idFactura'] ?>" class="btn btn-info">Ver Factura</a>
                            </td>
                            <td>
                                <a href="pago.php?id=<?= $row['idFactura'] ?>" class="btn btn-success">Pagar</a>
                            </td>
                        </tr>
                        <?php
                    }

                    echo '</tbody></table></div>';
                } else {
                    echo "<div class='text-center mt-4'>
                            <h3>✅ Usted está al día, estimado cliente.</h3>
                            <p>No hay facturas pendientes de pago.</p>
                          </div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
