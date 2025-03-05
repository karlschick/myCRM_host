<?php

require_once __DIR__ . '/../../config/db.php';

$id=$_POST['id'];
$comentario=$_POST['comentario'];

$sql="UPDATE pqr2 SET comentario='$comentario' WHERE idPqr='$id';";


$query=mysqli_query($con,$sql);
if($query){
    Header("Location: pqr.php");
}
?>