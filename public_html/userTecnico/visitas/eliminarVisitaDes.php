<?php

include("conexion.php");

$i=$_GET['i'];

$sql="UPDATE visitas SET  estadoVisita='Eliminada'WHERE idVisita='$i'";  
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: tablasVisitas.php");
    }
?>