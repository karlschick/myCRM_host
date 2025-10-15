<?php
session_start();
error_reporting(0);

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

include '../../includes/header.php';
include '../../includes/menu.php';
require_once __DIR__ . '/../../config/db.php';
?>

<body>
<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h1 style="font-size: 32px;">CARTERA PAGADA</h1>
    </div>

    <div class="card">
      <div class="card-body">

        <?php
        // Consultar facturas pagadas
        $sql = "
            SELECT 
                c.idCliente,
                c.nombreCliente,
                p.nombrePlan,
                p.precioPlan,
                f.estadoFactura,
                f.fechaVencimiento,
                f.fechaSuspencion
            FROM cliente c
            LEFT JOIN factura f ON c.idCliente = f.cliente_idCliente
            LEFT JOIN plan p ON c.plan_idPlan = p.idPlan
            WHERE c.estadoCliente='Activo' 
              AND f.estadoFactura='Pagada'
            ORDER BY f.fechaVencimiento ASC
        ";

        $resultado = $con->query($sql);

        $totalPagado = 0;
        echo '<div class="table-responsive mt-3">
                <table class="table table-hover">
                  <thead class="table-light">
                    <tr>
                      <th>Id Cliente</th>
                      <th>Nombre Cliente</th>
                      <th>Plan</th>
                      <th>Valor Plan</th>
                      <th>Fecha Vencimiento</th>
                      <th>Fecha Suspensión</th>
                      <th>Estado Factura</th>
                    </tr>
                  </thead>
                  <tbody>';

        if ($resultado && $resultado->num_rows > 0) {
            while ($row = $resultado->fetch_assoc()) {
                $valor = isset($row['precioPlan']) ? $row['precioPlan'] : 0;
                $totalPagado += $valor;

                echo "<tr>
                        <td>{$row['idCliente']}</td>
                        <td>{$row['nombreCliente']}</td>
                        <td>{$row['nombrePlan']}</td>
                        <td>".number_format($valor, 0, ',', '.')."</td>
                        <td>{$row['fechaVencimiento']}</td>
                        <td>{$row['fechaSuspencion']}</td>
                        <td>{$row['estadoFactura']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='7' class='text-center'>No hay facturas pagadas.</td></tr>";
        }

        echo '</tbody>
              </table>';

        echo "<h4 class='mt-4'>Total Cartera Pagada: <strong style='color:green;'>$".number_format($totalPagado, 0, ',', '.')."</strong></h4>";
        ?>

        <a href="facturas.php" class="btn btn-secondary btn-lg mt-3">Volver</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
