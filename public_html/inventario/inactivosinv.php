<?php
// Seguridad de sesiones
session_start();
error_reporting(0);

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

include '../../includes/header.php';
?>

<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <h1 style="font-size: 32px;">GESTIÓN INVENTARIO - PRODUCTOS INACTIVOS</h1>
    <div class="card-body">

      <a href="tablasinventario.php" class="btn btn-primary">Volver a activos</a>
      <a href="../excel/excelPQR.php" class="btn btn-success">Exportar tabla a Excel</a>

      <?php
      require_once __DIR__ . '/../../config/db.php';

      // Consulta productos inactivos
      $sql = "SELECT * FROM producto WHERE LOWER(estadoProducto) = 'inactivo' ORDER BY idProducto ASC;";
      $rta = $con->query($sql);

      if (!$rta || $rta->num_rows === 0) {
          echo '<div class="alert alert-info mt-3">No hay productos inactivos.</div>';
      } else {
          echo '<div class="table-responsive mt-3">
                  <table class="table table-hover">
                  <thead class="table-light">
                    <tr>
                      <th>ID Producto</th>
                      <th>Nombre</th>
                      <th>Serial</th>
                      <th>Descripción</th>
                      <th>Cantidad</th>
                      <th>Reactivar</th>
                      <th>Eliminar definitivamente</th>
                    </tr>
                  </thead>
                  <tbody>';

          while ($row = $rta->fetch_assoc()) {
              $id = htmlspecialchars($row['idProducto']);
              $nombrep = htmlspecialchars($row['nombreProducto']);
              $serial = htmlspecialchars($row['serialProducto']);
              $desp = htmlspecialchars($row['descripcionProducto']);
              $cantidad = htmlspecialchars($row['cantidad']);

              echo "<tr>
                      <td>$id</td>
                      <td>$nombrep</td>
                      <td>$serial</td>
                      <td>$desp</td>
                      <td>$cantidad</td>
                      <td>
                        <a href='activarp.php?id=$id' class='btn btn-warning'
                           onclick=\"return confirm('¿Desea volver a activar el producto: $nombrep?');\">
                           Reactivar
                        </a>
                      </td>
                      <td>
                        <a href='eliminarp.php?id=$id' class='btn btn-danger'
                           onclick=\"return confirm('⚠️ Esta acción eliminará el producto $nombrep de forma permanente. ¿Desea continuar?');\">
                           Eliminar
                        </a>
                      </td>
                    </tr>";
          }

          echo '</tbody></table></div>';
      }
      ?>
    </div>

    <footer class="footer mt-4">
      <div class="d-sm-flex justify-content-center justify-content-sm-between">
      </div>
    </footer>

  </div>
</div>
</body>
</html>
