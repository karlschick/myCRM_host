<?php

require_once __DIR__ . '/../config/db.php';

$cp=$_POST['cp'];
$tplan=$_POST['tplan'];
$vel=$_POST['vel'];
$nplan=$_POST['nplan'];
$pplan=$_POST['pplan'];
$des=$_POST['des'];
$estadop=$_POST['estadop'];

$sql="UPDATE plan SET  codigoplan='$cp',tipoPlan='$tplan',velocidad='$vel',nombrePlan='$nplan',precioPlan='$pplan',desplan='$des', estadoPlan='$estadop' WHERE codigoPlan='$cp';";
$query=mysqli_query($con,$sql);
if($query){
    Header("Location: ../planes/tablaplanes.php");
}

?>

