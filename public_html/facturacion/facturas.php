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


        <?php
        require_once __DIR__ . '/../../config/db.php';

        // Consulta todos los clientes con su última factura (ahora incluyendo fechaSuspencion)
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
                    <th>Documento Cliente</th>
                    <th>Nombre Cliente</th>
                    <th>Plan</th>
                    <th>Valor del Plan</th>
                    <th>Fecha Límite de Pago</th>
                    <th>Fecha Suspención</th>
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
                while ($row = $rta->fetch_assoc()) {
                    $dc = $row['documentoCliente'];
                    $nomc = $row['nombreCliente'];
                    $plan = $row['nombrePlan'] ?? 'Sin plan';
                    $idFactura = $row['idFactura'];
                    $valor = isset($row['precioPlan']) ? number_format($row['precioPlan'], 0, ',', '.') : '-';
                    $vence = $row['fechaVencimiento'] ?? '-';
                    $susp = $row['fechaSuspencion'] ?? '-';
                    $estadoF = $row['estadoFactura'] ?? '-';

                    // === Determinar Estado de Pago ===
     // === Nueva lógica de Estado de Pago ===
                $estadoPago = "Sin registro";
                $colorPago = "gray";

                $hoy = strtotime(date('Y-m-d'));
                $vence = $row['fechaVencimiento'] ? strtotime($row['fechaVencimiento']) : null;

                if ($estadoF === "Pagada") {
                    $estadoPago = "Al día";
                    $colorPago = "green";

                } elseif ($estadoF === "Gratis") {
                    $estadoPago = "Gratis";
                    $colorPago = "blue";

                } elseif ($estadoF === "Pendiente") {
                    if ($vence && $vence >= $hoy) {
                        // Si la fecha límite aún no llega → cliente al día
                        $estadoPago = "Al día";
                        $colorPago = "green";
                    } elseif ($vence && $vence < $hoy) {
                        // Si ya pasó la fecha límite → en mora
                        $estadoPago = "En mora";
                        $colorPago = "red";
                    } else {
                        // Sin fecha → pendiente sin definir
                        $estadoPago = "Pendiente";
                        $colorPago = "orange";
                    }

                } elseif ($estadoF === "Vencida") {
                    $estadoPago = "En mora";
                    $colorPago = "red";

                } elseif ($estadoF === "Anulada") {
                    $estadoPago = "Sin factura válida";
                    $colorPago = "gray";
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
                              <span style='color:$colorPago; font-weight:bold;'>●</span> 
                              $estadoPago
                            </td>
                            <td>";
                    if ($idFactura) {
                        echo "<a href='verfacturaAdmin.php?id=$idFactura' class='btn btn-info btn-sm'>Ver factura</a>";
                    } else {
                        echo "Sin factura";
                    }
                    echo "</td>";

                    // Botón para ver historial del cliente
                    echo "<td><a href='facturas_antiguasXcli.php?idCliente={$row['idCliente']}' class='btn btn-warning btn-sm'>Ver historial</a></td>";

                    echo "</tr>";
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
