<?php
// public_html/dashboard/functions/dashboard_functions.php
// Funciones auxiliares para el dashboard

// Intentar cargar la conexión si no existe
if (!isset($con)) {
    $dbPath = __DIR__ . '/../../config/db.php';
    if (file_exists($dbPath)) {
        require_once $dbPath;
    } else {
        // Si no hay conexión, salimos sin tirar error para no romper la vista.
        return;
    }
}

/**
 * contarRegistros($tabla)
 * Devuelve el conteo de registros de la tabla indicada.
 * @param string $tabla Nombre de la tabla (se sanitiza)
 * @return int
 */
function contarRegistros($tabla) {
    global $con;
    if (!isset($con)) return 0;

    // Sanitizar nombre de tabla (solo letras, números y guion bajo)
    $tabla_safe = preg_replace('/[^a-z0-9_]/i', '', $tabla);
    if (empty($tabla_safe)) return 0;

    $sql = "SELECT COUNT(*) AS total FROM `{$tabla_safe}`";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        return (int)($row['total'] ?? 0);
    }
    return 0;
}

/**
 * obtenerConteos(array $tablas)
 * Recibe un array ['NombreVisible' => 'tabla'] o ['tabla', ...]
 * y devuelve un array asociativo con los conteos.
 */
function obtenerConteos(array $tablas) {
    $out = [];
    foreach ($tablas as $key => $val) {
        if (is_string($key)) {
            $nombre = $key;
            $tabla = $val;
        } else {
            $nombre = $val;
            $tabla = $val;
        }
        $out[$nombre] = contarRegistros($tabla);
    }
    return $out;
}
