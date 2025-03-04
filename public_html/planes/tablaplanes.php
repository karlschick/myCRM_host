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

// Incluye el encabezado de la página
include '../../includes/header.php';
?>

<body>

    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>

    <!-- Contenedor principal -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h1 style="font-size: 32px;">GESTIÓN PLANES</h1>
      </div>
      
      <div class="card">
        <div class="card-body">
          <form class="forms-sample">
            <?php
            require_once __DIR__ . '/../../config/db.php';
            $sql = "SELECT * FROM plan WHERE estadoPlan='activo';";
            echo '<div class="table-responsive">
                      <table class="table table-hover">
                      <thead>
                          <tr>
                              <th> Codigo Plan </th>
                              <th> Velocidad de Plan</th>
                              <th> Nombre de Plan</th>
                              <th> Precio de Plan</th>
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
                  <td><?php echo "$cp" ?></td>
                  <td><?php echo "$vel" ?></td>
                  <td><?php echo "$nplan" ?></td>
                  <td><?php echo "$pplan" ?></td>
                  <td><?php echo "$estadop" ?></td>
                  <th>
                    <a href="planes/actualizar.php?cp=<?php echo $row['codigoPlan']; ?>" class="btn btn-info">Editar</a>
                  </th>
                  <th>
                    <a href="planes/eliminarplan.php?cp=<?php echo $row['codigoPlan']; ?>" class="borrar btn btn-danger">Archivar</a>
                  </th>
                  <td>
                  </td>
                </tr>
            <?php
              }
            }
            ?>
            <div class="form-button ">
              <button id="submit" type="submit" formmethod="post" formaction="../planes/rurales.php" class="btn btn-primary btn-lg">Ver planes rurales</button>
              <button id="submit" type="submit" formmethod="post" formaction="../planes/urbanos.php" class="btn btn-primary btn-lg">Ver planes urbanos</button>
              <button id="submit" type="submit" formmethod="post" formaction="../planes/empresariales.php" class="btn btn-primary btn-lg">Ver planes empresariales</button>
              <button id="submit" type="submit" formmethod="post" formaction="../planes/nuevoplan.php" class="btn btn-primary btn-lg">Ingresar nuevo plan</button>
              <button id="submit" type="submit" formmethod="post" formaction="../planes/consultarplanes.php" class="btn btn-primary btn-lg">Consultar Plan</button>
              <button id="submit" type="submit" formmethod="post" formaction="../planes/tablaplanesinac.php" class="btn btn-danger btn-lg">Ver planes Inactivos</button>

              <a href="../excel/excelPlanes.php" class="btn btn-success btn-lg">Exportar tabla a Excel</a>
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