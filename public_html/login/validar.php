<?php
session_start();

// Conexión a la base de datos
require_once __DIR__ . '/../../config/db.php';

// Verificar conexión
if (!$con) {
    header("location:errorvalid.php?error=" . urlencode("Error de conexión a la base de datos"));
    exit;
}

// Validar que se envíen los campos del formulario
if (!isset($_POST['usuario'], $_POST['pass'])) {
    header("location:errorvalid.php?error=" . urlencode("Faltan datos de inicio de sesión"));
    exit;
}

$usuario = trim($_POST['usuario']);
$password = trim($_POST['pass']);

if ($usuario === '' || $password === '') {
    header("location:errorvalid.php?error=" . urlencode("Por favor complete todos los campos"));
    exit;
}

// 🔹 Consulta segura que también obtiene la foto
$stmt = $con->prepare("SELECT rol, claveUsuario, foto FROM usuario WHERE nombresUsuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

if ($fila = $resultado->fetch_assoc()) {

    // Validar contraseña encriptada
    if (password_verify($password, $fila['claveUsuario'])) {

        // Regenerar sesión para evitar fijación
        session_regenerate_id(true);

        // Guardar datos del usuario en sesión
        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol'] = $fila['rol'];
        $_SESSION['foto'] = $fila['foto'] ?? null; // Foto puede ser nula

        // 🔹 Guardar cookies si se seleccionó "recordarme"
        if (isset($_POST['remember-me'])) {
            setcookie('usuario', $usuario, time() + (30 * 24 * 60 * 60), "/");
            setcookie('recordarme', '1', time() + (30 * 24 * 60 * 60), "/");
        } else {
            setcookie('usuario', '', time() - 3600, "/");
            setcookie('recordarme', '', time() - 3600, "/");
        }

        // 🔹 Redirección según rol
        switch ($fila['rol']) {
            case 'Administrador':
                header("location:../dashboard/principal.php");
                break;
            case 'Tecnico':
                header("location:../visitas/tablasVisitasT.php");
                break;
            default:
                header("location:errorvalid.php?error=" . urlencode("Rol no autorizado"));
                break;
        }
        exit;

    } else {
        // Contraseña incorrecta
        header("location:errorvalid.php?error=" . urlencode("Contraseña incorrecta"));
        exit;
    }

} else {
    // Usuario no encontrado
    header("location:errorvalid.php?error=" . urlencode("Usuario no encontrado"));
    exit;
}

$stmt->close();
$con->close();
?>
