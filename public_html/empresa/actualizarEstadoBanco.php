<?php
require_once __DIR__ . '/../../config/db.php';

// Verifica si la solicitud es de tipo POST y si se ha enviado el botón de actualizar
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['actualizar'])) {
    $id_bancario = intval($_POST['actualizar']); // Asegurar que el ID es un número entero
    $nuevo_estado = mysqli_real_escape_string($con, $_POST['estadoCuenta'][$id_bancario]);

    // Validar que el estado solo pueda ser "Activo" o "Archivado"
    if ($nuevo_estado !== "Activo" && $nuevo_estado !== "Archivado") {
        header("Location: ingresarBancos.php?error=Estado inválido");
        exit();
    }

    // Actualizar el estado del banco en la base de datos
    $sql = "UPDATE bancario SET estadoCuenta = '$nuevo_estado' WHERE id_bancario = '$id_bancario'";

    if (mysqli_query($con, $sql)) {
        header("Location: ingresarBancos.php?success=Estado actualizado correctamente");
    } else {
        header("Location: ingresarBancos.php?error=Error al actualizar el estado");
    }

    exit();
} else {
    // Si se intenta acceder sin POST, redirigir
    header("Location: ingresarBancos.php");
    exit();
}
?>
