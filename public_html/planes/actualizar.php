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
  $cp = $_GET['cp'];
  $sql = "SELECT * FROM plan WHERE codigoPlan='$cp'";
  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);
  ?>


  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <div class="card-body">
        <h1 style="font-size: 32px;">GESTIÓN PLANES</h1>
        <h4 class="card-title">Actualizacion plan </h4>
        <p class="card-description"> Ingrese informacion de nuevo plan</p>
        <form action="../actplan.php" method="POST">
          <input type="hidden" name="cp" value="<?php echo $row['codigoPlan']  ?>">
          <p class="card-description"> Tipo de plan: </p>
          <select class="form-control" aria-label="Default select example" name="tplan" id="tplan" value="<?php echo $row['tipoPlan']  ?>">
            <option value="rural">Rural</option>
            <option value="urbano">Urbano</option>
            <option value="empresarial">Empresarial</option>
          </select>
          <p></p>
          <p class="card-description"> Velocidad plan: </p>
          <input type="text" class="form-control mb-3" name="vel" placeholder="Velocidad Plan" value="<?php echo $row['velocidad']  ?>">
          <p class="card-description"> Nombre plan: </p>
          <input type="text" class="form-control mb-3" name="nplan" placeholder="Nombre del Plan" value="<?php echo $row['nombrePlan']  ?>">
          <p class="card-description"> Precio plan: </p>
          <input type="text" class="form-control mb-3" name="pplan" placeholder="Ingrese Valor del Plan" value="<?php echo $row['precioPlan']  ?>">
          <p class="card-description"> Descripcion plan: </p>
          <input type="text" class="form-control mb-3" name="des" placeholder="Descripcion del plan" value="<?php echo $row['desPlan']  ?>">
          <p class="card-description"> Estado plan: </p>
          <select class="form-select" aria-label="Default select example" name="estadop" id="estadop" value="<?php echo $row['estadoPlan']  ?>">
            <option value="Activo">Activo </option>
            <option value="Archivado">Inactivo</option>
          </select>
          <p></p>
          <input type="submit" class="btn btn-primary btn-lg" value="Actualizar" formmethod="post" formaction=../planes/actplan.php>
        </form>

        <div class="row">
          <div>
            <div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>

</html>