<?php
include("conexion.php");

$td = $_POST['td'];
$id = $_POST['id'];
$nombres = $_POST['nombre'];
$telefono = $_POST['tel'];
$email = $_POST['email'];
$clave = $_POST['clave'];
$estado = $_POST['estado'];
$creacion = $_POST['creacion'];
$act = $_POST['act'];
$rol = $_POST['rol'];

// Esta linea es para encriptar la contraseña
$hashed_clave = password_hash($clave, PASSWORD_DEFAULT);

// Verificar si el documento ya existe
$sql_verificar = "SELECT * FROM usuario WHERE documentoUsuario = '$id'";
$resultado = $con->query($sql_verificar);
if ($resultado->num_rows > 0) {
  // El documento ya está en uso, mostrar una alerta y volver a la página anterior
  echo '<script>alert("El documento ya está en uso.");';
  echo 'window.history.back();</script>';
} else {
  // Insertar el nuevo registro
  $sql_insertar = "INSERT INTO usuario (tipoDocumento, documentoUsuario, nombresUsuario, telefonoUsuario, correoUsuario, claveUsuario, estadoUsuario, creado, ultimaActualizacion, rol) VALUES ('$td', '$id', '$nombres', '$telefono', '$email', '$hashed_clave', '$estado', '$creacion', '$act', '$rol')";
  if ($con->query($sql_insertar) === TRUE) {
    echo "Los datos se han guardado correctamente.";
    include_once "tablasUser.php";
  } else {
    echo "Error al guardar los datos: " . $con->error;
  }
}

$con->close();
