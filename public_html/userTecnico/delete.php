<?php

include("conexion.php");

$id=$_GET['id'];

$sql="UPDATE cliente SET  estadoCliente='Archivado'WHERE documentoCliente='$id'";  
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: tablas.php");
    }
?>
