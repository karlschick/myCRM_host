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
                    <h4 class="card-title">GESTION DE USUARIOS</h4>
                    <p class="card-description"> Ingrese los datos del usuarios</p>
                    <form class="forms-sample">
                      <!--tipo de documento-->
                      <div class="form-group">
                        <label for="td">Seleccione tipo de documento</label>
                        <select class="form-control" name="td" id="td">
                        <option value="C.C">C.C</option>
                        <option value="C.E">C.E</option>
                        <option value="R.C">R.C</option>
                        <option value="T.I">T.I</option>
                        </select>
                      </div>
                      <!--valor de documento-->
                      <div class="form-group">
                        <label for="id">Ingrese documento</label>
                        <input type="text" class="form-control"  name="id" id="id"  placeholder="Numero de documento">
                      </div>

                      <!--valor de nombres y apellidos-->
                      <div class="form-group">
                        <label for="nombre">Ingrese nombres y apellidos</label>
                        <input type="text" class="form-control"  name="nombre" id="nombre"  placeholder="Ingrese nombre">
                      </div>


                      <!--valor de numero de telefono-->
                      <div class="form-group">
                        <label for="tel">Ingrese numero de telefono</label>
                        <input type="text" class="form-control"  name="tel" id="tel"  placeholder="Numero de telefono">
                      </div>

                      <!--valor de email-->
                      <div class="form-group">
                        <label for="email">Ingrese correo electronico</label>
                        <input type="email" class="form-control"  name="email" id="email"  placeholder="Correo electronico">
                      </div>

                      <!--valor de pasword-->
                      <div class="form-group">
                        <label for="clave">Ingrese password</label>
                        <input type="text" class="form-control"  name="clave" id="clave"  placeholder="password">
                      </div>

                      <!--valor de estado del cliente-->
                      <div class="form-group">
                        <label for="estado">Seleccione el estado del usuario</label>
                        <select class="form-control" name="estado" id="estado">
                          <option value="Activo">Activo </option>
                          <option value="Archivado">Inactivo</option>
                        </select>
                      </div>


                      <!--valor de fecha creacion-->
                      <div class="form-group">
                        <label for="creacion">Ingrese fecha de creacion</label>
                        <input type="date" class="form-control"  name="creacion" id="creacion"  placeholder="">
                      </div>

                      <!--valor de ultima actualizacion-->
                      <div class="form-group">
                        <label for="act">Ingrese fecha ultima actualizacion</label>
                        <input type="date" class="form-control"  name="act" id="act"  placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="rol">Seleccione tipo de usuario</label>
                        <select class="form-control" name="rol" id="rol">
                        <option value="Administrador">administrativo</option>
                        <option value="Tecnico">tecnico</option>
                        <option value="Vendedor">vendedor</option>
                        </select>
                      </div>
                      <div>
                        <br>
                        <button id="submit" type="submit" formmethod="post" formaction="insertarUser.php" class="btn btn-primary">Guardar</button>
                        <button id="submit" type="submit" formmethod="post" formaction="tablasUser.php" class="btn btn-primary"> Volver al inicio </button>
                        
                      </div>
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

