<?php
session_start();

// Mostrar errores solo en desarrollo (desactivar en producción)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Incluir la conexión centralizada
require_once __DIR__ . '/../../config/db.php';

// Verificar conexión a la base de datos
if (!$con) {
    header("location:errorvalid.php");
    exit;
}

// Verificar que los datos del formulario lleguen correctamente
if (!isset($_POST['usuario']) || !isset($_POST['pass'])) {
    header("location:errorvalid.php");
    exit;
}

// Sanitizar los datos de entrada
$usuario = trim($_POST['usuario']);
$password = trim($_POST['pass']);

// Validar que no estén vacíos
if (empty($usuario) || empty($password)) {
    header("location:errorvalid.php");
    exit;
}

// Preparar la consulta segura
$stmt = $con->prepare("SELECT rol, claveUsuario FROM usuario WHERE nombresUsuario = ?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$resultado = $stmt->get_result();

// Verificar si el usuario existe
if ($filas = $resultado->fetch_assoc()) {
    // Verificar contraseña cifrada con password_verify()
    if (password_verify($password, $filas['claveUsuario'])) {
        session_regenerate_id(true); // Prevención de secuestro de sesión
        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol'] = $filas['rol'];

        // Redirigir según el rol del usuario
        if ($filas['rol'] == 'Administrador') {
            header("location:../dashboard/principal.php");
        } elseif ($filas['rol'] == 'Tecnico') {
            header("location:../userTecnico/visitas/tablasVisitas.php");
        } else {
            header("location:errorvalid.php");
        }
        exit;
    }
}

// Si llegó aquí, hubo un error
header("location:errorvalid.php");
exit;

// Cerrar conexiones
$stmt->close();
$con->close();
?>
