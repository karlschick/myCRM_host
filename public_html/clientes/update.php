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

// Campos relacionados con la factura
$fechaFactura      = $_POST['fechaFactura'] ?? null;
$fechaVencimiento  = $_POST['fechaVencimiento'] ?? null;
$fechaSuspencion   = $_POST['fechaSuspencion'] ?? null;
$estadoFactura     = $_POST['estadoFactura'] ?? null;

// --- Calcular automáticamente fecha de suspensión si no viene del formulario ---
if (!$fechaSuspencion && $fechaVencimiento) {
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

    // Si hay cliente válido y datos de factura
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
            // ✅ Actualizar factura existente
            $idFactura = $factura['idFactura'];

            $sqlUpdateFactura = "
                UPDATE factura 
                SET 
                    fechaFactura = " . ($fechaFactura ? "'$fechaFactura'" : "fechaFactura") . ",
                    fechaVencimiento = " . ($fechaVencimiento ? "'$fechaVencimiento'" : "fechaVencimiento") . ",
                    fechaSuspencion = " . ($fechaSuspencion ? "'$fechaSuspencion'" : "fechaSuspencion") . ",
                    estadoFactura = " . ($estadoFactura ? "'$estadoFactura'" : "estadoFactura") . "
                WHERE idFactura = '$idFactura';
            ";
            mysqli_query($con, $sqlUpdateFactura);

        } else {
            // ⚠️ Si no existe factura, la creamos
            if ($fechaFactura && $fechaVencimiento && $estadoFactura) {
                $sqlInsertFactura = "
                    INSERT INTO factura (cliente_idCliente, idPlan, fechaFactura, fechaVencimiento, fechaSuspencion, estadoFactura)
                    VALUES ('$idCliente', '$plan', '$fechaFactura', '$fechaVencimiento', '$fechaSuspencion', '$estadoFactura');
                ";
                mysqli_query($con, $sqlInsertFactura);
            }
        }
    }

    // Redirigir con mensaje
    echo "<script>
        alert('Datos actualizados correctamente, incluyendo fecha de suspensión.');
        window.location='tablas.php';
    </script>";

} else {
    echo "<script>
        alert('Error al actualizar los datos del cliente.');
        window.history.back();
    </script>";
}
?>
