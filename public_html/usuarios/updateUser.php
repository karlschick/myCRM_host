<?php
session_start(); // ← importante para actualizar la foto en sesión
require_once __DIR__ . '/../../config/db.php';

// Obtener datos del formulario
$td = $_POST['td'];
$id = $_POST['id'];
$nombres = $_POST['nombre'];
$docusuario = $_POST['docusuario'];
$telefono = $_POST['tel'];
$email = $_POST['email'];
$clave = $_POST['clave']; // Nueva contraseña (opcional)
$estado = $_POST['estado'];
$creacion = $_POST['creacion'];
$act = $_POST['act'];
$rol = $_POST['rol'];

// 🔹 Ruta base de las fotos (ajustada a tu estructura real)
$carpetaDestino = __DIR__ . '/../../public_html/assets/images/faces-clipart/';

// Si la carpeta no existe, la creamos
if (!file_exists($carpetaDestino)) {
    mkdir($carpetaDestino, 0755, true);
}

// Primero obtenemos la foto actual del usuario
$sql_foto_actual = "SELECT foto FROM usuario WHERE idUsuario = ?";
$stmt = $con->prepare($sql_foto_actual);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuarioActual = $result->fetch_assoc();
$fotoActual = $usuarioActual['foto'] ?: 'pic-1.png';
$stmt->close();

// Inicializamos el nombre final de la foto (por defecto, la actual)
$nombreArchivoFinal = $fotoActual;

// Verificar si se subió una nueva imagen
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoNombre = basename($_FILES['foto']['name']);
    $fotoTipo = strtolower(pathinfo($fotoNombre, PATHINFO_EXTENSION));
    $fotoTamaño = $_FILES['foto']['size'];

    // Tipos de archivo permitidos
    $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fotoTipo, $tiposPermitidos)) {
        if ($fotoTamaño <= 2 * 1024 * 1024) { // Máx. 2MB
            // Renombrar archivo de forma única
            $nombreArchivoFinal = uniqid('user_') . '.' . $fotoTipo;
            $rutaDestino = $carpetaDestino . $nombreArchivoFinal;

            if (move_uploaded_file($fotoTmp, $rutaDestino)) {
                // Si tenía una foto anterior (y no era la por defecto), la eliminamos
                if ($fotoActual !== 'pic-1.png' && file_exists($carpetaDestino . $fotoActual)) {
                    unlink($carpetaDestino . $fotoActual);
                }

                // 🔹 Actualizar variable de sesión si el usuario está logueado
                if (isset($_SESSION['usuario'])) {
                    $_SESSION['foto'] = $nombreArchivoFinal;
                }

            } else {
                $nombreArchivoFinal = $fotoActual; // Fallback si falla la subida
            }
        } else {
            echo '<script>alert("La imagen excede el tamaño máximo permitido de 2MB."); window.history.back();</script>';
            exit;
        }
    } else {
        echo '<script>alert("Formato de imagen no permitido. Solo se aceptan JPG, PNG o GIF."); window.history.back();</script>';
        exit;
    }
}

// Si se envía una nueva clave, la encriptamos; si no, mantenemos la actual
if (!empty($clave)) {
    $hashed_clave = password_hash($clave, PASSWORD_DEFAULT);
    $sql = "UPDATE usuario SET 
                tipoDocumento=?, 
                documentoUsuario=?, 
                nombresUsuario=?, 
                telefonoUsuario=?, 
                correoUsuario=?, 
                claveUsuario=?, 
                estadoUsuario=?, 
                creado=?, 
                ultimaActualizacion=?, 
                rol=?, 
                foto=? 
            WHERE idUsuario=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssssssssssi", $td, $docusuario, $nombres, $telefono, $email, $hashed_clave, $estado, $creacion, $act, $rol, $nombreArchivoFinal, $id);
} else {
    $sql = "UPDATE usuario SET 
                tipoDocumento=?, 
                documentoUsuario=?, 
                nombresUsuario=?, 
                telefonoUsuario=?, 
                correoUsuario=?, 
                estadoUsuario=?, 
                creado=?, 
                ultimaActualizacion=?, 
                rol=?, 
                foto=? 
            WHERE idUsuario=?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ssssssssssi", $td, $docusuario, $nombres, $telefono, $email, $estado, $creacion, $act, $rol, $nombreArchivoFinal, $id);
}

// Ejecutar y verificar resultado
if ($stmt->execute()) {
    echo '<script>alert("Usuario actualizado correctamente."); window.location.href="tablasUser.php";</script>';
} else {
    echo "Error al actualizar los datos: " . $con->error;
}

$stmt->close();
$con->close();
?>
