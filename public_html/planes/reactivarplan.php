<?php
session_start();
error_reporting(E_ALL);

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

require_once __DIR__ . '/../../config/db.php';

// Verifica que llegue el código del plan
if (!isset($_GET['cp']) || empty($_GET['cp'])) {
    header('Location: tablaplanesinac.php?error=sin_cp');
    exit;
}

$cp = $_GET['cp'];

// Prepared statement para evitar inyección
$stmt = $con->prepare("UPDATE plan SET estadoPlan = 'Activo' WHERE codigoPlan = ?");
if (!$stmt) {
    die("Error en prepare: " . htmlspecialchars($con->error));
}
$stmt->bind_param("s", $cp);

if ($stmt->execute()) {
    $stmt->close();
    header('Location: tablaplanesinac.php?ok=reactivado');
    exit;
} else {
    $err = $stmt->error;
    $stmt->close();
    die("Error al reactivar plan: " . htmlspecialchars($err));
}
