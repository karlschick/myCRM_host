<?php
require_once __DIR__ . '/../../config/db.php';

    $rz=$_POST['rz'];
    $nombEmpresa=$_POST['nombEmpresa'];
    $nit=$_POST['nit'];
    $crc=$_POST['crc'];
    $nombrepleg=$_POST['nombrepleg'];
    $docurepleg=$_POST['docurepleg'];
    $dirsede=$_POST['dirsede'];
    $telsede=$_POST['telsede'];
    $telsede2=$_POST['telsede2'];
    $email=$_POST['email'];
    $paginaWeb=$_POST['paginaWeb'];
    $fechaConstitucion=$_POST['fechaConstitucion'];

    $sql="UPDATE empresa SET rz = '$rz', nombEmpresa='$nombEmpresa', nit='$nit', crc='$crc', nombrepleg='$nombrepleg', docurepleg='$docurepleg',dirsede='$dirsede',telsede='$telsede',telsede2='$telsede2',email='$email', paginaWeb='$paginaWeb',fechaConstitucion='$fechaConstitucion' WHERE id='1'; " ;
    $query=mysqli_query($con,$sql);
    if($query){
        Header("Location: verempresa.php");
    }
?>