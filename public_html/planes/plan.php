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
    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>

        <?php 
                       require_once __DIR__ . '/../../config/db.php';
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

  </body>
</html>