
<?php

include("conexion.php");

$id=$_GET['id'];

$sql="UPDATE factura SET  estadoFactura='Pago'WHERE idFactura='$id'";  
$query=mysqli_query($con,$sql);

    if($query){
        Header("Location: facturas.php");
    }
?>
