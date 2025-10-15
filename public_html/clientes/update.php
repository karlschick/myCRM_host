<?php
// Conexión a base de datos
require_once __DIR__ . '/../../config/db.php';

// --- Recibir datos del formulario ---
$td         = $_POST['td'];
$id         = $_POST['id'];
$nombres    = $_POST['nombre'];
$telefono   = $_POST['tel'];
$email      = $_POST['email'];
$dir        = $_POST['dir'];
$estado     = $_POST['estado'];
$plan       = $_POST['plan'];
$creacion   = $_POST['creacion'];
$act        = $_POST['act'];
$mesesGracia = $_POST['gracia'] ?? 0; // Nuevo campo

// Campos relacionados con la factura
$fechaFactura      = $_POST['fechaFactura'] ?? '';
$fechaVencimiento  = $_POST['fechaVencimiento'] ?? '';
$fechaSuspencion   = $_POST['fechaSuspencion'] ?? '';
$estadoFactura     = $_POST['estadoFactura'] ?? 'Pendiente';

// --- Lógica automática de fechas ---
// Si no hay fecha de vencimiento, se coloca un mes después de fechaFactura
if (empty($fechaVencimiento) && !empty($fechaFactura)) {
    $fechaVencimiento = date('Y-m-d', strtotime($fechaFactura . ' +1 month'));
}

// Si no hay fecha de suspensión, se coloca 5 días después de fechaVencimiento
if (empty($fechaSuspencion) && !empty($fechaVencimiento)) {
    $fechaSuspencion = date('Y-m-d', strtotime($fechaVencimiento . ' +5 days'));
}

// --- Actualizar datos del cliente ---
$sqlCliente = "
    UPDATE cliente 
    SET  
        tipoDocumento = '$td',
        documentoCliente = '$id',
        nombreCliente = '$nombres',
        telefonoCliente = '$telefono',
        correoCliente = '$email',
        direccion = '$dir',
        estadoCliente = '$estado',
        plan_idPlan = '$plan',
        meses_gracia = '$mesesGracia',
        creado = '$creacion',
        ultimaActualizacion = '$act'
    WHERE documentoCliente = '$id';
";
$queryCliente = mysqli_query($con, $sqlCliente);

// --- Si el cliente se actualizó correctamente ---
if ($queryCliente) {

    // Buscar el ID del cliente
    $sqlIdCliente = "SELECT idCliente FROM cliente WHERE documentoCliente = '$id' LIMIT 1;";
    $result = mysqli_query($con, $sqlIdCliente);
    $row = mysqli_fetch_assoc($result);
    $idCliente = $row['idCliente'] ?? null;

    if ($idCliente) {
        // Buscar la última factura del cliente
        $sqlUltimaFactura = "
            SELECT idFactura 
            FROM factura 
            WHERE cliente_idCliente = '$idCliente'
            ORDER BY idFactura DESC
            LIMIT 1;
        ";
        $resFactura = mysqli_query($con, $sqlUltimaFactura);
        $factura = mysqli_fetch_assoc($resFactura);

        if ($factura) {
            // Actualizar factura existente
            $idFactura = $factura['idFactura'];

            $sqlUpdateFactura = "
                UPDATE factura 
                SET 
                    fechaFactura = '$fechaFactura',
                    fechaVencimiento = '$fechaVencimiento',
                    fechaSuspencion = '$fechaSuspencion',
                    estadoFactura = '$estadoFactura'
                WHERE idFactura = '$idFactura';
            ";
            mysqli_query($con, $sqlUpdateFactura);

        } else {
            // Crear nueva factura si no existe
            if (!empty($fechaFactura) && !empty($fechaVencimiento)) {
                $sqlInsertFactura = "
                    INSERT INTO factura (cliente_idCliente, idPlan, fechaFactura, fechaVencimiento, fechaSuspencion, estadoFactura)
                    VALUES ('$idCliente', '$plan', '$fechaFactura', '$fechaVencimiento', '$fechaSuspencion', '$estadoFactura');
                ";
                mysqli_query($con, $sqlInsertFactura);
            }
        }
    }

    // Obtener info actualizada del cliente y plan
    $sqlInfo = "
        SELECT c.nombreCliente, p.nombrePlan
        FROM cliente c
        LEFT JOIN plan p ON c.plan_idPlan = p.idPlan
        WHERE c.documentoCliente = '$id'
        LIMIT 1;
    ";
    $resInfo = mysqli_query($con, $sqlInfo);
    $info = mysqli_fetch_assoc($resInfo);

    $nombreClienteMostrar = $info['nombreCliente'] ?? 'Cliente desconocido';
    $nombrePlanMostrar = $info['nombrePlan'] ?? 'Sin plan';

    echo "<script>
        alert('Datos actualizados correctamente.\\nCliente: $nombreClienteMostrar\\nPlan: $nombrePlanMostrar');
        window.location='tablas.php';
    </script>";

} else {
    echo "<script>
        alert('Error al actualizar los datos del cliente.');
        window.history.back();
    </script>";
}
?>
