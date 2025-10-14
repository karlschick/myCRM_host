<?php
session_start();
error_reporting(E_ALL);

// Seguridad de sesión
if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

include '../../includes/header.php';
include '../../includes/menu.php';
require_once __DIR__ . '/../../config/db.php';
?>
<body>
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h1 style="font-size: 32px;">PLANES INACTIVOS</h1>
      </div>

      <div class="card">
        <div class="card-body">
          <a href="tablaplanes.php" class="btn btn-light btn-lg">Volver a planes activos</a>
          <a href="../excel/excelPlanes.php?tipo=inactivo" class="btn btn-success btn-lg">Exportar tabla a Excel</a>


          <?php
          // --- DEBUG: listar los estados existentes (útil para ver cómo están guardados)
          $distinct = $con->query("SELECT DISTINCT estadoPlan FROM plan");
          if ($distinct && $distinct->num_rows > 0) {
              $est = [];
              while ($e = $distinct->fetch_assoc()) { $est[] = $e['estadoPlan']; }
              echo "<p class='mt-3'><strong>Estados encontrados:</strong> " . htmlspecialchars(implode(", ", $est)) . "</p>";
          }

          // Selecciona todo lo que NO sea 'activo' (case-insensitive)
          $sql = "SELECT * FROM plan WHERE LOWER(COALESCE(estadoPlan,'')) != 'activo' ORDER BY nombrePlan ASC;";
          $rta = $con->query($sql);
          if (!$rta) {
              die("<div class='alert alert-danger'>Error en la consulta: " . htmlspecialchars($con->error) . "</div>");
          }

          if ($rta->num_rows === 0) {
              echo "<div class='alert alert-info mt-3'>No hay planes inactivos.</div>";
          } else {
              echo '<div class="table-responsive mt-3"><table class="table table-hover"><thead>
                      <tr>
                        <th>Codigo Plan</th>
                        <th>Velocidad</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Estado</th>
                        <th>Reactivar</th>
                      </tr>
                      </thead><tbody>';
              while ($row = $rta->fetch_assoc()) {
                  $cp = htmlspecialchars($row['codigoPlan']);
                  $vel = htmlspecialchars($row['velocidad']);
                  $nplan = htmlspecialchars($row['nombrePlan']);
                  $pplan = htmlspecialchars($row['precioPlan']);
                  $estadop = htmlspecialchars($row['estadoPlan']);
                  echo "<tr>
                          <td>$cp</td>
                          <td>$vel</td>
                          <td>$nplan</td>
                          <td>$pplan</td>
                          <td>$estadop</td>
                          <td>
                            <a href='reactivarplan.php?cp=" . urlencode($row['codigoPlan']) . "' 
                               class='btn btn-success' 
                               onclick=\"return confirm('¿Desea reactivar el plan $nplan (Código $cp)?');\">
                              Reactivar
                            </a>
                          </td>
                        </tr>";
              }
              echo '</tbody></table></div>';
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
