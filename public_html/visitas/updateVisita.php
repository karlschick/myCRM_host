<?php

require_once __DIR__ . '/../../config/db.php';

$idVisita = $_POST['idVisita'];
$tipoVisita = $_POST['tipoVisita'];
$visita_idVisita = $_POST['visita_idVisita'];
$motivoVisita = $_POST['motivoVisita'];
$diaVisita = $_POST['diaVisita'];
$estadoVisita = $_POST['estadoVisita'];
$idTecnico = $_POST['idTecnico'];


$sql1 = "UPDATE visitas
SET tipoVisita = '$tipoVisita', motivoVisita = '$motivoVisita' , diaVisita = '$diaVisita' , estadoVisita = '$estadoVisita'
WHERE idVisita = '$idVisita';";

$sql2 = "UPDATE user_visita
SET user_idUser = '$idTecnico'
WHERE visita_idVisita = '$idVisita';";

$query = mysqli_query($con, $sql1);
$query2 = mysqli_query($con, $sql2);
if ($query and $query2) {
    Header("Location: tablasVisitas.php");
}
