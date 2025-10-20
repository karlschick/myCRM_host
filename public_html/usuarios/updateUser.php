<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

// Sanitizar helper
function clean($v) {
    return isset($v) ? trim($v) : null;
}

$id = clean($_POST['id'] ?? '');
if (!$id) {
    die("Error: ID de usuario no recibido.");
}

// ------------------ FOTO ------------------
$carpetaDestino = __DIR__ . '/../../public_html/assets/images/faces-clipart/';
if (!file_exists($carpetaDestino)) mkdir($carpetaDestino, 0755, true);

// Obtener foto actual
$sql_foto = $con->prepare("SELECT foto FROM usuario WHERE idUsuario=?");
$sql_foto->bind_param("i", $id);
$sql_foto->execute();
$res = $sql_foto->get_result()->fetch_assoc();
$fotoActual = $res['foto'] ?: 'pic-1.png';
$sql_foto->close();

$nombreArchivoFinal = $fotoActual;

if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
    $fotoTmp = $_FILES['foto']['tmp_name'];
    $fotoNombre = basename($_FILES['foto']['name']);
    $ext = strtolower(pathinfo($fotoNombre, PATHINFO_EXTENSION));
    $permitidas = ['jpg','jpeg','png','gif'];

    if (in_array($ext, $permitidas)) {
        if ($_FILES['foto']['size'] <= 2 * 1024 * 1024) {
            $nombreArchivoFinal = uniqid('user_') . '.' . $ext;
            $rutaDestino = $carpetaDestino . $nombreArchivoFinal;
            if (move_uploaded_file($fotoTmp, $rutaDestino)) {
                if ($fotoActual !== 'pic-1.png' && file_exists($carpetaDestino . $fotoActual)) {
                    unlink($carpetaDestino . $fotoActual);
                }
                $_SESSION['foto'] = $nombreArchivoFinal;
            } else {
                $nombreArchivoFinal = $fotoActual;
            }
        } else {
            die("Error: Imagen supera los 2MB.");
        }
    } else {
        die("Error: Formato de imagen no permitido.");
    }
}

// ------------------ CAMPOS ------------------
// Recoger campos del POST y sanitizar
$campos = [
    'tipoDocumento' => clean($_POST['tipoDocumento'] ?? ''),
    'documentoUsuario' => clean($_POST['documentoUsuario'] ?? ''),
    'nombresUsuario' => clean($_POST['nombresUsuario'] ?? ''),
    'telefonoUsuario' => clean($_POST['telefonoUsuario'] ?? ''),
    'telefonoUsuario_dos' => clean($_POST['telefonoUsuario_dos'] ?? ''),
    'telefonoUsuario_tres' => clean($_POST['telefonoUsuario_tres'] ?? ''),
    'correoUsuario' => clean($_POST['correoUsuario'] ?? ''),
    'direccionUsuario' => clean($_POST['direccionUsuario'] ?? ''),
    'ciudadUsuario' => clean($_POST['ciudadUsuario'] ?? ''),
    'departamentoUsuario' => clean($_POST['departamentoUsuario'] ?? ''),
    'paisUsuario' => clean($_POST['paisUsuario'] ?? ''),
    'codigoPostalUsuario' => clean($_POST['codigoPostalUsuario'] ?? ''),
    'contactoEmergenciaNombre' => clean($_POST['contactoEmergenciaNombre'] ?? ''),
    'contactoEmergenciaTelefono' => clean($_POST['contactoEmergenciaTelefono'] ?? ''),
    'contactoEmergenciaParentesco' => clean($_POST['contactoEmergenciaParentesco'] ?? ''),
    'referenciaPersonalNombre' => clean($_POST['referenciaPersonalNombre'] ?? ''),
    'referenciaPersonalTelefono' => clean($_POST['referenciaPersonalTelefono'] ?? ''),
    'fechaNacimiento' => clean($_POST['fechaNacimiento'] ?? ''),
    'estadoCivil' => clean($_POST['estadoCivil'] ?? ''),
    'numeroHijos' => clean($_POST['numeroHijos'] ?? ''),
    'cargo' => clean($_POST['cargo'] ?? ''),
    'area' => clean($_POST['area'] ?? ''),
    'fechaIngreso' => clean($_POST['fechaIngreso'] ?? ''),
    'tipoContrato' => clean($_POST['tipoContrato'] ?? ''),
    'salarioBase' => clean($_POST['salarioBase'] ?? ''),
    'supervisorId' => clean($_POST['supervisorId'] ?? ''),
    'idEmpresa' => clean($_POST['idEmpresa'] ?? ''),
    'idSucursal' => clean($_POST['idSucursal'] ?? ''),
    'estadoLaboral' => clean($_POST['estadoLaboral'] ?? ''),
    'ultimoLogin' => clean($_POST['ultimoLogin'] ?? ''),
    'intentosFallidos' => clean($_POST['intentosFallidos'] ?? ''),
    'tokenRecuperacion' => clean($_POST['tokenRecuperacion'] ?? ''),
    'tokenExpira' => clean($_POST['tokenExpira'] ?? ''),
    'twoFactorEnabled' => isset($_POST['twoFactorEnabled']) ? 1 : 0,
    'estadoUsuario' => clean($_POST['estadoUsuario'] ?? ''),
    'rol' => clean($_POST['rol'] ?? ''),
    'eliminado' => isset($_POST['eliminado']) ? 1 : 0,
    'eps' => clean($_POST['eps'] ?? ''),
    'arl' => clean($_POST['arl'] ?? ''),
    'fondoPension' => clean($_POST['fondoPension'] ?? ''),
    'banco' => clean($_POST['banco'] ?? ''),
    'numeroCuentaBancaria' => clean($_POST['numeroCuentaBancaria'] ?? ''),
    'foto' => $nombreArchivoFinal
];

