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
            <h4 class="card-title">Ingreso de nuevos planes</h4>
            <p class="card-description"> Ingrese nueva información del nuevo plan</p>
            <form class="forms-sample">
              <div class="form-group">
                <label for="cp">Ingrese codigo del plan</label>
                <input type="number" class="form-control" name="cp" id="cp" placeholder="Codigo de plan">
              </div>
              <div class="form-group">
                <label for="tplan">Seleccione tipo de plan</label>
                <select class="form-control" name="tplan" id="tplan">
                  <option value="rural">Rural</option>
                  <option value="urbano">Urbano</option>
                  <option value="empresarial">Empresarial</option>
                </select>
              </div>
              <div class="form-group">
                <label for="vel">Ingrese velocidad del plan</label>
                <input type="text" class="form-control" name="vel" id="vel" placeholder="Velocidad del plan">
              </div>

              <!--valor de nombres y apellidos-->
              <div class="form-group">
                <label for="nplan">Ingrese nombre del plan</label>
                <input type="text" class="form-control" name="nplan" id="nplan" placeholder="Nombre del Plan">
              </div>


              <!--valor de numero de telefono-->
              <div class="form-group">
                <label for="pplan">Ingrese Precio del Plan</label>
                <input type="number" class="form-control" name="pplan" id="pplan" placeholder="Precio del plan">
              </div>

              <!--valor de email-->
              <div class="form-group">
                <label for="des">Descripcion del plan</label>
                <input type="text" class="form-control" name="des" id="des" placeholder="Describcion del plan">
              </div>
              <!--valor de estado del cliente-->
              <div class="form-group">
                <label for="estadop">Estado del plan</label>
                <select class="radio" name="estadop" id="estadop">
                  <option value="Activo">Activo </option>
                  <option value="Archivado">Inactivo</option>
                </select>
              </div>

              <div>
                <br>
                <button id="submit" type="submit" formmethod="post" formaction="inplanes.php" class="btn btn-primary">Guardar</button>
                <!--<button id="submit" type="submit" formmethod="post" formaction="../user.php" class="btn btn-primary"> Volver al inicio </button> -->

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  </div>
</body>

</html>