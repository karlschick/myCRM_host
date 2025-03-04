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
        <h1 style="font-size: 32px;">GESTIÓN FACTURAS</h1>
      </div>
      <div class="card">
        <div class="card-body">
          <a href="factcliente.php" class="btn btn-danger btn-lg" role="button" aria-pressed="true">Ingresar factura</a>
          <a href="facturas.php" class="btn btn-primary active btn-lg" role="button" aria-pressed="true">Ver facturas pendientes</a>
          <a href="consultarf.php" class="btn btn-primary active btn-lg" role="button" aria-pressed="true">Consultar facturas</a>
          <a href="../excel/excelFactura.php" class="btn btn-success btn-lg">Exportar tabla a Excel</a>
          <?php

          include("conexion.php");

          $sql = "SELECT cliente.idCliente,factura.cliente_idCliente,cliente.documentoCliente,cliente.nombreCliente,factura.idFactura,factura.valorTotalFactura,factura.estadoFactura,factura.fechaVencimiento,factura.nPlan FROM cliente 
                    INNER JOIN factura
                    ON cliente.idCliente=factura.cliente_idCliente
                    WHERE estadoFactura='Pago'
                    ORDER BY fechaVencimiento ASC;";

          echo '<div class="table-responsive">
            <table class="table table-hover">
            <thead>
        <tr>
        <th> Documento Cliente </th>
        <th> Nombre Cliente</th>
        <th> Fecha límite de pago</th>
        <th> Valor Total</th>
        <th> Estado factura</th>
        <th> Plan </th>
        <th> Consultas</th>
        <th> Pago</th>
    </tr>
    </thead>
    ';

          if ($rta = $con->query($sql)) {
            while ($row = $rta->fetch_assoc()) {
              $a = $row['idCliente'];
              $b = $row['cliente_idCliente'];
              $dc = $row['documentoCliente'];
              $nomc = $row['nombreCliente'];
              $idf = $row['idFactura'];
              $st = $row['valorTotalFactura'];
              $estf = $row['estadoFactura'];
              $ffact = $row['fechaVencimiento'];
              $nplan = $row['nPlan']


          ?>
              <tr>
                <td> <?php echo "$dc" ?></td>
                <td> <?php echo "$nomc" ?></td>
                <td> <?php echo "$ffact" ?></td>
                <td> <?php echo "$st" ?></td>
                <td> <?php echo "$estf" ?></td>
                <td> <?php echo "$nplan" ?></td>
                <th>
                  <a href="verfacturaAdmin.php?id=<?php echo  $row['idFactura'] ?>" class="btn btn-info">ver factura</a>

                <th><a href="pend.php?id=<?php echo $row['idFactura']   ?>" class="borrar btn btn-danger">Regresar a pendiente</a></th>

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