// ------------------ CAMPOS OPCIONALES ------------------
// Actualizar user_usuario solo si se envió y no está vacío
if (isset($_POST['user_usuario']) && trim($_POST['user_usuario']) !== '') {
    $campos['user_usuario'] = trim($_POST['user_usuario']);
}

// Actualizar claveUsuario solo si se envió y no está vacío
if (!empty($_POST['claveUsuario'])) {
    $campos['claveUsuario'] = password_hash(trim($_POST['claveUsuario']), PASSWORD_DEFAULT);
}

// ------------------ QUERY DINÁMICA ------------------
$sets = [];
$valores = [];
$tipos = '';

foreach ($campos as $col => $valor) {
    $sets[] = "$col = ?";
    $valores[] = $valor;
    $tipos .= 's'; // todos string
}

$sql = "UPDATE usuario SET " . implode(", ", $sets) . " WHERE idUsuario = ?";
$valores[] = $id;
$tipos .= 'i';

$stmt = $con->prepare($sql);
if (!$stmt) {
    die("Error en prepare: " . $con->error);
}

$stmt->bind_param($tipos, ...$valores);

if ($stmt->execute()) {
    // Actualizar sesión si se cambió el login del usuario activo
    if (isset($campos['user_usuario']) && $_SESSION['usuario'] === $_POST['user_usuario']) {
        $_SESSION['usuario'] = $campos['user_usuario'];
    }
    echo '<script>alert("Usuario actualizado correctamente."); window.location.href="tablasUser.php";</script>';
} else {
    die("Error al actualizar: " . $stmt->error);
}

$stmt->close();
$con->close();


// ------------------ EJECUCIÓN ------------------
if ($stmt->execute()) {
    // Actualizar sesión si se cambió el login del usuario activo
    if (isset($_POST['user_usuario']) && $_SESSION['usuario'] === $_POST['user_usuario']) {
        $_SESSION['usuario'] = trim($_POST['user_usuario']);
    }

    echo '<script>alert("Usuario actualizado correctamente."); window.location.href="tablasUser.php";</script>';
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$stmt->close();
$con->close();
?>
