<?php

ob_start(); // Inicia el buffer de salida

$config = include __DIR__ . '/config.php'; // Cargar configuración desde config.php

$host = $config['DB_HOST'];
$user = $config['DB_USER'];
$pass = $config['DB_PASS'];
$bd   = $config['DB_NAME'];

$con = mysqli_connect($host, $user, $pass, $bd);

if (!$con) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
