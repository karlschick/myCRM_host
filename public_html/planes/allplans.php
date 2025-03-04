<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Atory Solution</title>

  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="../assets/css/style.css">

  <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>

<body>
  <?php
  include '../menu/menuint.php';
  ?>

  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Todos los planes activos</h3>
      </div>
      <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Lista de Planes</h4>
              <form class="forms-sample">
                <?php
                require_once __DIR__ . '/../config/db.php';
                $sql = "SELECT * FROM plan WHERE estadoPlan='activo';";
                echo '<div class="table-responsive">
                      <table class="table table-hover">
                      <thead>
                          <tr>
                              <th> Codigo Plan </th>
                              <th> Velocidad de Plan</th>
                              <th> Nombre de Plan</th>
                              <th> Precio de Plan</th>
                              <th> Describcion del Plan</th>
                              <th> Estado de Plan</th>
                              <th> Actualizar</th>
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
                      <td> <?php echo "$des" ?></td>
                      <td> <?php echo "$estadop" ?></td>
                      <th>
                        <a href="../planes/actualizar.php?cp=<?php echo $row['codigoPlan'] ?>" class="btn btn-info">Editar</a>
                      </th>
                      </th>
                      <th>
                        <a href="../planes/eliminarplan.php?cp=<?php echo $row['codigoPlan'] ?>" class="btn btn-danger">Eliminar</a>
                      </th>
                      </th>
                    </tr>";
                <?php
                  }
                }

                ?>
                <div class="form-button mt-5">
                  <button id="submit" type="submit" formmethod="post" formaction="../planes/tablaplanes.php" class="btn btn-primary">Consultar planes activos</button>
                  <button id="submit" type="submit" formmethod="post" formaction="ingresar.html" class="btn btn-primary">Ingresar nuevo plan</button>
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

  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>

  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>

</body>

</html>