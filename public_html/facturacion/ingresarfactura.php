<?php 
require_once __DIR__ . '/../../config/db.php';
$cid=$_POST['cid'];
$fing=$_POST['fing'];
$impt=$_POST['impt'];
$sub=$_POST['sub'];
$st=$_POST['st'];
$nplan=$_POST['nplan'];
$ffact= date('Y-m-d', strtotime($fing . ' +15 days'));
$flim=date('Y-m-d', strtotime($fing . ' +20 days'));

$sql="INSERT INTO factura(fechaFactura,impuestoTotal,subTotal,valorTotalFactura,cliente_idCliente,fechaVencimiento,fechaSuspencion,nPlan)
VALUES('$fing','$impt','$sub','$st','$cid','$ffact','$flim','$nplan'); ";
$query=mysqli_query($con,$sql);
if($query){
    Header("Location: facturas.php");
}
?>