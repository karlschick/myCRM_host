<?php
session_start();
error_reporting(0);

// Verificar sesión
if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

require_once __DIR__ . '/../../config/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("<script>alert('ID de producto inválido.'); window.location='inactivosinv.php';</script>");
}

$id = intval($_GET['id']);

// Eliminar producto definitivamente
$sql = "DELETE FROM producto WHERE idProducto = $id LIMIT 1;";
if ($con->query($sql)) {
    echo "<script>alert('✅ Producto eliminado correctamente.'); window.location='inactivosinv.php';</script>";
} else {
    echo "<script>alert('❌ Error al eliminar el producto: " . addslashes($con->error) . "'); window.location='inactivosinv.php';</script>";
}
?>
