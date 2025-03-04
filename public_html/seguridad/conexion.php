<?php
    $host="localhost";
    $user=""u480925299_root";
    $pass="Administrator2025*";
    $bd="u480925299_atory2025";

$con = mysqli_connect($host, $user, $pass, $bd);
if (!$con) {

    die("No se conecto a la base de datos " . mysqli_connect_error());
} else {
    /*echo " CONEXIÓN EXITOSA";*/
}
