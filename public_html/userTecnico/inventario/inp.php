<?php
include("conexion.php");
$nombrep=$_POST['nombrep'];
$serial=$_POST['serial'];
$desp=$_POST['desp'];
$cantidad=$_POST['cantidad'];

$sql="INSERT INTO producto (nombreProducto, serialProducto, descripcionProducto, cantidad)
 VALUES('$nombrep','$serial','$desp','$cantidad')";


if ($con->query($sql) === TRUE) {
    echo "Los datos se han guardado correctamente.";
    
    include_once "tablasinventario.php";
  } else {
    echo "Error al guardar los datos: " . $con;
  }
  
  $con->close();
?>
