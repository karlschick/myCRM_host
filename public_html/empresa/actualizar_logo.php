<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verificar que se haya subido un archivo
    if (!isset($_FILES['nuevo_logo']) || $_FILES['nuevo_logo']['error'] === UPLOAD_ERR_NO_FILE) {
        echo "<script>alert('⚠️ Primero selecciona un archivo válido.'); window.location.href='verEmpresa.php';</script>";
        exit;
    }

    $directorio = "../assets/images/empresa/";
    $archivo_actual = $directorio . "logoEmpresa.png";
    $archivo_temporal = $_FILES['nuevo_logo']['tmp_name'];

    // Validar que sea una imagen válida
    $tipo = mime_content_type($archivo_temporal);
    $permitidos = ['image/png', 'image/jpeg', 'image/jpg', 'image/webp'];

    if (!in_array($tipo, $permitidos)) {
        echo "<script>alert('❌ Tipo de archivo no permitido. Solo se aceptan PNG, JPG o WEBP.'); window.location.href='verEmpresa.php';</script>";
        exit;
    }

    // Intentar reemplazar el logo existente
    if (move_uploaded_file($archivo_temporal, $archivo_actual)) {
        echo "<script>alert('✅ Logo actualizado correctamente.'); window.location.href='verEmpresa.php';</script>";
    } else {
        echo "<script>alert('❌ Error al subir el logo. Verifica permisos de escritura.'); window.location.href='verEmpresa.php';</script>";
    }
} else {
    header("Location: verEmpresa.php");
    exit;
}
?>
