<!-- actualizado -->
<?php
require_once __DIR__ . '/../../config/db.php';

// Recibir los valores del formulario
$td = $_POST['td'];
$id = $_POST['id'];
$nombres = $_POST['nombre'];
$telefono = $_POST['tel'];
$email = $_POST['email'];
$clave = $_POST['clave'];
$estado = $_POST['estado'];
$creacion = $_POST['creacion'];
$act = $_POST['act'];
$rol = $_POST['rol'];

// Encriptar la contraseña
$hashed_clave = password_hash($clave, PASSWORD_DEFAULT);

// Ruta base donde se guardarán las fotos
$carpetaDestino = __DIR__ . '/../../public/images/faces-clipart/';

// Si la carpeta no existe, la creamos (solo la primera vez)
if (!file_exists($carpetaDestino)) {
    mkdir($carpetaDestino, 0755, true);
}

// Valor por defecto si no se sube imagen
$nombreArchivoFinal = 'pic-1.png';

// Verificar si se subió una imagen
if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoNombre = basename($_FILES['foto']['name']);
    $fotoTipo = strtolower(pathinfo($fotoNombre, PATHINFO_EXTENSION));
    $fotoTamaño = $_FILES['foto']['size'];

    // Validar tipo de archivo permitido
    $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($fotoTipo, $tiposPermitidos)) {
        if ($fotoTamaño <= 2 * 1024 * 1024) { // Máx. 2MB
            // Renombrar archivo de forma única para evitar conflictos
            $nombreArchivoFinal = uniqid('user_') . '.' . $fotoTipo;
            $rutaDestino = $carpetaDestino . $nombreArchivoFinal;

            if (!move_uploaded_file($fotoTmp, $rutaDestino)) {
                $nombreArchivoFinal = 'pic-1.png'; // Fallback si falla la subida
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

// Verificar si el documento ya existe
$sql_verificar = "SELECT * FROM usuario WHERE documentoUsuario = ?";
$stmt = $con->prepare($sql_verificar);
$stmt->bind_param("s", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    echo '<script>alert("El documento ya está en uso."); window.history.back();</script>';
} else {
    // ✅ Insertar el nuevo registro con foto (campo correcto: `foto`)
    $sql_insertar = "INSERT INTO usuario 
        (tipoDocumento, documentoUsuario, nombresUsuario, telefonoUsuario, correoUsuario, claveUsuario, estadoUsuario, creado, ultimaActualizacion, rol, foto) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql_insertar);
    $stmt->bind_param("sssssssssss", $td, $id, $nombres, $telefono, $email, $hashed_clave, $estado, $creacion, $act, $rol, $nombreArchivoFinal);

    if ($stmt->execute()) {
        echo '<script>alert("Usuario registrado correctamente."); window.location.href="tablasUser.php";</script>';
    } else {
        echo "Error al guardar los datos: " . $con->error;
    }
}

$stmt->close();
$con->close();
?>
