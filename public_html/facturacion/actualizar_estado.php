<?php
require_once __DIR__ . '/../../config/db.php';

$sql = "SELECT c.idCliente, c.plan_idPlan
        FROM cliente c
        WHERE c.estadoCliente = 'Activo'";
$res = $con->query($sql);

$actualizados = 0;
$nuevasFacturas = 0;

if ($res && $res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
        $idCliente = $row['idCliente'];
        $idPlan = $row['plan_idPlan'];

        // Última factura del cliente
        $sqlFactura = "SELECT idFactura, estadoFactura, fechaFactura, fechaVencimiento
                       FROM factura
                       WHERE cliente_idCliente = '$idCliente'
                       ORDER BY idFactura DESC
                       LIMIT 1";
        $resFactura = $con->query($sqlFactura);

        if ($resFactura && $resFactura->num_rows > 0) {
            $fact = $resFactura->fetch_assoc();
            $idFactura = $fact['idFactura'];
            $estadoFactura = $fact['estadoFactura'];
            $fechaFactura = $fact['fechaFactura'];
            $fechaVencimiento = $fact['fechaVencimiento'];

            $nuevoEstado = $estadoFactura; // por defecto no cambiar

            // === 1️⃣ ACTUALIZAR ESTADO DE FACTURAS EXISTENTES ===
            if ($estadoFactura === "Pagada" || $estadoFactura === "Gratis") {
                $nuevoEstado = $estadoFactura; // se mantiene
            } elseif ($estadoFactura === "Anulada") {
                $nuevoEstado = "Anulada"; // se mantiene
            } else {
                if ($fechaVencimiento && strtotime($fechaVencimiento) < time()) {
                    $nuevoEstado = "Vencida";
                } else {
                    $nuevoEstado = "Pendiente";
                }
            }

            // Actualizar la factura si cambia el estado
            if ($nuevoEstado !== $estadoFactura) {
                $sqlUpdate = "UPDATE factura SET estadoFactura = ? WHERE idFactura = ?";
                $stmt = $con->prepare($sqlUpdate);
                $stmt->bind_param("si", $nuevoEstado, $idFactura);
                if ($stmt->execute()) {
                    $actualizados++;
                }
            }

            // === 2️⃣ CREAR NUEVA FACTURA SI EL CLIENTE YA PAGÓ ===
            if ($estadoFactura === "Pagada" || $estadoFactura === "Gratis") {

                // Obtener valor actual del plan
                $sqlPlan = "SELECT precioPlan FROM plan WHERE idPlan = '$idPlan' LIMIT 1";
                $resPlan = $con->query($sqlPlan);
                $valorPlan = 0;
                if ($resPlan && $resPlan->num_rows > 0) {
                    $valorPlan = $resPlan->fetch_assoc()['precioPlan'];
                }

                // Generar nuevas fechas
                $fechaBase = $fechaVencimiento ?: $fechaFactura;

                // Nueva emisión = 1 mes después del vencimiento
                $nuevaFechaEmision = date('Y-m-d', strtotime($fechaBase . ' +1 month'));

                // Nueva fecha de vencimiento = 5 días después de emisión
                $nuevaFechaVencimiento = date('Y-m-d', strtotime($nuevaFechaEmision . ' +5 days'));

                // Nueva fecha de suspensión = 5 días después del vencimiento
                $nuevaFechaSuspension = date('Y-m-d', strtotime($nuevaFechaVencimiento . ' +5 days'));

                // Verificar que no exista ya una factura en ese rango
                $sqlCheck = "SELECT idFactura FROM factura 
                             WHERE cliente_idCliente = '$idCliente' 
                             AND fechaFactura >= '$nuevaFechaEmision'
                             LIMIT 1";
                $resCheck = $con->query($sqlCheck);

                if ($resCheck && $resCheck->num_rows === 0) {
                    // Insertar nueva factura (agregando fechaSuspencion)
                    $sqlNueva = "INSERT INTO factura 
                        (cliente_idCliente, idPlan, fechaFactura, fechaVencimiento, fechaSuspencion, valorTotalFactura, estadoFactura)
                        VALUES (?, ?, ?, ?, ?, ?, 'Pendiente')";
                    $stmtNueva = $con->prepare($sqlNueva);
                    $stmtNueva->bind_param("iisssd", $idCliente, $idPlan, $nuevaFechaEmision, $nuevaFechaVencimiento, $nuevaFechaSuspension, $valorPlan);
                    if ($stmtNueva->execute()) {
                        $nuevasFacturas++;
                    }
                }
            }
        }
    }
}

echo "<script>
    alert('Se actualizaron $actualizados facturas y se generaron $nuevasFacturas nuevas con fecha de suspensión.');
    window.location='facturas.php';
</script>";

$con->close();
?>
