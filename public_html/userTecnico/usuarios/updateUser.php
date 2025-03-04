<?php

include("conexion.php");

$td=$_POST['td'];
$id=$_POST['id'];
$nombres=$_POST['nombre'];
$telefono=$_POST['tel'];
$email=$_POST['email'];
$clave=$_POST['clave'];
$estado=$_POST['estado'];
$creacion=$_POST['creacion'];
$act=$_POST['act'];
$rol=$_POST['rol'];

$sql="UPDATE usuario SET  tipoDocumento='$td',documentoUsuario='$id',nombresUsuario='$nombres',telefonoUsuario='$telefono',correoUsuario='$email',claveUsuario='$clave', estadoUsuario='$estado', creado='$creacion', ultimaActualizacion='$act', rol='$rol' WHERE documentoUsuario='$id';";
$query=mysqli_query($con,$sql);
if($query){
    Header("Location: tablasUser.php");
}
?>