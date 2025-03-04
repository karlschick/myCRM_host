<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion= $_SESSION['usuario'];
if ($varsesion == null || $varsesion='') {
    header ("location:../index.html");
    die();
    exit;
}

?>
<!DOCTYPE html>
<html>
    
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Atory Solutions</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.theme.default.min.css">

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.png">
  <style type="text/css">/* Chart.js */
@keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}</style></head>
  <body>
        <?php
        include '../menu/menuint.php';
        ?>

        <!-- partial -->

        <div class="main-panel">
          <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
            <div class="card-body">
            <a href="usuarios.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Volver al inicio</a>
            <?php
            
include("conexion.php");
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
    <th><a href="deleteUsuario.php?id=<?php echo $row['documentoUsuario'] ?>" class="btn btn-danger">Eliminar</a></th>
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
    
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
  
<div class="jvectormap-tip"></div>
<!-- Estas ultimas lineas son para la alerta DE BORRAR, INSERTA SWEET ALERT Y LUEGO ESTA EL SCRIPT PARA BORRAR-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('.borrar').on('click', function(e) {
            e.preventDefault();
            var self = $(this);
            console.log(self.data('title'));
            Swal.fire({
                title: 'Esta seguro que desea continuar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'No',
                background: '#34495E'
            }).then((result) => {
                if (result.isConfirmed) {
                    
                    location.href = self.attr('href');
                }
            })
        })
    </script>
</body>
</html>


