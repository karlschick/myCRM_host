
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



$sql="INSERT INTO usuario (tipoDocumento, documentoUsuario, nombresUsuario, telefonoUsuario, correoUsuario, claveUsuario, estadoUsuario, created_at, updated_at,rol)
 VALUES('$td','$id','$nombres','$telefono','$email','$clave','$estado','$creacion','$act','$rol')";


if ($con->query($sql) === TRUE) {
    echo "Los datos se han guardado correctamente.";
    
    include_once "tablasUser.php";
  } else {
    echo "Error al guardar los datos: " . $con->error;
  }
  
  $con->close();
?>
