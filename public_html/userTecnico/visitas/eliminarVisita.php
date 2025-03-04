<?php

include("conexion.php");

$id = $_GET['id'];

$sql = "UPDATE visitas SET  estadoVisita='Completado'WHERE idVisita='$id'";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: inicioVisitasT.php");
}
