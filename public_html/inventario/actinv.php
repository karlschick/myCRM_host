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

  $id = $_GET['id'];
  $sql = "SELECT * FROM producto WHERE idProducto='$id'";
  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);
 
  ?>

  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <h1 style="font-size: 32px;">GESTIÓN INVENTARIO</h1>
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">Actualizacion inventario </h4>
            <p class="card-description"> </p>
            <form action="../planes/actplan.php" method="POST">

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
</body>

</html>