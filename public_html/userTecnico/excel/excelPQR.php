<?php
header("Content-Disposition: attatchment; filename= PQR.xls");
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

?>
<?php

include("../conexion.php");

$sql = "SELECT * FROM pqr2 WHERE estadoPqr='Activo';";

echo '<div class="table-responsive">
    <table class="table table-hover">
    <thead>
<tr>
<th> Id PQR </th>
<th> Tipo de documento</th>
<th> Numero de documento</th>
<th> Nombres de cliente</th>
<th> Telefono cliente</th>
<th> Correo cliente</th>
<th> Tipo de PQR </th>
<th> Descripcion</th>
<th> Estado</th>
</tr>
</thead>
';

if ($rta = $con->query($sql)) {
    while ($row = $rta->fetch_assoc()) {
        $i = $row['idPqr'];
        $td = $row['tipoDocumento'];
        $id = $row['nDocumento'];
        $nombres = $row['nombresCliente'];
        $tel = $row['telefonoCliente'];
        $email = $row['emailCliente'];
        $soli = $row['tPqr'];
        $dp = $row['desPqr'];
        $epqr = $row['estadoPqr'];
?>
        <tr>
            <td> <?php echo "$i" ?></td>
            <td> <?php echo "$td" ?></td>
            <td> <?php echo "$id" ?></td>
            <td> <?php echo "$nombres" ?></td>
            <td> <?php echo "$tel" ?></td>
            <td> <?php echo "$email" ?></td>
            <td> <?php echo "$soli" ?></td>
            <td> <?php echo "$dp" ?></td>
            <td> <?php echo "$epqr" ?></td>
        </tr>
<?php
    }
}
