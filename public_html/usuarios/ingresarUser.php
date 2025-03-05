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
    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>

    <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <div class="col-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">GESTION DE USUARIOS</h4>
            <p class="card-description"> Ingrese los datos del usuarios</p>
            <form class="forms-sample">
              <!--tipo de documento-->
              <div class="form-group">
                <label for="td">Seleccione tipo de documento</label>
                <select class="form-control" name="td" id="td">
                  <option value="C.C">C.C</option>
                  <option value="C.E">C.E</option>
                  <option value="R.C">R.C</option>
                  <option value="T.I">T.I</option>
                </select>
              </div>
              <!--valor de documento-->
              <div class="form-group">
                <label for="id">Ingrese documento</label>
                <input type="text" class="form-control" name="id" id="id" placeholder="Numero de documento">
              </div>

              <!--valor de nombres y apellidos-->
              <div class="form-group">
                <label for="nombre">Ingrese nombres y apellidos</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese nombre">
              </div>


              <!--valor de numero de telefono-->
              <div class="form-group">
                <label for="tel">Ingrese numero de telefono</label>
                <input type="text" class="form-control" name="tel" id="tel" placeholder="Numero de telefono">
              </div>

              <!--valor de email-->
              <div class="form-group">
                <label for="email">Ingrese correo electronico</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Correo electronico">
              </div>

              <!--valor de pasword-->
              <div class="form-group">
                <label for="clave">Ingrese password</label>
                <input type="password" class="form-control" name="clave" id="clave" placeholder="password">
              </div>

              <!--valor de estado del cliente-->
              <div class="form-group">
                <label for="estado">Seleccione el estado del usuario</label>
                <select class="form-control" name="estado" id="estado">
                  <option value="Activo">Activo </option>
                  <option value="Archivado">Inactivo</option>
                </select>
              </div>


              <!--valor de fecha creacion-->
              <div class="form-group">
                <label for="creacion">Ingrese fecha de creacion</label>
                <input type="date" class="form-control" name="creacion" id="creacion" placeholder="">
              </div>

              <!--valor de ultima actualizacion-->
              <div class="form-group">
                <label for="act">Ingrese fecha ultima actualizacion</label>
                <input type="date" class="form-control" name="act" id="act" placeholder="">
              </div>
              <div class="form-group">
                <label for="rol">Seleccione tipo de usuario</label>
                <select class="form-control" name="rol" id="rol">
                  <option value="Administrador">administrativo</option>
                  <option value="Tecnico">tecnico</option>

                </select>
              </div>
              <div>
                <br>
                <button id="submit" type="submit" formmethod="post" formaction="insertarUser.php" class="btn btn-primary">Guardar</button>
                <button id="submit" type="submit" formmethod="post" formaction="tablasUser.php" class="btn btn-primary"> Volver al inicio </button>

              </div>
            </form>

          </div>
        </div>

      </div>




    </div>
    <!-- ESTO ES LO QUE PODEMOS MODIFICAR -->
    <!-- partial:partials/_footer.html -->

    <!-- partial -->
  </div>

  <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->


  </div>


</body>

</html>