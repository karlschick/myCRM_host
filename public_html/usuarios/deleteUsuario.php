<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

// Validar parámetros
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: tablasUser.php");
    exit;
}

$id = $_GET['id'];
$accion = $_GET['accion'] ?? 'archivar'; // Puede venir 'archivar' o 'eliminar'

// Si la acción es archivar (usuarios activos)
if ($accion === 'archivar') {
    $sql = "UPDATE usuario SET estadoUsuario='Inactivo' WHERE documentoUsuario=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {
        header("Location: tablasUser.php?estado=Activo&msg=" . urlencode("Usuario archivado correctamente"));
        exit; // 🔹 Detiene aquí
    } else {
        header("Location: tablasUser.php?estado=Activo&error=" . urlencode("Error al archivar usuario"));
        exit;
    }
    $stmt->close();
}

// Si la acción es eliminar (usuarios inactivos)
elseif ($accion === 'eliminar') {
    $sql = "DELETE FROM usuario WHERE documentoUsuario=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $id);
    if ($stmt->execute()) {
        header("Location: tablasUser.php?estado=Inactivo&msg=" . urlencode("Usuario eliminado correctamente"));
        exit; // 🔹 Detiene aquí también
    } else {
        header("Location: tablasUser.php?estado=Inactivo&error=" . urlencode("Error al eliminar usuario"));
        exit;
    }
    $stmt->close();
}

$con->close();
?>
