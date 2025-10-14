<?php
require_once __DIR__ . '/../../config/db.php';

$td        = $_POST['td'];
$doc       = $_POST['id'];
$nombres   = $_POST['nombre'];
$telefono  = $_POST['tel'];
$email     = $_POST['email'];
$direccion = $_POST['dir'];
$estado    = $_POST['estado'];
$plan      = $_POST['plan']; 
$creacion  = $_POST['creacion'];
$act       = $_POST['act'];

$tipoCobro   = $_POST['tipoCobro'];
$mesesGracia = (int) $_POST['gracia'];

// Verificar si el documento ya existe
$sql_verificar = "SELECT * FROM cliente WHERE documentoCliente = '$doc'";
$resultado = $con->query($sql_verificar);

if ($resultado->num_rows > 0) {
    echo '<script>alert("El documento ya está en uso."); window.history.back();</script>';
    exit;
}

// Insertar cliente SIN estadoPago fijo
$sql_insertar = "INSERT INTO cliente 
(tipoDocumento, documentoCliente, nombreCliente, telefonoCliente, correoCliente, direccion, estadoCliente, plan_idPlan, creado, ultimaActualizacion) 
VALUES 
('$td', '$doc', '$nombres', '$telefono', '$email', '$direccion', '$estado', '$plan', '$creacion', '$act')";

if ($con->query($sql_insertar) === TRUE) {
    $idCliente = $con->insert_id;

    // Obtener datos del plan
    $sql_plan = "SELECT idPlan, precioPlan FROM plan WHERE idPlan = '$plan' LIMIT 1";
    $res_plan = $con->query($sql_plan);

    if ($res_plan && $res_plan->num_rows > 0) {
        $rowPlan = $res_plan->fetch_assoc();
        $idPlan = $rowPlan['idPlan'];
        $precioPlan = $rowPlan['precioPlan'];

        // Fechas
        $fechaFactura = date('Y-m-d');
        $fechaVencimiento = date('Y-m-d', strtotime("+30 days"));
        $fechaSuspencion  = date('Y-m-d', strtotime($fechaVencimiento . " +5 days"));

        // Valores de factura
        $valor = $precioPlan;
        $estadoFactura = 'Pendiente';

        // Meses de gracia
        if ($mesesGracia > 0) {
            $valor = 0;
            $estadoFactura = 'Gratis';
            $fechaVencimiento = date('Y-m-d', strtotime("+$mesesGracia month"));
            $fechaSuspencion  = date('Y-m-d', strtotime($fechaVencimiento . " +5 days"));
        }

        // Totales
        $subTotal = $valor;
        $impuestoTotal = 0;
        $valorTotalFactura = $valor;

        // Insertar factura
        $sql_factura = "INSERT INTO factura 
        (fechaFactura, impuestoTotal, subTotal, valorTotalFactura, estadoFactura, cliente_idCliente, idPlan, fechaVencimiento, fechaSuspencion) 
        VALUES 
        ('$fechaFactura', '$impuestoTotal', '$subTotal', '$valorTotalFactura', '$estadoFactura', '$idCliente', '$idPlan', '$fechaVencimiento', '$fechaSuspencion')";

        if ($con->query($sql_factura) !== TRUE) {
            echo "Error al generar la primera factura: " . $con->error;
            exit;
        }
    }

    echo '<script>alert("Cliente y primera factura creados correctamente."); window.location="tablas.php";</script>';

} else {
    echo "Error al guardar cliente: " . $con->error;
}

$con->close();
?>
