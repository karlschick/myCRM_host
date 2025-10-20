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
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Planes Empresariales </h3>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Lista de Planes</h4>
              <form class="forms-sample">
                <?php
                require_once __DIR__ . '/../../config/db.php';
                $sql = "SELECT * FROM plan WHERE tipoPlan='empresarial';";
                echo '<div class="table-responsive">
                      <table class="table table-hover">
                      <thead class="table-light">
                          <tr>
                              <th> Codigo Plan </th>
                              <th> Velocidad de Plan</th>
                              <th> Nombre de Plan</th>
                              <th> Precio de Plan</th>
                              <th> Estado de Plan</th>
                              <th> Consultar plan</th>
                              <th> Eliminar</th>
                          </tr>
                        </thead>
                          ';
                if ($rta = $con->query($sql)) {
                  while ($row = $rta->fetch_assoc()) {
                    $cp = $row['codigoPlan'];
                    $vel = $row['velocidad'];
                    $nplan = $row['nombrePlan'];
                    $pplan = $row['precioPlan'];
                    $des = $row['desPlan'];
                    $estadop = $row['estadoPlan'];
                ?>
                    <tr>
                      <td> <?php echo "$cp" ?></td>
                      <td> <?php echo "$vel" ?></td>
                      <td> <?php echo "$nplan" ?></td>
                      <td> <?php echo "$pplan" ?></td>
                      <td> <?php echo "$estadop" ?></td>
                      <th>
                        <a href="actualizar.php?cp=<?php echo $row['codigoPlan'] ?>" class="btn btn-info">Editar</a>

                      <th><a href="planes/eliminarplan.php?cp=<?php echo $row['codigoPlan'] ?>" class="btn btn-danger">Eliminar</a></th>

                    </tr>
                <?php
                  }
                }

                ?>
                <div class="form-button mt-5">
                  <button id="submit" type="submit" formmethod="post" formaction="consultarplanes.php" class="btn btn-primary">Consular Plan</button>
                  <button id="submit" type="submit" formmethod="post" formaction="nuevoplan.php" class="btn btn-primary">Ingresar nuevo plan</button>
                  <button id="submit" type="submit" formmethod="post" formaction="tablaplanes.php" class="btn btn-primary"> Ver tabla completa de planes </button>
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