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

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Atory Solutions</title>

  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="../assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="../assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="../assets/vendors/owl-carousel-2/owl.theme.default.min.css">

  <link rel="stylesheet" href="../assets/css/style.css">

  <link rel="shortcut icon" href="../assets/images/favicon.png">

</head>

<body>
  <?php
  include '../menu/menuint.php';
  ?>



  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <div class="page-header">
        <h1 style="font-size: 32px;">GESTIÓN INVENTARIO</h1>
      </div>
      <div class="card">
        <div class="card-body">

          <a href="inactivosinv.php" class="btn btn-danger btn-lg">Consutlar productos inactivos.</a>
          <a href="../excel/excelInventario.php" class="btn btn-success btn-lg">Exportar tabla a Excel</a>
          <a href="ingresarp.php" class="btn btn-info btn-lg">Ingresar nuevo producto</a>

          <?php

          include("conexion.php");

          $sql = "SELECT * FROM producto WHERE estadoProducto='Activo';";

          echo '<div class="table-responsive">
            <table class="table table-hover">
            <thead>
        <tr>
        <th> Id Producto </th>
        <th> Nombre Producto</th>
        <th> Serial del producto</th>
        <th> Descripcion del producto</th>
        <th> Cantidad en bodega </th>
        <th> Editar producto</th>
        <th> Eliminar</th>
    </tr>
    </thead>
    ';

          if ($rta = $con->query($sql)) {
            while ($row = $rta->fetch_assoc()) {
              $id = $row['idProducto'];
              $nombrep = $row['nombreProducto'];
              $serial = $row['serialProducto'];
              $desp = $row['descripcionProducto'];
              $cantidad = $row['cantidad'];
              $estado = $row['estadoProducto'];
          ?>
              <tr>
                <td> <?php echo "$id" ?></td>
                <td> <?php echo "$nombrep" ?></td>
                <td> <?php echo "$serial" ?></td>
                <td> <?php echo "$desp" ?></td>
                <td> <?php echo "$cantidad" ?></td>
                <th>
                  <a href="actinv.php?id=<?php echo $row['idProducto'] ?>" class="btn btn-primary"> Editar Producto </a>
                </th>


                <th><a href="elmproducto.php?id=<?php echo $row['idProducto'] ?>" class="borrar btn btn-danger">Eliminar</a></th>

              </tr>
          <?php
            }
          }

          ?>


        </div>
      </div>

    </div>


  </div>


  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>

  <script src="../assets/vendors/chart.js/Chart.min.js"></script>
  <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>

  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>

  <script src="../assets/js/dashboard.js"></script>


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