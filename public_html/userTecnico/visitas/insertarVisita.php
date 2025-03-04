
 <?php
include("conexion.php");

$docC=$_POST['docC'];
$nomC=$_POST['nomC'];
$telC=$_POST['telC'];
$emailC=$_POST['emailC'];
$dir=$_POST['dir'];
$docT=$_POST['docT'];
$nomT=$_POST['nomT'];
$telT=$_POST['telT'];
$emailT=$_POST['emailT'];
$motivo=$_POST['motivo'];
$dia=$_POST['dia'];



$sql="INSERT INTO visitas (documentoCliente, nombreCliente, telefonoCliente, emailCliente, direccionCliente, documentoTecnico, nombreTecnico, telefonoTecnico, emailTecnico, motivoVisita, diaVisita)
 VALUES('$docC','$nomC','$telC','$emailC','$dir','$docT','$nomT','$telT','$emailT','$motivo','$dia')";


if ($con->query($sql) === TRUE) {
    echo "Los datos se han guardado correctamente.";
    
    include_once "tablasVisitas.php";
  } else {
    echo "Error al guardar los datos: " . $con->error;
  }
  
  $con->close();
?>
