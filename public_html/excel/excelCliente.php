<?php
header("Content-Disposition: attatchment; filename= Clientes.xls");
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");


?>
<?php
include("../conexion.php");

$sql = "SELECT * FROM cliente WHERE estadoCliente='Activo';";

echo '<div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th> Tipo identificacion </th>
              <th> Numero de documento</th>
              <th> Nombres</th>
              <th> Telefono</th>
              <th> email</th>
              <th> Dirección</th>
              <th> Estado</th>
              <th> Fecha de creacion</th>
              <th> Ultima Actualización</th>

            </tr>
          </thead>';

if ($rta = $con->query($sql)) {
  while ($row = $rta->fetch_assoc()) {
    $td = $row['tipoDocumento'];
    $id = $row['documentoCliente'];
    $nombres = $row['nombreCliente'];
    $telefono = $row['telefonoCliente'];
    $email = $row['correoCliente'];
    $dir = $row['direccion'];
    $estado = $row['estadoCliente'];
    $creacion = $row['creado'];
    $act = $row['ultimaActualizacion'];
?>
    <tr>
      <td> <?php echo $td ?></td>
      <td> <?php echo $id ?></td>
      <td> <?php echo $nombres ?></td>
      <td> <?php echo $telefono ?></td>
      <td> <?php echo $email ?></td>
      <td> <?php echo $dir ?></td>
      <td> <?php echo $estado ?></td>
      <td> <?php echo $creacion ?></td>
      <td> <?php echo $act ?></td>
      <td>

    <?php
  }
}
    ?>