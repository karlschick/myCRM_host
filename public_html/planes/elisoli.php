<?php

require_once __DIR__ . '/../config/db.php';

$i=$_GET['i'];

$sql="UPDATE solicitudes SET  estadoSolicitud='Atendido'WHERE idSolicitud='$i'";  
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: solicitudes.php");
    }
?>