<?php
$host = "pink-monkey-303866.hostingersite.com";
$User = "u480925299_root";
$pass = "Administrator2025*";
$db = "u480925299_atory2025";

$conexion = mysqli_connect($host, $User, $pass, $db);

if (!$conexion) {  // Se usa la variable correcta
    die("Conexión fallida: " . mysqli_connect_error());
} else {
    echo "Conexión exitosa.";
}
?>
