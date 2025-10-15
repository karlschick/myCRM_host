<?php
require_once __DIR__ . '/../../config/db.php';

// Si el usuario ya confirmó la acción
if (isset($_GET['confirm']) && $_GET['confirm'] === '1') {

    $actualizadas = 0;

    // Buscar facturas activas (Pendientes, Vencidas, Gratis, Pagadas)
    $sql = "SELECT idFactura, fechaVencimiento, fechaSuspencion
            FROM factura
            WHERE estadoFactura IN ('Pendiente', 'Vencida', 'Gratis', 'Pagada')
            AND fechaVencimiento IS NOT NULL";

    $res = $con->query($sql);

    if ($res && $res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $idFactura = $row['idFactura'];
            $fechaVencimiento = $row['fechaVencimiento'];

            // Nueva fecha de suspensión = fecha de vencimiento + 5 días
            $nuevaFechaSuspension = date('Y-m-d', strtotime($fechaVencimiento . ' +5 days'));

            // Actualizar solo si cambió
            if ($nuevaFechaSuspension !== $row['fechaSuspencion']) {
                $sqlUpdate = "UPDATE factura 
                              SET fechaSuspencion = ? 
                              WHERE idFactura = ?";
                $stmt = $con->prepare($sqlUpdate);
                $stmt->bind_param("si", $nuevaFechaSuspension, $idFactura);
                if ($stmt->execute()) {
                    $actualizadas++;
                }
            }
        }
    }

    echo "<script>
        alert('Se actualizaron $actualizadas fechas de suspensión correctamente.');
        window.location='facturas.php';
    </script>";

    $con->close();
    exit;
}
?>

<!-- ================= HTML DE CONFIRMACIÓN ================= -->
<script>
    if (confirm("¿Está seguro de que desea actualizar las fechas de suspensión?")) {
        // Si el usuario acepta, recarga la página con confirmación
        window.location.href = "actualizarFechas.php?confirm=1";
    } else {
        // Si cancela, regresa a facturas
        window.location.href = "facturas.php";
    }
</script>
