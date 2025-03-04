<?php
ob_start(); // Inicia el buffer de salida
require_once __DIR__ . '/../../config/db.php';

$idCliente = $_POST['idCliente'];
$tipoVisita = $_POST['tipoVisita'];
$motivoVisita = $_POST['motivoVisita'];
$diaVisita = $_POST['diaVisita'];
$estadoVisita = $_POST['estadoVisita'];
$idTecnico = $_POST['idTecnico'];

$query = "INSERT INTO visitas (tipoVisita, motivoVisita, diaVisita, estadoVisita, visita_idCliente)
          VALUES ('$tipoVisita', '$motivoVisita', '$diaVisita', '$estadoVisita', '$idCliente')";

if (mysqli_query($con, $query)) {
  $idVisita = mysqli_insert_id($con);

  $queryUserVisita = "INSERT INTO user_visita (visita_idVisita, user_idUser)
                        VALUES ('$idVisita', '$idTecnico')";

  if (mysqli_query($con, $queryUserVisita)) {
    echo "Los datos se han guardado correctamente.";
    Header("Location: ../visitas/tablasVisitas.php");
    exit; // Asegura que se detenga la ejecución después de la redirección
  } else {
    echo "Error al guardar los datos en user_visita: " . mysqli_error($con);
  }
} else {
  echo "Error al guardar los datos en visitas: " . mysqli_error($con);
}

mysqli_close($con);
ob_end_flush(); // Envía el contenido del buffer al navegador y deshabilita el buffer de salida
