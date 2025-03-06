    <!-- actualizado -->
<?php

require_once __DIR__ . '/../../config/db.php';

$id=$_POST['id'];
$nombrep=$_POST['nombrep'];
$serial=$_POST['serial'];
$desp=$_POST['desp'];
$cantidad=$_POST['cantidad'];
$estadop=$_POST['estadop'];

$sql="UPDATE producto SET nombreProducto='$nombrep', serialProducto='$serial', descripcionProducto='$desp', cantidad='$cantidad', estadoProducto='$estadop' WHERE idProducto='$id';";
$query=mysqli_query($con,$sql);
if($query){
    Header("Location: tablasinventarioT.php");
}
?>
