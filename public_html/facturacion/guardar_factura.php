<?php
session_start();
if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}
require_once __DIR__ . '/../../config/db.php';

$idCliente   = intval($_POST['idCliente']);
$fecha       = $_POST['fecha'];
$idPlan      = intval($_POST['idPlan']);
$subTotal    = floatval($_POST['subTotal']);
$impuesto    = floatval($_POST['impuestoTotal']);
$total       = floatval($_POST['valorTotalFactura']);
$estado      = $_POST['estadoFactura'];

// Definir fechas (puedes ajustar las reglas)
$fechaVenc   = date('Y-m-d', strtotime($fecha . ' +15 days'));
$fechaSusp   = date('Y-m-d', strtotime($fecha . ' +20 days'));

$sql = "INSERT INTO factura 
        (fechaFactura, subTotal, impuestoTotal, valorTotalFactura, estadoFactura, cliente_idCliente, idPlan, fechaVencimiento, fechaSuspencion, estadoManual) 
        VALUES 
        ('$fecha','$subTotal','$impuesto','$total','$estado',$idCliente,$idPlan,'$fechaVenc','$fechaSusp',1)";

if ($con->query($sql)) {
    header("Location: facturas_antiguas.php?idCliente=$idCliente");
    exit;
} else {
    echo "Error: " . $con->error;
}
