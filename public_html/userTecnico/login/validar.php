<?php
$usuario=$_POST['usuario'];
$password=$_POST['pass'];
session_start();
$_SESSION['usuario']=$usuario;

$conn=mysqli_connect ("localhost","root","","atory");

$consulta="SELECT * FROM usuario where nombresUsuario='$usuario' and claveUsuario='$password'";
$resultado=mysqli_query($conn,$consulta);

$filas=mysqli_fetch_array($resultado);

if ($filas['rol'] == 'Administrador') {// que pasa cuando entra en rol administrador
  header("location:../principal.php");
  exit;
}elseif ($filas['rol'] == 'Tecnico') {// que pasa cuando entra en rol tecnico
  header("location:../principal.php");
  exit;
}{
  ?>
  <?php
  header ("location:errorvalid.php");
  exit;
  
  
}
mysqli_free_result($resultado);
mysqli_close($conn);
