<?php
function cargarEnv($archivo) {
    if (!file_exists($archivo)) {
        return [];
    }

    $variables = [];
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lineas as $linea) {
        if (strpos(trim($linea), '#') === 0) continue; // Ignorar comentarios

        list($nombre, $valor) = explode('=', $linea, 2);
        $variables[trim($nombre)] = trim($valor);
    }

    return $variables;
}

$env = cargarEnv(__DIR__ . '/../.env'); // Cargar el archivo .env

return [
    'DB_HOST' => $env['DB_HOST'] ?? 'localhost',
    'DB_USER' => $env['DB_USER'] ?? 'root',
    'DB_PASS' => $env['DB_PASS'] ?? '',
    'DB_NAME' => $env['DB_NAME'] ?? 'atory'
];
?>
