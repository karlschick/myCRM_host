<?php

require_once __DIR__ . '/../../config/db.php';

$i=$_GET['i'];

$sql="UPDATE visitas SET  estadoVisita='Atendida'WHERE idVisita='$i'";  
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: tablasVisitas.php");
    }
?>