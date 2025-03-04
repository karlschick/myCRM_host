<?php

require_once __DIR__ . '/../config/db.php';

$id=$_GET['id'];

$sql="UPDATE cliente SET  estadoCliente='Archivado'WHERE documentoCliente='$id'";  
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: tablas.php");
    }
?>
