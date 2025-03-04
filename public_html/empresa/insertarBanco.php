<?php
include("conexion.php");

$num_cuenta = $_POST['num_cuenta'];
$nomb_banco = $_POST['nomb_banco'];
$estadoCuenta = $_POST['estadoCuenta'];

$sql = "INSERT INTO bancario (num_cuenta, nomb_banco, estadoCuenta) 
VALUES ('$num_cuenta', '$nomb_banco', '$estadoCuenta');";

if ($con->query($sql) === TRUE) {
  echo "Los datos se han guardado correctamente.";

  header("Location: ../empresa/verempresa.php");
} else {
  echo "Error al guardar los datos: " . $con;
}

$con->close();
