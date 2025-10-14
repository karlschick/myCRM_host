<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

if (isset($_GET['i'])) {
    $id = intval($_GET['i']);
    $sql = "UPDATE pqr2 SET estadoPqr='Inactivo' WHERE idPqr=$id";
    if ($con->query($sql)) {
        header("Location: pqr.php?estado=Activo");
        exit;
    } else {
        echo "Error al archivar: " . $con->error;
    }
} else {
    header("Location: pqr.php");
    exit;
}
