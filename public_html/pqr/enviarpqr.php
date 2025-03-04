<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Atory Solution</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End Plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
                <!-- Logo de Atory -->
                <a class="sidebar-brand brand-logo" href="index.html">
                    <img src="../assets/images/atori.png" alt="logo">
                </a>
                <!-- Volver a inicio -->
                <a class="sidebar-brand brand-logo-mini" href="index.html">
                    <img src="../assets/images/logo-mini.png" alt="logo">
                </a>
            </div>
            <ul class="nav">
                <li class="nav-item menu-items">
                    <a class="nav-link" href="../pqr/pqr.html">
                        <span class="menu-icon">
                            <i class="mdi mdi-contacts"></i>
                        </span>
                        <span class="menu-title">Solicitud enviarda exitosamente. </span>
                    </a>
                </li>
            </ul>
        </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:../../partials/_navbar.html -->
        <!-- partial -->
        <?php 
        include_once "conexion.php";

        $td=$_POST["td"];
        $id=$_POST["id"];
        $nombre=$_POST["nombre"];
        $tel=$_POST["tel"];
        $email=$_POST["email"];
        $soli=$_POST["soli"];
        $dc=$_POST["dc"];
        $sql="INSERT INTO pqr2 (tipoDocumento, nDocumento, nombresCliente, telefonoCliente, emailCliente, tPqr, desPqr)
        VALUES ('$td','$id','$nombre','$tel','$email','$soli','$dc')";
        if ($con->query($sql) === TRUE) {
          } else {
            echo "Error al guardar los datos: " . $con;
          }
          
          $con->close();
                        
             ?>         
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header">
              <h3 class="page-title">Solicitud enviada satisfactoriamente.</h3>
            </div>
         <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Muchas gracias por escribirnos <?php echo "$nombre"?></h4>
                    <form class="forms-sample">
                    <div class="form-group">
                        <label for="cp"> Su solicitud tipo  <?php echo "$soli" ?>, fue enviada satisfactoriamente.</label>
                      </div>
                      <div class="form-group">
                        <label for="vel">Nuestro equipo se contactara con usted a  <?php echo "$tel" ?> o <?php echo "$email" ?>. </label>
                      </div>
                      <div class="form-group">
                        <label for="plan">Tenga un feliz dia.</label>
                      </div>
                <div class="form-button mt-5">
                    <button id="submit" type="submit" formmethod="post" formaction="../index.html" class="btn btn-primary">Volver al inicio.</button>
                </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>


</div>
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
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
  </body>
</html>