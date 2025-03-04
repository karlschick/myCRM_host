<?php
header("Content-Disposition: attatchment; filename= Factura.xls");
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");


?>
<?php

include("../conexion.php");

$sql = "SELECT cliente.idCliente,factura.cliente_idCliente,cliente.documentoCliente,cliente.nombreCliente,factura.fechaFactura,factura.valorTotalFactura,factura.estadoFactura FROM cliente 
            INNER JOIN factura
            ON cliente.idCliente=factura.cliente_idCliente;";

echo '<div class="table-responsive">
    <table class="table table-hover">
    <thead>
<tr>
<th> ID </th>
<th> Documento Cliente </th>
<th> Nombre Cliente</th>
<th> Fecha Factura</th>
<th> Valor Total</th>
<th> Estado factura</th>

</tr>
</thead>
';

if ($rta = $con->query($sql)) {
  while ($row = $rta->fetch_assoc()) {
    $a = $row['idCliente'];
    $b = $row['cliente_idCliente'];
    $dc = $row['documentoCliente'];
    $nomc = $row['nombreCliente'];
    $ffact = $row['fechaFactura'];
    $st = $row['valorTotalFactura'];
    $estf = $row['estadoFactura'];


?>
    <tr>
      
      <td> <?php echo "$b" ?></td>
      <td> <?php echo "$dc" ?></td>
      <td> <?php echo "$nomc" ?></td>
      <td> <?php echo "$ffact" ?></td>
      <td> <?php echo "$st" ?></td>
      <td> <?php echo "$estf" ?></td>
      <th>
      
    </tr>
<?php
  }
}
?>