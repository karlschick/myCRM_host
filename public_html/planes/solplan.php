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
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->

    <div class="main-panel">
      <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
        <form action="../index.php">
          <input type="submit" value="Volver al inicio" class="btn btn-primary btn-lg" />
        </form>
        <div class="card-body">
          <h4 class="card-title">Solicitar uno de nuestros productos.</h4>
          <p class="card-description"> Ingrese sus datos para ponernos en contacto</p>
          <form class="forms-sample">

            <div class="form-group">
              <label for="td">Seleccione tipo de documento</label>
              <select class="form-control" name="td" id="td" required>
                <option value="C.C">C.C</option>
                <option value="C.E">C.E</option>
                <option value="R.C">R.C</option>
                <option value="T.I">T.I</option>
              </select>
            </div>

            <div class="form-group">
              <label for="id">Ingrese documento</label>
              <input type="text" class="form-control" name="id" id="id" placeholder="Numero de documento" required>
            </div>


            <div class="form-group">
              <label for="nombre">Ingrese nombres y apellidos</label>
              <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese nombre" required>
            </div>



            <div class="form-group">
              <label for="tel">Ingrese numero de telefono</label>
              <input type="text" class="form-control" name="tel" id="tel" placeholder="Numero de telefono" required>
            </div>


            <div class="form-group">
              <label for="email">Ingrese correo electronico</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Correo electronico" required>
            </div>

            <div>
              <br>
              <button id="submit" type="submit" formmethod="post" formaction="enviarplan.php" class="btn btn-primary">Enviar</button>


            </div>
          </form>

          <div class="row">
            <div>
              <div>

              </div>
            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</body>

</html>