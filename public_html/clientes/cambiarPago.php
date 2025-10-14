<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

if (isset($_GET['id'], $_GET['estado'])) {
    $id = intval($_GET['id']);
    $estado = $_GET['estado'];

    $sql = "UPDATE cliente SET estadoPago = ? WHERE idCliente = ?";
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("si", $estado, $id);
        $stmt->execute();
        $stmt->close();
        header("Location: vercliente.php?id=$id");
        exit;
    } else {
        echo "Error al actualizar el estado: " . $con->error;
    }
} else {
    echo "Parámetros inválidos.";
}
