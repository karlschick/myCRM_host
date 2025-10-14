<?php
// Seguridad de sesiones
session_start();
error_reporting(0);

// Verifica si el usuario tiene una sesión activa
$varsesion = $_SESSION['usuario'] ?? null;
if (empty($varsesion)) {
    header("Location: ../index.php");
    die();
}

// Incluye encabezado y menú
include '../../includes/header.php';
?>
<body>

<?php include '../../includes/menutec.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-body">
        <a href="atentidasT.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">
          Consultar solicitudes atendidas
        </a>

        <?php
        require_once __DIR__ . '/../../config/db.php';

        // Mostrar solo las solicitudes activas
        $sql = "SELECT * FROM solicitudes WHERE estadoSolicitud = 'Activo' ORDER BY idSolicitud DESC;";

        echo '<div class="table-responsive mt-4">
                <table class="table table-hover align-middle">
                  <thead class="table-light">
                    <tr>
                      <th>ID Solicitud</th>
                      <th>Nombres del Cliente</th>
                      <th>Teléfono</th>
                      <th>Correo Cliente</th>
                      <th>Estado</th>
                    </tr>
                  </thead>
                  <tbody>';

        if ($rta = $con->query($sql)) {
          if ($rta->num_rows > 0) {
            while ($row = $rta->fetch_assoc()) {
              $id = htmlspecialchars($row['idSolicitud']);
              $nombres = htmlspecialchars($row['nombres']);
              $telefono = htmlspecialchars($row['telefono']);
              $email = htmlspecialchars($row['email']);
              $estado = htmlspecialchars($row['estadoSolicitud']);
              ?>
              <tr>
                <td><?php echo $id; ?></td>
                <td><?php echo $nombres; ?></td>
                <td><?php echo $telefono; ?></td>
                <td><?php echo $email; ?></td>
                <td>
                  <div class="d-flex align-items-center">
                    <!-- Semáforo verde para activo -->
                    <span class="rounded-circle d-inline-block me-2" style="width:15px; height:15px; background-color:#28a745;"></span>
                    <span><?php echo $estado; ?></span>
                  </div>
                </td>
              </tr>
              <?php
            }
          } else {
            echo '<tr><td colspan="5" class="text-center text-muted">No hay solicitudes activas.</td></tr>';
          }
          $rta->free();
        } else {
          echo '<tr><td colspan="5" class="text-center text-danger">Error al consultar la base de datos.</td></tr>';
        }

        echo '</tbody></table></div>';
        $con->close();
        ?>
      </div>
    </div>
  </div>
</div>

</body>
</html>
