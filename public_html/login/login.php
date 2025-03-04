<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>ATORY - inicio sesion</title>

  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">

  <link rel="stylesheet" href="../assets/css/style.css">

  <link rel="shortcut icon" href="../assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-4 mx-auto">
            <div class="card-body px-5 py-5">
              <h3 class="card-title text-left mb-3">INICIO DE SESION</h3>
              <form action="validar.php" method="POST">
                <?php
                if (isset($_GET['error'])) {
                ?>
                  <p class="error">
                    <?php
                    echo $_GET['error']
                    ?>

                  </p>
                <?php
                }
                ?>
                <div class="form-group">
                  <label>usuario</label>
                  <input type="text" name="usuario" id="usuario" class="form-control p_input" required>
                </div>
                <div class="form-group">
                  <label>Contraseña *</label>
                  <input type="password" name="pass" id="pass" class="form-control p_input" required>
                </div>
                <div class="form-group d-flex align-items-center justify-content-between">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input type="checkbox" class="form-check-input" id="remember-me"> recordarme</label>
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
    // Función para cargar el contenido de plancontainer.php
    function cargarContenidoPHP() {
      fetch('../planes/plancontainer.php')
        .then(response => response.text())
        .then(data => {
          // Insertar el contenido en la div
          document.getElementById('contenido-php').innerHTML = data;
        })
        .catch(error => console.error('Error al cargar plancontainer.php:', error));
    }

    // Llamar a la función cuando se carga la página
    window.onload = cargarContenidoPHP;
  </script>


  <script src="../assets/vendors/js/vendor.bundle.base.js"></script>

  <script src="../assets/js/off-canvas.js"></script>
  <script src="../assets/js/hoverable-collapse.js"></script>
  <script src="../assets/js/misc.js"></script>
  <script src="../assets/js/settings.js"></script>
  <script src="../assets/js/todolist.js"></script>

</body>

</html>