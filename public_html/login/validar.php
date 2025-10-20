<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

// Validar campos
if (!isset($_POST['usuario'], $_POST['pass'])) {
    header("location:errorvalid.php?error=" . urlencode("Faltan datos de inicio de sesión"));
    exit;
}

$usuarioInput = trim($_POST['usuario']);
$passInput = trim($_POST['pass']);

if ($usuarioInput === '' || $passInput === '') {
    header("location:errorvalid.php?error=" . urlencode("Por favor complete todos los campos"));
    exit;
}

// Consulta segura: permite login con user_usuario o correoUsuario
$stmt = $con->prepare("SELECT * FROM usuario WHERE user_usuario = ? OR correoUsuario = ? LIMIT 1");
$stmt->bind_param("ss", $usuarioInput, $usuarioInput);
$stmt->execute();
$result = $stmt->get_result();

if ($fila = $result->fetch_assoc()) {

    // Verificar contraseña
    if (password_verify($passInput, $fila['claveUsuario'])) {

        session_regenerate_id(true);
        $_SESSION['usuario'] = $fila['user_usuario'];
        $_SESSION['nombresUsuario'] = $fila['nombresUsuario']; // nombre real

        $_SESSION['rol'] = $fila['rol'];
        $_SESSION['foto'] = !empty($fila['foto']) ? $fila['foto'] : 'pic-1.png';

        // Cookies recordarme
        if (isset($_POST['remember-me'])) {
            setcookie('usuario', $usuarioInput, time() + (30*24*60*60), "/");
            setcookie('recordarme', '1', time() + (30*24*60*60), "/");
        } else {
            setcookie('usuario', '', time() - 3600, "/");
            setcookie('recordarme', '', time() - 3600, "/");
        }

        // Redirigir según rol
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
        header("location:errorvalid.php?error=" . urlencode("Contraseña incorrecta"));
        exit;
    }

} else {
    header("location:errorvalid.php?error=" . urlencode("Usuario no encontrado"));
    exit;
}

$stmt->close();
$con->close();
?>
