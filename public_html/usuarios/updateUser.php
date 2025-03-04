<?php
include("conexion.php");

$td = $_POST['td'];
$id = $_POST['id'];
$nombres = $_POST['nombre'];
$docusuario=$_POST['docusuario'];
$telefono = $_POST['tel'];
$email = $_POST['email'];
$clave = $_POST['clave']; // La nueva contraseña sin encriptar
$estado = $_POST['estado'];
$creacion = $_POST['creacion'];
$act = $_POST['act'];
$rol = $_POST['rol'];

// Encriptar la nueva contraseña
$hashed_clave = password_hash($clave, PASSWORD_DEFAULT);

$sql = "UPDATE usuario SET tipoDocumento='$td', documentoUsuario='$docusuario', nombresUsuario='$nombres', telefonoUsuario='$telefono', correoUsuario='$email', claveUsuario='$hashed_clave', estadoUsuario='$estado', creado='$creacion', ultimaActualizacion='$act', rol='$rol' WHERE idUsuario='$id'";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: tablasUser.php");
} else {
    echo "Error al actualizar los datos: " . mysqli_error($con);
}

mysqli_close($con);
