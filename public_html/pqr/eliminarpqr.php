<?php

include("conexion.php");

$i=$_GET['i'];

$sql="UPDATE pqr2 SET  estadoPQR='Inactivo'WHERE idPqr='$i'";  
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: pqr.php");
    }
?>