<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
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
        <?php
        include '../menu/menuint.php';
        ?>
        <!-- partial -->
        <?php 
                       require_once __DIR__ . '/../config/db.php';
                       $cp=$_POST["cp"];
                      $sql= "SELECT * FROM plan WHERE codigoPlan='$cp';";
                      if($rta = $con -> query($sql)){
                        while ($row = $rta -> fetch_assoc()){
                            $cp=$row['codigoPlan'];
                            $vel=$row['velocidad'];
                            $nplan=$row['nombrePlan'];
                            $pplan=$row['precioPlan'];
                            $des=$row['desPlan'];
                            $estadop=$row['estadoPlan'];
                            $tplan=$row ['tipoPlan'];
                        }}
             ?>         
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header">
              <h3 class="page-title">Plan consultado: <?php echo "$tplan $nplan" ?></h3>
            </div>
         <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><?php echo "$nplan"?></h4>
                    <form class="forms-sample">
                    <div class="form-group">
                        <label for="cp">Código del plan: <?php echo "$cp" ?></label>
                      </div>
                      <div class="form-group">
                        <label for="vel">velocidad del plan: <?php echo "$vel" ?></label>
                      </div>
                      <div class="form-group">
                        <label for="plan">Tiene un valor de : <?php echo" $pplan" ?></label>
                      </div>
                      <div class="form-group">
                        <label for="des"><?php echo "$des" ?></label>
                      </div>
                <div class="form-button mt-5">
                    <button id="submit" type="submit" formmethod="post" formaction="../planes/nuevoplan.php" class="btn btn-primary">Ingresar nuevo Plan</button>
                    <button id="submit" type="submit" formmethod="post" formaction="../planes/tablaplanes.php" class="btn btn-primary">Gestionar todos los planes</button>
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