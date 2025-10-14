<?php
require_once __DIR__ . '/../../config/db.php';

// 1️⃣ Obtener todos los clientes activos
$sqlClientes = "SELECT c.idCliente, c.creado, c.plan_idPlan, p.precioPlan, p.nombrePlan 
                FROM cliente c
                INNER JOIN plan p ON c.plan_idPlan = p.idPlan
                WHERE c.estadoCliente = 'Activo'";
$rta = $con->query($sqlClientes);

if ($rta && $rta->num_rows > 0) {
    while ($cliente = $rta->fetch_assoc()) {
        $idCliente = $cliente['idCliente'];
        $fechaCreado = new DateTime($cliente['creado']);
        $hoy = new DateTime();

        // 2️⃣ Calcular meses de servicio
        $intervalo = $fechaCreado->diff($hoy);
        $mesesServicio = $intervalo->m + ($intervalo->y * 12);

        // 3️⃣ Verificar si ya se facturó este mes
        $sqlCheck = "SELECT COUNT(*) AS total FROM factura 
                     WHERE
LEFT JOIN plan p ON f.idPlan = p.idPlan cliente_idCliente = ? 
                     AND MONTH(fechaEmision) = MONTH(CURDATE())
                     AND YEAR(fechaEmision) = YEAR(CURDATE())";
        $stmt = $con->prepare($sqlCheck);
        $stmt->bind_param("i", $idCliente);
        $stmt->execute();
        $res = $stmt->get_result()->fetch_assoc();

        if ($res['total'] == 0) {
            // 4️⃣ Crear la nueva factura
            $valor = $cliente['precioPlan'];
            $nplan = $cliente['nombrePlan'];

            $sqlInsert = "INSERT INTO factura 
                          (cliente_idCliente, valorTotalFactura, estadoFactura, fechaEmision, fechaVencimiento, p.nombrePlan AS nombrePlan)
                          VALUES (?, ?, 'Pendiente', CURDATE(), DATE_ADD(CURDATE(), INTERVAL 10 DAY), ?)";
            $stmt2 = $con->prepare($sqlInsert);
            $stmt2->bind_param("ids", $idCliente, $valor, $nplan);
            $stmt2->execute();

            echo "💡 Factura generada para cliente #$idCliente ($nplan)<br>";
        } else {
            echo "✔️ Cliente #$idCliente ya tiene factura este mes<br>";
        }
    }
} else {
    echo "No hay clientes activos.";
}
?>
