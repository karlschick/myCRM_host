<?php

include("conexion.php");

$td=$_POST['td'];
$id=$_POST['id'];
$nombres=$_POST['nombre'];
$telefono=$_POST['tel'];
$email=$_POST['email'];
$dir=$_POST['dir'];
$estado=$_POST['estado'];
$creacion=$_POST['creacion'];
$act=$_POST['act'];

$sql="UPDATE cliente SET  tipoDocumento='$td',documentoCliente='$id',nombreCliente='$nombres',telefonoCliente='$telefono',correoCliente='$email',direccion='$dir', estadoCliente='$estado', creado='$creacion', ultimaActualizacion='$act' WHERE documentoCliente='$id';";
$query=mysqli_query($con,$sql);
if($query){
    Header("Location: tablas.php");
}
?>