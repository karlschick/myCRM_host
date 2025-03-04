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
</head>

<body>
  <?php
  include '../menu/menuint.php';
  ?>
  <!-- partial -->


  <div class="main-panel">

    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <h1 style="font-size: 32px;">ATENCION AL CLIENTE</h1>
      <div class="card">
        <div class="card-body">


          <a href="../principal.php" class="btn btn-primary " role="button" aria-pressed="true">Volver al inicio</a>

          <a href="../excel/excelPQR.php" class="btn btn-success">Exportar tabla a Excel</a>
          <?php

          include("conexion.php");

          $sql = "SELECT * FROM pqr2 WHERE estadoPqr='Activo';";

          echo '<div class="table-responsive">
            <table class="table table-hover">
            <thead>
        <tr>
        <th> Id PQR </th>
        <th> Tipo de documento</th>
        <th> Numero de documento</th>
        <th> Nombres de cliente</th>
        <th> Tipo de PQR </th>
        <th> Consultar PQR</th>
        <th> Comentario</th>
        <th> Eliminar</th>
    </tr>
    </thead>
    ';

          if ($rta = $con->query($sql)) {
            while ($row = $rta->fetch_assoc()) {
              $i = $row['idPqr'];
              $td = $row['tipoDocumento'];
              $id = $row['nDocumento'];
              $nombres = $row['nombresCliente'];
              $tel = $row['telefonoCliente'];
              $email = $row['emailCliente'];
              $soli = $row['tPqr'];
              $dp = $row['desPqr'];
              $epqr = $row['estadoPqr'];
              $com = $row['comentario'];
          ?>
              <tr>
                <td> <?php echo "$i" ?></td>
                <td> <?php echo "$td" ?></td>
                <td> <?php echo "$id" ?></td>
                <td> <?php echo "$nombres" ?></td>
                <td> <?php echo "$soli" ?></td>

                <th><a href="consultarpqr.php?i=<?php echo $row['idPqr'] ?>" class="btn btn-primary">Consultar</a></th>
                <th><a href="comentario.php?i=<?php echo $row['idPqr'] ?>" class="btn btn-info">Agregar comentario </a></th>
                <th><a href="eliminarpqr.php?i=<?php echo $row['idPqr'] ?>" class="borrar btn btn-danger">Archivar contacto</a></th>

              </tr>
          <?php
            }
          }

          ?>

          <!-- ESTO ES LO QUE PODEMO  S MODIFICAR -->

        </div>
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