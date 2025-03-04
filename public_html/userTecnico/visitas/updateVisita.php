<?php

include("conexion.php");

$id = $_POST['id'];
$docC = $_POST['docC'];
$nomC = $_POST['nomC'];
$telC = $_POST['telC'];
$emailC = $_POST['emailC'];
$dir = $_POST['dir'];
$docT = $_POST['docT'];
$nomT = $_POST['nomT'];
$telT = $_POST['telT'];
$emailT = $_POST['emailT'];
$motivo = $_POST['motivo'];
$dia = $_POST['dia'];
$comentario = $_POST['comentario'];
$idVisita = $_POST['idVisita'];

$sql = "UPDATE visitas SET  comentario='$comentario' where idVisita='$idVisita';";



$query = mysqli_query($con, $sql);
if ($query) {
    Header("Location: inicioVisitasT.php");
}
