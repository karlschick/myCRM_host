<?php

require_once __DIR__ . '/../../config/db.php';

$cp = $_GET['cp'];

$sql = "UPDATE plan SET estadoPlan='Activo' WHERE codigoPlan='$cp'";
$query = mysqli_query($con, $sql);

if ($query) {
    Header("Location: tablaplanes.php");
}
