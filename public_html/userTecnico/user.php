<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion= $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header ("location:index.html");
    die();
    exit;
}

/* 
include "login/claseSeguridad.php";

$seguridad = new Seguridad();
if ($seguridad->getUsuario()==null) {
    header ('location:index.html');
}
*/
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <body>

        <div class="container mt-5">
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-md-8">
            <form id="regForm">
            <h1 id="register" style= "color: #000000">CLIENTES</h1>
                <h1 id="register" style= "color: #000000"> Gestion de clientes</h1>


                <div class="form-group col-md-8">
                    <h3>Identificacion que desea eliminar</h3>
                    <p><input placeholder="Ingrese su identificacion" oninput="this.className = ''" name="id"></p>
                </div>

                
                <div class="form-button mt-5">
                    <button id="submit" type="submit" formmethod="post" formaction="consultar.php" class="btn btn-primary">Consular</button>
                </div>

                <div class="form-button mt-5">
                    <button id="submit" type="submit" formmethod="post" formaction="ingresar.html" class="btn btn-primary">Ingresar nuevo cliente</button>
                </div>
                <div class="form-button mt-5">
                    <button id="submit" type="submit" formmethod="post" formaction="tablas.php" class="btn btn-primary"> Ver tabla de clientes </button>
                </div>
   
            </form>
        </div>
    </div>
</div>

</body