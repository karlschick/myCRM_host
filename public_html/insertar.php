<?php
require_once __DIR__ . '/../config/db.php';

$td = $_POST['td'];
$id = $_POST['id'];
$nombres = $_POST['nombre'];
$telefono = $_POST['tel'];
$email = $_POST['email'];
$dir = $_POST['dir'];
$estado = $_POST['estado'];
$plan = $_POST['plan'];
$creacion = $_POST['creacion'];
$act = $_POST['act'];

// Verificar si el documento ya existe
$sql_verificar = "SELECT * FROM cliente WHERE documentoCliente = '$id'";
$resultado = $con->query($sql_verificar);
if ($resultado->num_rows > 0) {
  // El documento ya está en uso, mostrar una alerta y volver a la página anterior
  echo '<script>alert("El documento ya está en uso.");';
  echo 'window.history.back();</script>';
} else {
  // Insertar el nuevo registro
  $sql_insertar = "INSERT INTO cliente (tipoDocumento, documentoCliente, nombreCliente, telefonoCliente, correoCliente, direccion, estadoCliente, plan_idPlan , creado, ultimaActualizacion) VALUES ('$td', '$id', '$nombres', '$telefono', '$email', '$dir', '$estado', '$plan', '$creacion', '$act')";
  if ($con->query($sql_insertar) === TRUE) {
    echo "Los datos se han guardado correctamente.";
    header("Location:../tablas.php");
  } else {
    echo "Error al guardar los datos: " . $con->error;
  }
}

$con->close();
