
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


$sql="INSERT INTO cliente (tipoDocumento, documentoCliente, nombreCliente, telefonoCliente, correoCliente, direccion, estadoCliente, creado, ultimaActualizacion)
 VALUES('$td','$id','$nombres','$telefono','$email','$dir','$estado','$creacion','$act')";


if ($con->query($sql) === TRUE) {
    echo "Los datos se han guardado correctamente.";
    
    include_once "tablas.php";
  } else {
    echo "Error al guardar los datos: " . $con->error;
  }
  
  $con->close();
?>
