<?php
session_start();
require_once __DIR__ . '/../../config/db.php';

// Si ya hay sesión iniciada, redirigir según rol
if (isset($_SESSION['usuario'])) {
    $rol = $_SESSION['rol'] ?? '';
    if ($rol === 'Administrador') {
        header("Location: ../dashboard/principal.php");
        exit;
    } elseif ($rol === 'Tecnico') {
        header("Location: ../visitas/tablasVisitasT.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login ATORY</title>
<link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
<link rel="stylesheet" href="../assets/css/style.css">
<link rel="shortcut icon" href="../assets/images/favicon.png" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<style>
.toggle-password { position:absolute; top:50%; right:15px; transform:translateY(-50%); cursor:pointer; font-size:1.2rem; color:#555; }
input.p_input.pr-5 { padding-right:2.5rem; }
.error { color:#d9534f; margin-bottom:1rem; }
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
<?php if (isset($_GET['error'])): ?>
<p class="error"><?php echo htmlspecialchars($_GET['error']); ?></p>
<?php endif; ?>

<div class="form-group">
<label>Usuario o correo</label>
<input type="text" name="usuario" class="form-control p_input" value="<?php echo $_COOKIE['usuario'] ?? ''; ?>" autocomplete="username" required>
</div>

<div class="form-group position-relative">
<label>Contraseña *</label>
<input type="password" name="pass" id="pass" class="form-control p_input pr-5" autocomplete="current-password" required>
<span toggle="#pass" class="bi bi-eye-fill toggle-password"></span>
</div>

<div class="form-group d-flex align-items-center justify-content-between">
<div class="form-check">
<input type="checkbox" class="form-check-input" id="remember-me" name="remember-me" <?php if(isset($_COOKIE['recordarme'])) echo 'checked'; ?>>
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

<script>
document.querySelectorAll('.toggle-password').forEach(el => {
el.addEventListener('click', function(){
const input = document.querySelector(this.getAttribute('toggle'));
if(input.type === "password"){ input.type = "text"; this.classList.replace('bi-eye-fill','bi-eye-slash-fill'); }
else { input.type = "password"; this.classList.replace('bi-eye-slash-fill','bi-eye-fill'); }
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
