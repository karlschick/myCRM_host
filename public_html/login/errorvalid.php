<?php
session_start();
error_reporting(0);

// Si el usuario ya tiene sesión activa, lo redirige al panel
if (isset($_SESSION['usuario'])) {
    header("Location: ../dashboard/principal.php");
    exit;
}

// Captura el mensaje de error enviado por la URL
$error = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : "Error de validación. Verifique sus credenciales.";

// Incluye el encabezado (solo si tu estructura lo requiere)
include '../../includes/header.php';
?>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">ERROR DE VALIDACIÓN</h3>

              <div class="alert alert-danger text-center" role="alert">
                <?= $error ?>
              </div>

              <form action="login.php" method="POST">
                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">
                    Volver a intentar
                  </button>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
