<?php
require_once __DIR__ . '/../config/db.php';
$cp = $_POST['cp'];
$tplan = $_POST['tplan'];
$vel = $_POST['vel'];
$nplan = $_POST['nplan'];
$pplan = $_POST['pplan'];
$des = $_POST['des'];
$estadop = $_POST['estadop'];


$sql = "INSERT INTO plan (codigoPlan, tipoPlan, velocidad, nombrePlan, precioPlan, desPlan, estadoPlan)
 VALUES('$cp','$tplan','$vel','$nplan','$pplan','$des','$estadop')";


if ($con->query($sql) === TRUE) {
  echo "Los datos se han guardado correctamente.";
  header("Location:../planes/tablaplanes.php");
} else {
  echo "Error al guardar los datos: " . $con;
}

$con->close();
