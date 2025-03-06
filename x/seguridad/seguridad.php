<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion == '') {
   header("location:../index.html");
   die();
   exit;
}

require_once __DIR__ . '/../../config/db.php';

$id_usuario = $_SESSION['documentoUsuario'];
$consulta = "SELECT * FROM usuario WHERE documentoUsuario = '$id_usuario'";
$resultado = mysqli_query($conn, $consulta);

if (mysqli_num_rows($resultado) == 0) {
   header("location:../index.html");
   die();
   exit;
}

// Obtener los datos del usuario
$usuario = mysqli_fetch_assoc($resultado);

// Puedes utilizar los datos del usuario como $usuario['nombre'], $usuario['email'], etc.

mysqli_free_result($resultado);
mysqli_close($conn);
