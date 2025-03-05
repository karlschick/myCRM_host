    <!-- actualizado -->
<?php

require_once __DIR__ . '/../../config/db.php';

$id=$_GET['id'];

$sql="UPDATE usuario SET  estadoUsuario='Inactivo'WHERE documentoUsuario='$id'";  
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: tablasUser.php");
    }
?>
