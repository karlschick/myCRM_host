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
  $id = $_GET['i'];
  $sql = "SELECT * FROM pqr2 WHERE idPqr='$id'";
  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);
  ?>
  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <div class="card">
        <div class="card-body">
          <h1 style="font-size: 32px;">Ingrese comentario</h1>
          <p class="card-description"> </p>
          <form action="updateComentario.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['idPqr']  ?>">
            <input type="text" class="form-control mb-3" name="comentario" placeholder="comentario" value="<?php echo $row['comentario']  ?>">

            <input type="submit" class="btn btn-primary" value="Agregar comentario" formmethod="post" formaction=../pqr/updateComentario.php>
            <input type="submit" class="btn btn-danger" value="Cancelar" formaction=../pqr/pqr.php>
          </form>

        </div>
      </div>

    </div>

  </div>

  </div>

</body>

</html>