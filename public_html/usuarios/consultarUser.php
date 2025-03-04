<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
    header("location:../index.php");
    die();
    exit;
}

// Incluye el encabezado de la página
include '../../includes/header.php';
?>

  <style type="text/css">/* Chart.js */
@keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}</style></head>
  <body>


        <!-- partial -->

        <div class="main-panel">
          <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
            <div class="card-body">
            <a href="usuarios.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Volver al inicio</a>
            <?php
            
            require_once __DIR__ . '/../../config/db.php';
$id=$_POST['id'];
$sql= "SELECT * FROM usuario WHERE documentoUsuario='$id';";

echo '<div class="table-responsive">
<table class="table table-hover">
    <thead>
        <tr>
            <th>Tipo ide</th>
            <th>Núm doc</th>
            <th>Nombres</th>
            <th>Teléfono</th>
            <th>Email</th>
            <th>Clave</th>
            <th>Estado</th>
            <th>Fecha creación</th>
            <th>Última Actual</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
    </thead>';

if($rta = $con -> query($sql)){
    while ($row = $rta -> fetch_assoc()){
        $td = $row['tipoDocumento'];
        $id = $row['documentoUsuario'];
        $nombres = $row['nombresUsuario'];
        $telefono = $row['telefonoUsuario'];
        $email = $row['correoUsuario'];
        $clave = $row['claveUsuario'];
        $estado = $row['estadoUsuario'];
        $creacion = $row['creado'];
        $act = $row['ultimaActualizacion'];
?>
<tr>
    <td> <?php  echo "$td"?></td>    
    <td> <?php  echo "$id"?></td> 
    <td> <?php  echo "$nombres"?></td> 
    <td> <?php  echo "$telefono"?></td> 
    <td> <?php  echo "$email"?></td> 
    <td> <?php  echo "$clave"?></td> 
    <td> <?php  echo "$estado"?></td> 
    <td> <?php  echo "$creacion"?></td> 
    <td> <?php  echo "$act"?></td> 
    <th>
    <a href="updateUser.php?id=<?php echo $row['documentoUsuario'] ?>" class="btn btn-info">Editar</a></th>
    </th>
    <th>
    <th><a href="../delete.php?id=<?php echo $row['documentoUsuario'] ?>" class="btn btn-danger">Eliminar</a></th>
    </th>
</tr>
<?php
}
}

?>

          <!-- ESTO ES LO QUE PODEMOS MODIFICAR -->
          <!-- partial:partials/_footer.html -->
          
          <!-- partial -->
        </div>

        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    
    
    </div>
    

  
<div class="jvectormap-tip"></div>
</body>
</html>

