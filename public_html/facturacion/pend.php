    <!-- actualizado -->
<?php

require_once __DIR__ . '/../../config/db.php';

$id=$_GET['id'];

$sql="UPDATE factura SET  estadoFactura='Pendiente'WHERE idFactura='$id'";  
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: facturas.php");
    }
?>
