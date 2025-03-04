<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Atory</title>
  <!-- Archivos de estilo de los plugins -->
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <!-- Fin de la inyección de estilos de los plugins -->
  <!-- Estilos personalizados para esta página -->
  <!-- Fin de la inyección de estilos personalizados -->
  <!-- Estilos de diseño -->
  <link rel="stylesheet" href="../assets/css/style.css">
  <!-- Fin de los estilos de diseño -->
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <?php
            require_once __DIR__ . '/../../config/db.php';

    // Consulta para obtener datos del plan con códigoPlan='1'
    $sql = "SELECT * FROM plan WHERE codigoPlan='1';";
    if ($rta = $con->query($sql)) {
      while ($row = $rta->fetch_assoc()) {
        $cp = $row['codigoPlan'];
        $vel = $row['velocidad'];
        $nplan = $row['nombrePlan'];
        $pplan = $row['precioPlan'];
        $des = $row['desPlan'];
        $estadop = $row['estadoPlan'];
        $tplan = $row['tipoPlan'];
      }
    }
    ?>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-6 grid-margin stretch-card" style="width: auto; height: 700px;">
            <div class="card" style="background: url('../assets/images/planes/fondoplanes.jpg') center center / cover no-repeat; border-radius: 20px; position: relative;">
              <div class="card-body text-dark">
                <h4 class="card-title text-dark" style="font-weight: bold; font-size: 25px;"><?php echo "$nplan" ?></h4>
                <img src="../assets/images/planes/20MEGAS.gif" alt="Descripción de la imagen" class="card-img-top" style="border-radius: 20px 20px 0 0; width: 80%; height: 50%; display: block; margin-left: auto; margin-right: auto;">
                <form class="forms-sample">
                  <div class="form-group">
                    <label for="cp" style="font-weight: bold; font-size: 20px;">Tipo de plan: <?php echo "$tplan" ?></label>
                  </div>
                  <div class="form-group">
                    <label for="vel" style="font-weight: bold; font-size: 16px;">Velocidad del plan: <?php echo "$vel" ?></label>
                  </div>
                  <div class="form-group">
                    <label for="plan" style="font-weight: bold; font-size: 16px;">Tiene un valor de: <?php echo " $pplan" ?></label>
                  </div>
                  <div class="form-group">
                    <label for="des" style="font-weight: bold; font-size: 16px;"><?php echo "$des" ?></label>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <?php
            require_once __DIR__ . '/../../config/db.php';

          // Consulta para obtener datos del plan con códigoPlan='2'
          $sql = "SELECT * FROM plan WHERE codigoPlan='2';";
          if ($rta = $con->query($sql)) {
            while ($row = $rta->fetch_assoc()) {
              $cp = $row['codigoPlan'];
              $vel = $row['velocidad'];
              $nplan = $row['nombrePlan'];
              $pplan = $row['precioPlan'];
              $des = $row['desPlan'];
              $estadop = $row['estadoPlan'];
              $tplan = $row['tipoPlan'];
            }
          }
          ?>
          <div class="col-md-6 grid-margin stretch-card" style="width: auto; height: 700px;">
            <div class="card" style="background: url('../assets/images/planes/fondoplanes.jpg') center center / cover no-repeat; border-radius: 20px; position: relative;">
              <div class="card-body text-dark">
                <h4 class="card-title text-dark" style="font-weight: bold; font-size: 25px;"><?php echo "$nplan" ?></h4>
                <img src="../assets/images/planes/50MEGAS.gif" alt="Descripción de la imagen" class="card-img-top" style="border-radius: 20px 20px 0 0; width: 80%; height: 50%; display: block; margin-left: auto; margin-right: auto;">
                <form class="forms-sample">
                  <div class="form-group">
                    <label for="cp" style="font-weight: bold; font-size: 20px;">Tipo de plan: <?php echo "$tplan" ?></label>
                  </div>
                  <div class="form-group">
                    <label for="vel" style="font-weight: bold; font-size: 16px;">Velocidad del plan: <?php echo "$vel" ?></label>
                  </div>
                  <div class="form-group">
                    <label for="plan" style="font-weight: bold; font-size: 16px;">Tiene un valor de: <?php echo " $pplan" ?></label>
                  </div>
                  <div class="form-group">
                    <label for="des" style="font-weight: bold; font-size: 16px;"><?php echo "$des" ?></label>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <?php
            require_once __DIR__ . '/../../config/db.php';

          // Consulta para obtener datos del plan con códigoPlan='3'
          $sql = "SELECT * FROM plan WHERE codigoPlan='3';";
          if ($rta = $con->query($sql)) {
            while ($row = $rta->fetch_assoc()) {
              $cp = $row['codigoPlan'];
              $vel = $row['velocidad'];
              $nplan = $row['nombrePlan'];
              $pplan = $row['precioPlan'];
              $des = $row['desPlan'];
              $estadop = $row['estadoPlan'];
              $tplan = $row['tipoPlan'];
            }
          }
          ?>
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card" style="width: auto; height: 700px;">
              <div class="card" style="background: url('../assets/images/planes/fondoplanes.jpg') center center / cover no-repeat; border-radius: 20px; position: relative;">
                <div class="card-body text-dark">
                  <h4 class="card-title text-dark" style="font-weight: bold; font-size: 25px;"><?php echo "$nplan" ?></h4>
                  <img src="../assets/images/planes/70MEGAS.gif" alt="Descripción de la imagen" class="card-img-top" style="border-radius: 20px 20px 0 0; width: 80%; height: 50%; display: block; margin-left: auto; margin-right: auto;">
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="cp" style="font-weight: bold; font-size: 20px;">Tipo de plan: <?php echo "$tplan" ?></label>
                    </div>
                    <div class="form-group">
                      <label for="vel" style="font-weight: bold; font-size: 16px;">Velocidad del plan: <?php echo "$vel" ?></label>
                    </div>
                    <div class="form-group">
                      <label for="plan" style="font-weight: bold; font-size: 16px;">Tiene un valor de: <?php echo " $pplan" ?></label>
                    </div>
                    <div class="form-group">
                      <label for="des" style="font-weight: bold; font-size: 16px;"><?php echo "$des" ?></label>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php
            require_once __DIR__ . '/../../config/db.php';

            // Consulta para obtener datos del plan con códigoPlan='4'
            $sql = "SELECT * FROM plan WHERE codigoPlan='4';";
            if ($rta = $con->query($sql)) {
              while ($row = $rta->fetch_assoc()) {
                $cp = $row['codigoPlan'];
                $vel = $row['velocidad'];
                $nplan = $row['nombrePlan'];
                $pplan = $row['precioPlan'];
                $des = $row['desPlan'];
                $estadop = $row['estadoPlan'];
                $tplan = $row['tipoPlan'];
              }
            }
            ?>
            <div class="col-md-6 grid-margin stretch-card" style="width: auto; height: 700px;">
              <div class="card" style="background: url('../assets/images/planes/fondoplanes.jpg') center center / cover no-repeat; border-radius: 20px; position: relative;">
                <div class="card-body text-dark">
                  <h4 class="card-title text-dark" style="font-weight: bold; font-size: 25px;"><?php echo "$nplan" ?></h4>
                  <img src="../assets/images/planes/120MEGAS.gif" alt="Descripción de la imagen" class="card-img-top" style="border-radius: 20px 20px 0 0; width: 80%; height: 50%; display: block; margin-left: auto; margin-right: auto;">
                  <form class="forms-sample">
                    <div class="form-group">
                      <label for="cp" style="font-weight: bold; font-size: 20px;">Tipo de plan: <?php echo "$tplan" ?></label>
                    </div>
                    <div class="form-group">
                      <label for="vel" style="font-weight: bold; font-size: 16px;">Velocidad del plan: <?php echo "$vel" ?></label>
                    </div>
                    <div class="form-group">
                      <label for="plan" style="font-weight: bold; font-size: 16px;">Tiene un valor de: <?php echo " $pplan" ?></label>
                    </div>
                    <div class="form-group">
                      <label for="des" style="font-weight: bold; font-size: 16px;"><?php echo "$des" ?></label>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php
            require_once __DIR__ . '/../../config/db.php';

            // Consulta para obtener datos del plan con códigoPlan='5'
            $sql = "SELECT * FROM plan WHERE codigoPlan='5';";
            if ($rta = $con->query($sql)) {
              while ($row = $rta->fetch_assoc()) {
                $cp = $row['codigoPlan'];
                $vel = $row['velocidad'];
                $nplan = $row['nombrePlan'];
                $pplan = $row['precioPlan'];
                $des = $row['desPlan'];
                $estadop = $row['estadoPlan'];
                $tplan = $row['tipoPlan'];
              }
            }
            ?>
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card" style="width: auto; height: 700px;">
                <div class="card" style="background: url('../assets/images/planes/fondoplanes.jpg') center center / cover no-repeat; border-radius: 20px; position: relative;">
                  <div class="card-body text-dark">
                    <h4 class="card-title text-dark" style="font-weight: bold; font-size: 25px;"><?php echo "$nplan" ?></h4>
                    <img src="../assets/images/planes/5MEGAS.gif" alt="Descripción de la imagen" class="card-img-top" style="border-radius: 20px 20px 0 0; width: 80%; height: 50%; display: block; margin-left: auto; margin-right: auto;">
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="cp" style="font-weight: bold; font-size: 20px;">Tipo de plan: <?php echo "$tplan" ?></label>
                      </div>
                      <div class="form-group">
                        <label for="vel" style="font-weight: bold; font-size: 16px;">Velocidad del plan: <?php echo "$vel" ?></label>
                      </div>
                      <div class="form-group">
                        <label for="plan" style="font-weight: bold; font-size: 16px;">Tiene un valor de: <?php echo " $pplan" ?></label>
                      </div>
                      <div class="form-group">
                        <label for="des" style="font-weight: bold; font-size: 16px;"><?php echo "$des" ?></label>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php
            require_once __DIR__ . '/../../config/db.php';

              // Consulta para obtener datos del plan con códigoPlan='6'
              $sql = "SELECT * FROM plan WHERE codigoPlan='6';";
              if ($rta = $con->query($sql)) {
                while ($row = $rta->fetch_assoc()) {
                  $cp = $row['codigoPlan'];
                  $vel = $row['velocidad'];
                  $nplan = $row['nombrePlan'];
                  $pplan = $row['precioPlan'];
                  $des = $row['desPlan'];
                  $estadop = $row['estadoPlan'];
                  $tplan = $row['tipoPlan'];
                }
              }
              ?>
              <div class="col-md-6 grid-margin stretch-card" style="width: auto; height: 700px;">
                <div class="card" style="background: url('../assets/images/planes/fondoplanes.jpg') center center / cover no-repeat; border-radius: 20px; position: relative;">
                  <div class="card-body text-dark">
                    <h4 class="card-title text-dark" style="font-weight: bold; font-size: 25px;"><?php echo "$nplan" ?></h4>
                    <img src="../assets/images/planes/150MEGAS.gif" alt="Descripción de la imagen" class="card-img-top" style="border-radius: 20px 20px 0 0; width: 80%; height: 50%; display: block; margin-left: auto; margin-right: auto;">
                    <form class="forms-sample">
                      <div class="form-group">
                        <label for="cp" style="font-weight: bold; font-size: 20px;">Tipo de plan: <?php echo "$tplan" ?></label>
                      </div>
                      <div class="form-group">
                        <label for="vel" style="font-weight: bold; font-size: 16px;">Velocidad del plan: <?php echo "$vel" ?></label>
                      </div>
                      <div class="form-group">
                        <label for="plan" style="font-weight: bold; font-size: 16px;">Tiene un valor de: <?php echo " $pplan" ?></label>
                      </div>
                      <div class="form-group">
                        <label for="des" style="font-weight: bold; font-size: 16px;"><?php echo "$des" ?></label>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php
            require_once __DIR__ . '/../../config/db.php';

              $sql = "SELECT * FROM plan WHERE codigoPlan='7';";
              if ($rta = $con->query($sql)) {
                while ($row = $rta->fetch_assoc()) {
                  $cp = $row['codigoPlan'];
                  $vel = $row['velocidad'];
                  $nplan = $row['nombrePlan'];
                  $pplan = $row['precioPlan'];
                  $des = $row['desPlan'];
                  $estadop = $row['estadoPlan'];
                  $tplan = $row['tipoPlan'];
                }
              }
              ?>
              <div class="row">
                <div class="col-md-6 grid-margin stretch-card" style="width: auto; height: 700px;">
                  <div class="card" style="background: url('../assets/images/planes/fondoplanes.jpg') center center / cover no-repeat; border-radius: 20px; position: relative;">
                    <div class="card-body text-dark">
                      <h4 class="card-title text-dark" style="font-weight: bold; font-size: 25px;"><?php echo "$nplan" ?></h4>
                      <img src="../assets/images/planes/10MEGAS.gif" alt="Descripción de la imagen" class="card-img-top" style="border-radius: 20px 20px 0 0; width: 80%; height: 50%; display: block; margin-left: auto; margin-right: auto;">
                      <form class="forms-sample">
                        <div class="form-group">
                          <label for="cp" style="font-weight: bold; font-size: 20px;">Tipo de plan: <?php echo "$tplan" ?></label>
                        </div>
                        <div class="form-group">
                          <label for="vel" style="font-weight: bold; font-size: 16px;">Velocidad del plan: <?php echo "$vel" ?></label>
                        </div>
                        <div class="form-group">
                          <label for="plan" style="font-weight: bold; font-size: 16px;">Tiene un valor de: <?php echo " $pplan" ?></label>
                        </div>
                        <div class="form-group">
                          <label for="des" style="font-weight: bold; font-size: 16px;"><?php echo "$des" ?></label>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="col-md-6 grid-margin stretch-card" style="width: auto; height: 700px;">
            <div class="card" style="background: url('../assets/images/planes/fondoplanes.jpg') center center / cover no-repeat; border-radius: 20px; position: relative;">
              <div class="card-body text-dark">
                <form class="forms-sample">
                <div class="card-body">
          <h4 class="card-title text-dark">Solicitar uno de nuestros productos.</h4>
          <p class="card-title text-dark"> Ingrese sus datos para ponernos en contacto</p>
          <form class="forms-sample" method="POST" action="enviarplan.php">

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