<?php

include("conexion.php");

$id=$_POST['id'];
$comentario=$_POST['comentario'];

$sql="UPDATE visitas SET  comentario='$comentario' WHERE idVisita='$id';";


$query=mysqli_query($con,$sql);
if($query){
    Header("Location: tablasVisitas.php");
}
?>