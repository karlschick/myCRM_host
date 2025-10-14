<?php
// Seguridad de sesiones
session_start();
error_reporting(0);

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';
?>

<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h1 style="font-size: 32px;">FACTURAS EN MORA</h1>
    </div>

    <div class="card">
      <div class="card-body">
        <a href="facturas.php" class="btn btn-secondary btn-lg">Volver a todas las facturas</a>

        <?php
        // Consulta solo facturas vencidas o pendientes fuera de plazo
        $sql = "
        SELECT 
            c.idCliente,
            c.documentoCliente,
            c.nombreCliente,
            p.nombrePlan,
            p.precioPlan,
            f.idFactura,
            f.estadoFactura,
            f.fechaVencimiento,
            f.fechaSuspencion
        FROM cliente c
        INNER JOIN factura f ON c.idCliente = f.cliente_idCliente
        LEFT JOIN plan p ON f.idPlan = p.idPlan
        WHERE 
            (
                f.estadoFactura = 'Vencida' 
                OR (f.estadoFactura = 'Pendiente' AND f.fechaVencimiento < CURDATE())
            )
            AND c.estadoCliente = 'Activo'
        ORDER BY f.fechaVencimiento ASC;
        ";

        echo '<div class="table-responsive mt-3">
                <table class="table table-hover">
                <thead class="table-light">
                  <tr>
                    <th>Documento Cliente</th>
                    <th>Nombre Cliente</th>
                    <th>Plan</th>
                    <th>Valor del Plan</th>
                    <th>Fecha Límite de Pago</th>
                    <th>Fecha de Suspensión</th>
                    <th>Estado Factura</th>
                    <th>Estado de Pago</th>
                    <th>Ver Factura</th>
                    <th>Historial</th>
                  </tr>
                </thead>
                <tbody>';

        $rta = $con->query($sql);
        if ($rta && $rta->num_rows > 0) {
            while ($row = $rta->fetch_assoc()) {
                $dc = htmlspecialchars($row['documentoCliente']);
                $nomc = htmlspecialchars($row['nombreCliente']);
                $plan = htmlspecialchars($row['nombrePlan'] ?? 'Sin plan');
                $idFactura = $row['idFactura'];
                $valor = isset($row['precioPlan']) ? number_format($row['precioPlan'], 0, ',', '.') : '-';
                $vence = htmlspecialchars($row['fechaVencimiento'] ?? '-');
                $susp = htmlspecialchars($row['fechaSuspencion'] ?? 'Sin registro');
                $estadoF = htmlspecialchars($row['estadoFactura'] ?? '-');

                // Estado visual
                $estadoPago = "En mora";
                $colorPago = "red";

                echo "<tr>
                        <td>$dc</td>
                        <td>$nomc</td>
                        <td>$plan</td>
                        <td>$valor</td>
                        <td>$vence</td>
                        <td>$susp</td>
                        <td>$estadoF</td>
                        <td><span style='color:$colorPago; font-weight:bold;'>●</span> $estadoPago</td>
                        <td>";
                if ($idFactura) {
                    echo "<a href='verfacturaAdmin.php?id=$idFactura' class='btn btn-info btn-sm'>Ver factura</a>";
                } else {
                    echo "Sin factura";
                }
                echo "</td>";

                echo "<td><a href='facturas_antiguasXcli.php?idCliente={$row['idCliente']}' class='btn btn-warning btn-sm'>Ver historial</a></td>";

                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='10' class='text-center'>No hay facturas en mora.</td></tr>";
        }

        echo '</tbody></table></div>';
        ?>
      </div>
    </div>
  </div>
</div>
</body>
</html>
