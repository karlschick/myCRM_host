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

<!-- CODIGO HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php
            include("conexion.php");
            $id=$_GET['id'];
            $sql="SELECT * FROM usuario WHERE documentoUsuario='$id'";
            $query=mysqli_query($con,$sql);
            $row=mysqli_fetch_array($query);
    ?>
    <title>ATORY - Admin</title>
    <!-- Estilos de los plugins -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- Fin de los estilos de los plugins -->
    <!-- Estilos del archivo actual -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Fin de los estilos del archivo actual -->
    <link rel="shortcut icon" href="../assets/images/favicon.png">
</head>
<body>
        <?php
        include '../menu/menuint.php';
        ?>

        <!-- partial -->


        <div class="main-panel">
          <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
            <div class="card-body">
                    <h4 class="card-title">GESTION DE USUARIOS</h4>
                    <p class="card-description"> Ingrese los datos del Usuario</p>
                    <form action="update.php" method="POST">
                <input type="hidden" name="id" value="<?php echo $row['documentoUsuario']  ?>">
                <select class="form-select" aria-label="Default select example"name="td" id= "td"value="<?php echo $row['tipoDocumento']  ?>">
                        <option value="C.C">C.C</option>
                        <option value="C.E">C.E</option>
                        <option value="R.C">R.C</option>
                        <option value="T.I">T.I</option>
                        </select>
                    <input type="text" class="form-control mb-3" name="id" placeholder="Numero documento" value="<?php echo $row['documentoUsuario']  ?>">
                    <input type="text" class="form-control mb-3" name="nombre" placeholder="Nombres Completos" value="<?php echo $row['nombresUsuario']  ?>">
                    <input type="text" class="form-control mb-3" name="tel" placeholder="Ingrese telefono" value="<?php echo $row['telefonoUsuario']  ?>">
                    <input type="text" class="form-control mb-3" name="email" placeholder="Ingrese correo electronico" value="<?php echo $row['correoUsuario']  ?>">
                    <input type="text" class="form-control mb-3" name="clave" placeholder="clave" value="<?php echo $row['claveUsuario']  ?>">
                    <select class="form-select" aria-label="Default select example" name="estado" id= "estado" value="<?php echo $row['estadoUsuario']  ?>">  
                        <option value="Activo">Activo </option>
                        <option value="Inactivo">Inactivo</option>

                    </select>
                    <input type="date" class="form-control mb-3" name="creacion" placeholder="fecha de creacion" value="<?php echo $row['creado']  ?>">   
                    <input type="date" class="form-control mb-3" name="act" placeholder="ultima actualizacion" value="<?php echo $row['ultimaActualizacion']  ?>">
                    <select class="form-select" aria-label="Default select example" name="rol" id= "rol" value="<?php echo $row['rol']  ?>">  
                        <option value="Administrador">Administrador </option>
                        <option value="Tecnico">Tecnico</option>
                        <option value="Vendedor">Vendedor</option>

                    </select>
                                                         
                <input type="submit" class="btn btn-primary btn-block" value="Actualizar"formmethod="post"formaction=updateUser.php>
            </form>
            
            <div class="row">
              <div>
                <div>
                  
                </div>
              </div>
              
            </div>
            
            
            
            
          </div>
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
</body>
</html>

