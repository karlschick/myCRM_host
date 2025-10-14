<?php
session_start();

// Si ya hay sesión iniciada, intentamos asegurarnos de que $_SESSION['foto'] esté poblada.
// Esto ayuda si validar.php no llegó a setear la foto por alguna razón.
if (isset($_SESSION['usuario'])) {
    // Si la foto no está en sesión, la sacamos de la base de datos
    if (empty($_SESSION['foto'])) {
        // Intentamos cargar la foto desde la BD (ruta relativa al archivo)
        $dbPath = __DIR__ . '/../../config/db.php';
        if (file_exists($dbPath)) {
            require_once $dbPath;
            if (isset($con) && $con) {
                $usuarioSesion = $_SESSION['usuario'];
                $stmtFoto = $con->prepare("SELECT foto, rol FROM usuario WHERE nombresUsuario = ?");
                if ($stmtFoto) {
                    $stmtFoto->bind_param("s", $usuarioSesion);
                    $stmtFoto->execute();
                    $resFoto = $stmtFoto->get_result();
                    if ($filaFoto = $resFoto->fetch_assoc()) {
                        $_SESSION['foto'] = !empty($filaFoto['foto']) ? $filaFoto['foto'] : 'pic-1.png';
                        // Si por alguna razón el rol en sesión está vacío, lo actualizamos
                        if (empty($_SESSION['rol']) && !empty($filaFoto['rol'])) {
                            $_SESSION['rol'] = $filaFoto['rol'];
                        }
                    } else {
                        $_SESSION['foto'] = 'pic-1.png';
                    }
                    $stmtFoto->close();
                }
                // No cerramos $con acá (lo maneja el include del proyecto)
            }
        } else {
            // Si no existe el archivo de configuración de BD, dejamos la foto por defecto
            $_SESSION['foto'] = 'pic-1.png';
        }
    }

    // Si ya hay sesión y foto, redirigimos al panel según rol para no mostrar el formulario nuevamente
    $rol = $_SESSION['rol'] ?? '';
    if ($rol === 'Administrador') {
        header("Location: ../dashboard/principal.php");
        exit;
    } elseif ($rol === 'Tecnico') {
        header("Location: ../visitas/tablasVisitasT.php");
        exit;
    } else {
        // Si el rol no está definido, dejamos que vea el login (por si necesita revalidar).
    }
}

// Limpiar cookies antiguas solo si no hay error
if(!isset($_GET['error'])) {
    // No borrar nada; usamos cookies para recordar usuario y checkbox
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ATORY - inicio sesión</title>

  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="shortcut icon" href="../assets/images/favicon.png" />

  <!-- Bootstrap Icons para el ojo -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    .toggle-password {
      position: absolute;
      top: 50%;
      right: 15px;
      transform: translateY(-50%);
      cursor: pointer;
      font-size: 1.2rem;
      color: #555;
    }
    input.p_input.pr-5 {
      padding-right: 2.5rem; /* espacio para el ojo */
    }
    .error { color: #d9534f; margin-bottom: 1rem; }
  </style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">INICIO DE SESIÓN</h3>
              <form action="validar.php" method="POST" autocomplete="on">
                <?php
                if (isset($_GET['error'])) {
                    echo '<p class="error">'.htmlspecialchars($_GET['error']).'</p>';
                }
                ?>
                <div class="form-group">
                  <label>Usuario</label>
                  <input type="text" name="usuario" id="usuario" class="form-control p_input" 
                         value="<?php echo $_COOKIE['usuario'] ?? ''; ?>" autocomplete="username" required>
                </div>

                <div class="form-group position-relative">
                  <label>Contraseña *</label>
                  <input type="password" name="pass" id="pass" class="form-control p_input pr-5" 
                         autocomplete="current-password" required>
                  <span toggle="#pass" class="bi bi-eye-fill toggle-password"></span>
                </div>

                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember-me" name="remember-me"
                        <?php if(isset($_COOKIE['recordarme'])) echo 'checked'; ?>>
                    <label class="form-check-label" for="remember-me">Recordarme</label>
                  </div>
                </div>

                <div class="text-center">
                  <button type="submit" class="btn btn-primary btn-block enter-btn">INICIAR</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Mostrar/ocultar contraseña -->
  <script>
    document.querySelectorAll('.toggle-password').forEach(function(element) {
      element.addEventListener('click', function() {
        const input = document.querySelector(this.getAttribute('toggle'));
        if(input.type === "password") {
          input.type = "text";
          this.classList.remove('bi-eye-fill');
          this.classList.add('bi-eye-slash-fill');
        } else {
          input.type = "password";
          this.classList.remove('bi-eye-slash-fill');
          this.classList.add('bi-eye-fill');
        }
      });
    });
  </script>

  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>

</body>
</html>
