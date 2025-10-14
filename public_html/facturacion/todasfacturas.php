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
      <h1 style="font-size: 32px;">TODAS LAS FACTURAS</h1>
    </div>

    <div class="card">
      <div class="card-body">
        <a href="facturas.php" class="btn btn-light btn-lg">Volver a facturas pendientes</a>
        <a href="../excel/excelFactura.php" class="btn btn-success btn-lg">Exportar a Excel</a>

        <?php
        require_once __DIR__ . '/../../config/db.php';

        $sql = "SELECT cliente.documentoCliente,
                       cliente.nombreCliente,
                       factura.idFactura,
                       factura.valorTotalFactura,
                       factura.estadoFactura,
                       factura.fechaVencimiento,
                       factura.p.nombrePlan AS nombrePlan
                FROM cliente 
                INNER JOIN factura ON cliente.idCliente = factura.cliente_idCliente
                ORDER BY factura.fechaVencimiento DESC;";

        echo '<div class="table-responsive mt-3">
                <table class="table table-hover">
                <thead class="table-light">
                  <tr>
                    <th>Documento Cliente</th>
                    <th>Nombre Cliente</th>
                    <th>Fecha límite de pago</th>
                    <th>Valor Total</th>
                    <th>Estado factura</th>
                    <th>Plan</th>
                    <th>Ver factura</th>
                  </tr>
                </thead>
                <tbody>';

        if ($rta = $con->query($sql)) {
            if ($rta->num_rows === 0) {
                echo "<tr><td colspan='7' class='text-center'>No hay facturas registradas.</td></tr>";
            } else {
                while ($row = $rta->fetch_assoc()) {
                    $dc = $row['documentoCliente'];
                    $nomc = $row['nombreCliente'];
                    $idf = $row['idFactura'];
                    $st = $row['valorTotalFactura'];
                    $estf = $row['estadoFactura'];
                    $ffact = $row['fechaVencimiento'];
                    $nplan = $row['p.nombrePlan AS nombrePlan'];

                    echo "<tr>
                            <td>$dc</td>
                            <td>$nomc</td>
                            <td>$ffact</td>
                            <td>$st</td>
                            <td>$estf</td>
                            <td>$nplan</td>
                            <td><a href='verfacturaAdmin.php?id=$idf' class='btn btn-info'>Ver factura</a></td>
                          </tr>";
                }
            }
        } else {
            echo "<tr><td colspan='7' class='text-center text-danger'>Error en la consulta: " . $con->error . "</td></tr>";
        }

        echo '</tbody></table></div>';
        ?>
      </div>
    </div>
  </div>
</div>
</body>
</html>
