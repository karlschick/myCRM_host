<?php
require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_bancario'])) {
    $id_bancario = intval($_POST['id_bancario']);

    $sql = "DELETE FROM bancario WHERE id_bancario = ?";
    $stmt = mysqli_prepare($con, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id_bancario);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Banco eliminado correctamente'); window.location.href='ingresarBancos.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el banco'); window.history.back();</script>";
    }

    mysqli_stmt_close($stmt);
}
?>
