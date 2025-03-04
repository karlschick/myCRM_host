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

  include 'conexion.php';

  $id = $_GET['id'];
  $sql = "SELECT * FROM producto WHERE idProducto='$id'";
  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);

  include '../menu/menuint.php';
  ?>



  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <h1 style="font-size: 32px;">GESTIÓN INVENTARIO</h1>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Actualizacion inventario </h4>
            <p class="card-description"> </p>
            <form action="../actplan.php" method="POST">

              <input type="hidden" name="id" value="<?php echo $row['idProducto']  ?>">
              <p class="card-description"> Nombre del producto: </p>
              <input type="text" class="form-control mb-3" name="nombrep" placeholder="Velocidad Plan" value="<?php echo $row['nombreProducto']  ?>">
              <p class="card-description"> Serial producto: </p>
              <input type="text" class="form-control mb-3" name="serial" placeholder="Nombre del Plan" value="<?php echo $row['serialProducto']  ?>">
              <p class="card-description"> Descripcion del producto: </p>
              <input type="text" class="form-control mb-3" name="desp" placeholder="Ingrese Valor del Plan" value="<?php echo $row['descripcionProducto']  ?>">
              <p class="card-description"> Cantidad: </p>
              <input type="text" class="form-control mb-3" name="cantidad" placeholder="Descripcion del plan" value="<?php echo $row['cantidad']  ?>">
              <p class="card-description"> Estado: </p>
              <select class="form-select" aria-label="Default select example" name="estadop" id="estadop" value="<?php echo $row['estadoProducto']  ?>">
                <option value="Activo">Activo </option>
                <option value="Inactivo">Inactivo</option>
              </select>
              <p></p>
              <input type="submit" class="btn btn-primary btn-lg" value="Actualizar" formmethod="post" formaction=updateinventario.php>
              <input type="submit" class="btn btn-danger btn-lg" value="Cancelar" formaction=tablasinventario.php>
            </form>

          </div>
        </div>

      </div>




    </div>

  </div>
  <footer class="footer">
    <div class="d-sm-flex justify-content-center justify-content-sm-between">

    </div>
  </footer>
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
</body>

</html>