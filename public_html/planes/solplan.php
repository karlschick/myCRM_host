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
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->

    <div class="main-panel">
      <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
        <form action="../index.html">
          <input type="submit" value="Volver al inicio" class="btn btn-primary btn-lg" />
        </form>
        <div class="card-body">
          <h4 class="card-title">Solicitar uno de nuestros productos.</h4>
          <p class="card-description"> Ingrese sus datos para ponernos en contacto</p>
          <form class="forms-sample">

            <div class="form-group">
              <label for="td">Seleccione tipo de documento</label>
              <select class="form-control" name="td" id="td" required>
                <option value="C.C">C.C</option>
                <option value="C.E">C.E</option>
                <option value="R.C">R.C</option>
                <option value="T.I">T.I</option>
              </select>
            </div>

            <div class="form-group">
              <label for="id">Ingrese documento</label>
              <input type="text" class="form-control" name="id" id="id" placeholder="Numero de documento" required>
            </div>


            <div class="form-group">
              <label for="nombre">Ingrese nombres y apellidos</label>
              <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese nombre" required>
            </div>



            <div class="form-group">
              <label for="tel">Ingrese numero de telefono</label>
              <input type="text" class="form-control" name="tel" id="tel" placeholder="Numero de telefono" required>
            </div>


            <div class="form-group">
              <label for="email">Ingrese correo electronico</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Correo electronico" required>
            </div>

            <div>
              <br>
              <button id="submit" type="submit" formmethod="post" formaction="enviarplan.php" class="btn btn-primary">Enviar</button>


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