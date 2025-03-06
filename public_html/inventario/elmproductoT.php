<?php

require_once __DIR__ . '/../../config/db.php';
$id=$_GET['id'];

$sql="UPDATE producto SET  estadoProducto='Inactivo'WHERE idProducto='$id'";  
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: tablasinventarioT.php");
    }
?>