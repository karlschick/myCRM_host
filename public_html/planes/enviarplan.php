    <!-- actualizado -->

    <?php

// Incluye el encabezado de la página
include '../../includes/header.php';
?>


<body>
  <div class="container-scroller">

    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
        <!-- Logo de Atory -->
        <a class="sidebar-brand brand-logo" href="index.html">
          <img src="../assets/images/atori.png" alt="logo">
        </a>
        <!-- Volver a inicio -->
        <a class="sidebar-brand brand-logo-mini" href="index.php">
          <img src="../assets/images/logo-mini.png" alt="logo">
        </a>
      </div>
      <ul class="nav">
        <li class="nav-item menu-items">
          <a class="nav-link" href="../pqr/pqr.php">
            <span class="menu-icon">
              <i class="mdi mdi-contacts"></i>
            </span>
            <span class="menu-title">Contacto exitoso </span>
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


      $nombre = $_POST["nombre"];
      $tel = $_POST["tel"];
      $email = $_POST["email"];
      $sql = "INSERT INTO solicitudes (nombres, telefono, email)
        VALUES ('$nombre','$tel','$email')";
      if ($con->query($sql) === TRUE) {
      } else {
        echo "Error al guardar los datos: " . $con;
      }

      $con->close();

      ?>
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="page-header">
          <div style="text-align: center;">
                <img class="logo" src="../assets/images/empresa/logoEmpresa.png" alt="logo" style="max-width: 40%; height: auto" class="img-responsive" />

            <h3 class="page-title">Gracias por interesarte en nuestros productos</h3>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Muchas gracias por ponerte en contacto con nosotros, estimado <?php echo "$nombre" ?></h4>
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="cp"> Hemos recibido su solicitud y uno de nuestros agente se contactará con usted en poco tiempo.</label>
                    </div>
                    <div class="form-group">
                      <label for="vel">Nos contactaremos con usted a su número de telefono <?php echo "$tel" ?> o correo <?php echo "$email" ?>. </label>
                    </div>
                    <div class="form-group">
                      <label for="plan">Tenga un feliz dia, y gracias por elegirnos.</label>
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