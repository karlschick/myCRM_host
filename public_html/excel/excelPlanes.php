<?php
header("Content-Type: application//vnd.openxmlformats-officedocument.spreadsheetml.sheet");
header("Content-Disposition: attatchment; filename= Planes.xls");

?>
<?php
include_once "../conexion.php";

$sql = "SELECT * FROM plan WHERE estadoPlan='activo';";

echo '<div class="table-responsive">
          <table class="table table-hover">
          <thead>
              <tr>
                  <th> Codigo Plan </th>
                  <th> Velocidad de Plan</th>
                  <th> Nombre de Plan</th>
                  <th> Precio de Plan</th>
                  <th> Descripcion Plan</th>
                  <th> Estado de Plan</th>
              </tr>
            </thead>';

if ($rta = $con->query($sql)) {
  while ($row = $rta->fetch_assoc()) {
    $cp = $row['codigoPlan'];
    $vel = $row['velocidad'];
    $nplan = $row['nombrePlan'];
    $pplan = $row['precioPlan'];
    $des = $row['desPlan'];
    $estadop = $row['estadoPlan'];
?>
    <tr>
      <td> <?php echo "$cp" ?></td>
      <td> <?php echo "$vel" ?></td>
      <td> <?php echo "$nplan" ?></td>
      <td> <?php echo "$pplan" ?></td>
      <td> <?php echo "$des" ?></td>
      <td> <?php echo "$estadop" ?></td>
    </tr>
<?php
  }
}
?>