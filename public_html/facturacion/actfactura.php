<?php 
include "conexion.php";
$if=$_POST['if'];
$ffact=$_POST['ffact'];
$st=$_POST['st'];
$impt= $st *0.19;
$sub= $st*0.81;
$estf=$_POST['estf'];


$sql="UPDATE factura SET fechaFactura='$ffact', impuestoTotal='$impt', subTotal='$sub',valorTotalFactura='$st', estadoFactura='$estf' WHERE idFactura='$if';";

$query=mysqli_query($con,$sql);
if($query){
    Header("Location: facturas.php");
}


?>