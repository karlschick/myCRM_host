    <!-- actualizado -->

    <?php
// Seguridad de sesiones (prueba 1)
session_start();
error_reporting(0);

// Verifica si el usuario tiene una sesión activa
$varsesion = $_SESSION['usuario'];
if (empty($varsesion)) {
    header("Location: ../index.php");
    die(); // No es necesario usar exit después de die()
}

// Incluye el encabezado de la página
include '../../includes/header.php';
?>
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
        require_once __DIR__ . '/../../config/db.php';

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
                    <button id="submit" type="submit" formmethod="post" formaction="../index.php" class="btn btn-primary">Volver al inicio.</button>
                </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>

</div>
        </div>
      </div>
    </div>
  </body>
</html>