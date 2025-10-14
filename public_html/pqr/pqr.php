<?php
// 🔒 Seguridad de sesión
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';

// 📋 Determinar vista: Activo o Archivado
$vista = $_GET['estado'] ?? 'Activo';

if ($vista === 'Activo') {
    $sql = "SELECT * FROM pqr2 WHERE estadoPqr = 'Activo';";
} else {
    $sql = "SELECT * FROM pqr2 WHERE estadoPqr = 'Inactivo' OR estadoPqr IS NULL;";
}
?>
<body>
  <!-- Incluye el menú de navegación -->
  <?php include '../../includes/menu.php'; ?>

  <!-- Contenedor principal -->
  <div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h1 style="font-size: 32px;">ATENCIÓN AL CLIENTE - <?php echo strtoupper($vista); ?></h1>
      </div>

      <div class="card">
        <div class="card-body">

          <!-- 🔘 Botones principales -->
          <a href="../dashboard/principal.php" class="btn btn-primary">Volver al inicio</a>
          <a href="../excel/excelPQR.php" class="btn btn-success">Exportar tabla a Excel</a>

          <!-- 🧭 Botones para cambiar vista -->
          <a href="pqr.php?estado=Activo" class="btn btn-outline-primary <?php if($vista == 'Activo') echo 'active'; ?>">Ver Activos</a>
          <a href="pqr.php?estado=Archivado" class="btn btn-outline-secondary <?php if($vista != 'Activo') echo 'active'; ?>">Ver Archivados</a>

          <?php
          // 📊 Consultar resultados
          if ($rta = $con->query($sql)) {
              if ($rta->num_rows > 0) {
                  echo '
                  <div class="table-responsive mt-3">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Id PQR</th>
                          <th>Tipo documento</th>
                          <th>Número documento</th>
                          <th>Nombres cliente</th>
                          <th>Teléfono</th>
                          <th>Email</th>
                          <th>Tipo PQR</th>
                          <th>Descripción</th>
                          <th>Estado</th>
                          <th>Comentario</th>
                          <th>Acciones</th>
                        </tr>
                      </thead>
                      <tbody>';
                  
                  while ($row = $rta->fetch_assoc()) {
                      echo "<tr>
                              <td>{$row['idPqr']}</td>
                              <td>{$row['tipoDocumento']}</td>
                              <td>{$row['nDocumento']}</td>
                              <td>{$row['nombresCliente']}</td>
                              <td>{$row['telefonoCliente']}</td>
                              <td>{$row['emailCliente']}</td>
                              <td>{$row['tPqr']}</td>
                              <td>{$row['desPqr']}</td>
                              <td>{$row['estadoPqr']}</td>
                              <td>{$row['comentario']}</td>
                              <td>";

                      // 🧩 Acciones según vista
                      if ($vista === 'Activo') {
                          echo "<a href='consultarpqr.php?i={$row['idPqr']}' class='btn btn-primary btn-sm'>Consultar</a> ";
                          echo "<a href='comentario.php?i={$row['idPqr']}' class='btn btn-info btn-sm'>Comentar</a> ";
                          echo "<a href='eliminarpqr.php?i={$row['idPqr']}' class='btn btn-danger btn-sm'>Archivar</a>";
                      } else {
                          echo "<a href='consultarpqr.php?i={$row['idPqr']}' class='btn btn-secondary btn-sm'>Ver</a>";
                      }

                      echo "</td></tr>";
                  }

                  echo '</tbody></table></div>';
              } else {
                  echo "<p class='mt-3'>No hay PQR con estado <strong>$vista</strong>.</p>";
              }
          } else {
              echo "<p class='text-danger'>Error en la consulta: " . $con->error . "</p>";
          }
          ?>
        </div>
      </div>
    </div>
  </div> <!-- 🔹 cierre de main-panel -->

  </div> <!-- 🔹 cierre de container-fluid page-body-wrapper -->
</div> <!-- 🔹 cierre de container-scroller -->

</body>
</html>
