<?php
session_start();
error_reporting(E_ALL);

// Verifica sesión
if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

// Ajusta la ruta a tu archivo de conexión si es necesario
require_once __DIR__ . '/../../config/db.php';

// Comprueba que venga el id por GET
if (!isset($_GET['id']) || empty($_GET['id'])) {
    // redirige con mensaje de error opcional
    header('Location: archivados.php?error=sin_id');
    exit;
}

$doc = $_GET['id'];

// Usa prepared statement para evitar inyección
$stmt = $con->prepare("UPDATE cliente SET estadoCliente = 'Activo', ultimaActualizacion = NOW() WHERE documentoCliente = ?");
if (!$stmt) {
    // mostrar error (útil en desarrollo)
    die("Error en prepare: " . $con->error);
}

$stmt->bind_param("s", $doc);

if ($stmt->execute()) {
    $stmt->close();
    // redirige de vuelta a la lista de archivados (puedes cambiar a principal.php)
    header('Location: archivados.php?ok=reactivado');
    exit;
} else {
    $err = $stmt->error;
    $stmt->close();
    die("Error al reactivar cliente: " . htmlspecialchars($err));
}
