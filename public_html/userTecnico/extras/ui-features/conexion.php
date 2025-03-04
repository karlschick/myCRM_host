<?php
    $host="localhost";
    $user="root";
    $pass="";

    $bd="atory";

    $con=mysqli_connect($host,$user,$pass,$bd);
    if(!$con){

        die("No se conecto a la base de datos ".mysqli_connect_error());
    
    } else {
        //echo " CONEXIÓN EXITOSA";
    }
    

?>
