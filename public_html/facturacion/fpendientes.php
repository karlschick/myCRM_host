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
      <h1 style="font-size: 32px;">FACTURAS PENDIENTES</h1>
    </div>

    <div class="card">
      <div class="card-body">
        <a href="facturas.php" class="btn btn-secondary btn-lg mb-3">Volver a Gestión de Facturas</a>

        <?php
        require_once __DIR__ . '/../../config/db.php';

        // Consultar todas las facturas pendientes
        $sql = "
        SELECT 
            f.idFactura,
            c.documentoCliente,
            c.nombreCliente,
            p.nombrePlan,
            p.precioPlan,
            f.fechaFactura,
            f.fechaVencimiento,
            f.fechaSuspencion,
            f.estadoFactura
        FROM factura f
        INNER JOIN cliente c ON f.cliente_idCliente = c.idCliente
        LEFT JOIN plan p ON f.idPlan = p.idPlan
        WHERE f.estadoFactura = 'Pendiente'
        ORDER BY f.fechaVencimiento ASC;
        ";

        echo '<div class="table-responsive mt-3">
                <table class="table table-hover">
                <thead class="table-light">
                  <tr>
                    <th># Factura</th>
                    <th>Documento Cliente</th>
                    <th>Nombre Cliente</th>
                    <th>Plan</th>
                    <th>Valor</th>
                    <th>Fecha Emisión</th>
                    <th>Fecha Vencimiento</th>
                    <th>Fecha Suspensión</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                  </tr>
                </thead>
                <tbody>';

        if ($rta = $con->query($sql)) {
            if ($rta->num_rows === 0) {
                echo "<tr><td colspan='10' class='text-center'>No hay facturas pendientes.</td></tr>";
            } else {
                while ($row = $rta->fetch_assoc()) {
                    $idFactura = $row['idFactura'];
                    $dc = $row['documentoCliente'];
                    $nomc = $row['nombreCliente'];
                    $plan = $row['nombrePlan'] ?? 'Sin plan';
                    $valor = isset($row['precioPlan']) ? number_format($row['precioPlan'], 0, ',', '.') : '-';
                    $fechaEmi = $row['fechaFactura'] ?? '-';
                    $fechaVen = $row['fechaVencimiento'] ?? '-';
                    $fechaSusp = $row['fechaSuspencion'] ?? '-';
                    $estado = $row['estadoFactura'];

                    // === Asignar color según el estado ===
                    $colorEstado = "orange"; // Por defecto (Pendiente)
                    $textoEstado = $estado;

                    if ($estado === "Pagada") {
                        $colorEstado = "green";
                    } elseif ($estado === "Vencida" || $estado === "En mora") {
                        $colorEstado = "red";
                    } elseif ($estado === "Gratis") {
                        $colorEstado = "gray";
                    } elseif ($estado === "Anulada") {
                        $colorEstado = "gray";
                    }

                    echo "<tr>
                            <td>$idFactura</td>
                            <td>$dc</td>
                            <td>$nomc</td>
                            <td>$plan</td>
                            <td>$valor</td>
                            <td>$fechaEmi</td>
                            <td>$fechaVen</td>
                            <td>$fechaSusp</td>
                            <td>
                              <span style='color:$colorEstado; font-weight:bold;'>●</span> 
                              <span style='color:$colorEstado; font-weight:bold;'>$textoEstado</span>
                            </td>
                            <td>
                                <a href='verfacturaAdmin.php?id=$idFactura' class='btn btn-info btn-sm'>Ver</a>
                            </td>
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
