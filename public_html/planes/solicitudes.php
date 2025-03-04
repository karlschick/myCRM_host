<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
    header("location:../index.html");
    die();
    exit;
}

// Incluye el encabezado de la página
include '../../includes/header.php';
?>
<body>
  
    <?php include '../../includes/menu.php'; ?>
  
  <!-- partial -->


  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <div class="card">
        <div class="card-body">
          <a href="atentidas.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Consultar solicitudes atendidas</a>
          <?php

          require_once __DIR__ . '/../../config/db.php';

          $sql = "SELECT * FROM solicitudes WHERE estadoSolicitud='Activo';";

          echo '<div class="table-responsive">
            <table class="table table-hover">
            <thead>
        <tr>
        <th> Id Solicitud </th>
        <th> Nombres del cliente</th>
        <th> Telefono </th>
        <th> Correo CLiente </th>
        <th> Responder solicitud</th>
    </tr>
    </thead>
    ';

          if ($rta = $con->query($sql)) {
            while ($row = $rta->fetch_assoc()) {
              $i = $row['idSolicitud'];
              $nombres = $row['nombres'];
              $tel = $row['telefono'];
              $email = $row['email'];
              $epqr = $row['estadoSolicitud'];
          ?>
              <tr>
                <td> <?php echo "$i" ?></td>
                <td> <?php echo "$nombres" ?></td>
                <td> <?php echo "$tel" ?></td>
                <td> <?php echo "$email" ?></td>

                <th><a href="elisoli.php?i=<?php echo $row['idSolicitud'] ?>" class="btn btn-danger">Responder</a></th>
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
      </div>

      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->


  </div>


</body>

</html>