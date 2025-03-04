<?php

include("conexion.php");

$id=$_GET['id'];

$sql="UPDATE usuario SET  estadoUsuario='Inactivo'WHERE documentoUsuario='$id'";  
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: tablasUser.php");
    }
?>
