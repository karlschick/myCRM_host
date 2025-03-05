<?php

require_once __DIR__ . '/../../config/db.php';

$cp = $_GET['cp'];

$sql = "UPDATE plan SET estadoPlan='Archivado' WHERE codigoPlan='$cp'";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: tablaplanes.php");
}
