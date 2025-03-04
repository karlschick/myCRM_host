<?php

include("conexion.php");

$id=$_GET['id'];

$sql="UPDATE producto SET  estadoProducto='Inactivo'WHERE idProducto='$id'";  
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: tablasinventario.php");
    }
?>