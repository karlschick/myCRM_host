<?php
/**
 * Genera un listado de la estructura del proyecto:
 * - Archivos y carpetas fuera de public_html
 * - Archivos y carpetas dentro de public_html (solo las incluidas)
 * - Excluye subcarpetas específicas
 * - Agrega mensaje final
 */

// === CONFIGURACIÓN ===

// Carpetas dentro de public_html que quieres incluir
$carpetas_public_html = [
    'assets',
    'clientes',
    'consultas',
    'dashboard',
    'empresa',
    'excel',
    'facturacion',
    'inventario',
    'login',
    'planes',
    'pqr',
    'usuarios',
    'visitas'
];

// Carpetas fuera de public_html (nivel superior)
$carpetas_superiores = [
    'baseDatos',
    'config',
    'errors',
    'includes'
];

// 🔴 Carpetas que quieres EXCLUIR (rutas relativas)
$carpetas_excluidas = [
    'public_html/assets/vendors',
    'public_html/assets/js',
    'public_html/assets/scss',
    'public_html/assets/fonts'
];

// Archivo de salida
$archivo_salida = __DIR__ . '/estructura_completa.txt';

/**
 * Función recursiva para listar estructura de carpetas y archivos
 */
function listarCarpeta($ruta, $prefijo = "│   ", &$salida = "", $carpetas_excluidas = [])
{
    if (!is_dir($ruta)) return;

    $archivos = scandir($ruta);
    foreach ($archivos as $archivo) {
        if ($archivo === '.' || $archivo === '..') continue;

        $path = $ruta . DIRECTORY_SEPARATOR . $archivo;
        $relativa = str_replace('\\', '/', $path);

        // Saltar carpetas excluidas
        foreach ($carpetas_excluidas as $excluida) {
            if (stripos($relativa, $excluida) !== false) {
                continue 2;
            }
        }

        $salida .= $prefijo . "│── " . $archivo . PHP_EOL;

        if (is_dir($path)) {
            listarCarpeta($path, $prefijo . "│   ", $salida, $carpetas_excluidas);
        }
    }
}

/**
 * 🔹 Listar archivos sueltos en una carpeta
 */
function listarArchivosSueltos($rutaBase, &$salida, $excluir = [])
{
    if (!is_dir($rutaBase)) return;

    $archivos = scandir($rutaBase);
    foreach ($archivos as $archivo) {
        if ($archivo === '.' || $archivo === '..' || in_array($archivo, $excluir)) continue;

        $path = $rutaBase . DIRECTORY_SEPARATOR . $archivo;
        if (is_file($path)) {
            $salida .= "│── " . $archivo . PHP_EOL;
        }
    }
}

// === GENERAR ESTRUCTURA ===
$salida = "Estructura general del proyecto" . PHP_EOL;
$salida .= str_repeat("─", 40) . PHP_EOL . PHP_EOL;

// 📁 Archivos sueltos en la raíz del proyecto
$salida .= "/ (raíz del proyecto)" . PHP_EOL;
listarArchivosSueltos(__DIR__, $salida, ['listar.php', 'estructura_completa.txt']);
$salida .= "│" . PHP_EOL;

// 📂 Carpetas superiores (fuera de public_html)
foreach ($carpetas_superiores as $carpeta) {
    if (is_dir($carpeta)) {
        $salida .= "│── " . $carpeta . "/" . PHP_EOL;
        listarCarpeta($carpeta, "│   ", $salida, $carpetas_excluidas);
    } else {
        $salida .= "│── " . $carpeta . " (no existe)" . PHP_EOL;
    }
}

$salida .= "│" . PHP_EOL;

// 📦 Contenido de public_html
$salida .= "/public_html (proyecto CRM)" . PHP_EOL;

// Archivos sueltos dentro de public_html
listarArchivosSueltos(__DIR__ . '/public_html', $salida, ['listar.php', 'estructura_completa.txt']);
$salida .= "│" . PHP_EOL;

// Carpetas incluidas dentro de public_html
foreach ($carpetas_public_html as $carpeta) {
    $ruta = __DIR__ . "/public_html/" . $carpeta;
    if (is_dir($ruta)) {
        $salida .= "│── " . $carpeta . "/" . PHP_EOL;
        listarCarpeta($ruta, "│   ", $salida, $carpetas_excluidas);
    } else {
        $salida .= "│── " . $carpeta . " (no existe)" . PHP_EOL;
    }
}

// Mensaje final
$salida .= "│" . PHP_EOL;
$salida .= "└── Fin del proyecto" . PHP_EOL;

// === SALIDA ===
header("Content-Type: text/plain; charset=utf-8");
echo $salida;
file_put_contents($archivo_salida, $salida);
