<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

require_once __DIR__ . '/../../config/db.php';

// Recibir datos del formulario
$idFactura         = $_POST['if'];
$idCliente         = $_POST['id'];
$cid               = $_POST['cid'];
$fechaFactura      = $_POST['ffact'];
$fechaVencimiento  = $_POST['fechaVencimiento'];
$fechaSuspencion   = $_POST['fechaSuspencion'];
$subTotal          = $_POST['sub'];
$impuestoTotal     = $_POST['impt'];
$valorTotalFactura = $_POST['st'];
$estadoFactura     = $_POST['estf'];
$idPlan            = $_POST['idPlan'];

// Preparar actualización
$sql = "UPDATE factura 
        SET fechaFactura = ?, 
            fechaVencimiento = ?, 
            fechaSuspencion = ?, 
            subTotal = ?, 
            impuestoTotal = ?, 
            valorTotalFactura = ?, 
            estadoFactura = ?, 
            idPlan = ?
        WHERE idFactura = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param(
    "sssdddsii", 
    $fechaFactura, 
    $fechaVencimiento, 
    $fechaSuspencion, 
    $subTotal, 
    $impuestoTotal, 
    $valorTotalFactura, 
    $estadoFactura, 
    $idPlan, 
    $idFactura
);

if ($stmt->execute()) {
    header("Location: facturas.php?msg=Factura actualizada correctamente");
    exit;
} else {
    echo "Error al actualizar factura: " . $con->error;
}
?>
