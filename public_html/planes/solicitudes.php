<!-- actualizado -->

<?php
// Seguridad de sesiones
session_start();
error_reporting(0);

// Verifica si el usuario tiene una sesión activa
$varsesion = $_SESSION['usuario'];
if (empty($varsesion)) {
    header("Location: ../index.php");
    die();
}

// Incluye el encabezado de la página
include '../../includes/header.php';
?>
<body>

<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="card">
      <div class="card-body">
        <a href="atentidas.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">
          Consultar solicitudes atendidas
        </a>

        <?php
        require_once __DIR__ . '/../../config/db.php';

        $sql = "SELECT * FROM solicitudes WHERE estadoSolicitud='Activo';";

        echo '<div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Id Solicitud</th>
                      <th>Nombres del cliente</th>
                      <th>Teléfono</th>
                      <th>Correo Cliente</th>
                      <th>Responder solicitud</th>
                    </tr>
                  </thead>
                  <tbody>';

        if ($rta = $con->query($sql)) {
          while ($row = $rta->fetch_assoc()) {
            $i = $row['idSolicitud'];
            $nombres = $row['nombres'];
            $tel = $row['telefono'];
            $email = $row['email'];
        ?>
            <tr>
              <td><?php echo htmlspecialchars($i); ?></td>
              <td><?php echo htmlspecialchars($nombres); ?></td>
              <td><?php echo htmlspecialchars($tel); ?></td>
              <td><?php echo htmlspecialchars($email); ?></td>
              <td>
                <a href="elisoli.php?i=<?php echo $i; ?>"
                   class="btn btn-danger btn-sm"
                   onclick="return confirmarRespuesta(event, <?php echo $i; ?>)">
                   Responder
                </a>
              </td>
            </tr>
        <?php
          }
        }

        echo '</tbody></table></div>';
        ?>
      </div>
    </div>
  </div>
</div>

<!-- Librería SweetAlert2 (para ventana moderna de confirmación) -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function confirmarRespuesta(event, id) {
  event.preventDefault();

  Swal.fire({
    title: "¿Ya respondiste esta solicitud?",
    text: "Confirma antes de archivarla.",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Sí, archivarla",
    cancelButtonText: "No, aún no",
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33"
  }).then((result) => {
    if (result.isConfirmed) {
      // Redirige al archivo PHP que archiva la solicitud
      window.location.href = "elisoli.php?i=" + id;
    } else {
      Swal.fire({
        icon: "info",
        title: "Solicitud no archivada",
        text: "Puedes atenderla más tarde.",
        timer: 2000,
        showConfirmButton: false
      });
    }
  });

  return false;
}
</script>

</body>
</html>
