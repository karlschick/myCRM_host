<?php
// Seguridad de sesiones
session_start();
error_reporting(0);

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';

// Traer planes activos
$sql = "SELECT * FROM plan WHERE estadoPlan='activo'";
$query = mysqli_query($con, $sql);
?>
<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="col-md-6 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">GESTIÓN DE CLIENTES</h4>
          <p class="card-description">Ingrese los datos del cliente</p>

          <form class="forms-sample" method="post" action="insertar.php">
            <!-- Tipo de documento -->
            <div class="form-group">
              <label for="td">Seleccione tipo de documento</label>
              <select class="form-control" name="td" id="td">
                <option value="C.C">C.C</option>
                <option value="C.E">C.E</option>
                <option value="R.C">R.C</option>
                <option value="T.I">T.I</option>
              </select>
            </div>

            <!-- Documento -->
            <div class="form-group">
              <label for="id">Ingrese documento</label>
              <input type="text" class="form-control" name="id" id="id" required>
            </div>

            <!-- Nombre -->
            <div class="form-group">
              <label for="nombre">Ingrese nombres y apellidos</label>
              <input type="text" class="form-control" name="nombre" id="nombre" required>
            </div>

            <!-- Teléfono -->
            <div class="form-group">
              <label for="tel">Ingrese número de teléfono</label>
              <input type="text" class="form-control" name="tel" id="tel">
            </div>

            <!-- Email -->
            <div class="form-group">
              <label for="email">Ingrese correo electrónico</label>
              <input type="email" class="form-control" name="email" id="email">
            </div>

            <!-- Dirección -->
            <div class="form-group">
              <label for="dir">Ingrese dirección</label>
              <input type="text" class="form-control" name="dir" id="dir">
            </div>

            <!-- Estado -->
            <div class="form-group">
              <label for="estado">Seleccione el estado del cliente</label>
              <select class="form-control" name="estado" id="estado">
                <option value="Activo">Activo</option>
                <option value="Archivado">Inactivo</option>
              </select>
            </div>

            <!-- Plan -->
            <div class="form-group">
              <label for="plan">Seleccione el plan</label>
              <select class="form-control" name="plan" id="plan">
                <?php while ($row = mysqli_fetch_assoc($query)) { ?>
                  <option value="<?php echo $row['idPlan']; ?>">
                    <?php echo $row['nombrePlan']; ?>
                  </option>
                <?php } ?>
              </select>
            </div>

            <!-- Tipo de facturación -->
            <div class="form-group">
              <label for="tipoCobro">Tipo de facturación</label>
              <select class="form-control" name="tipoCobro" id="tipoCobro">
                <option value="prepago">Prepago</option>
                <option value="postpago">Postpago</option>
              </select>
            </div>

            <!-- Meses de gracia -->
            <div class="form-group">
              <label for="gracia">Meses de gracia</label>
              <select class="form-control" name="gracia" id="gracia">
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
              </select>
            </div>

            <!-- Fechas -->
            <div class="form-group">
              <label for="creacion">Fecha de creación</label>
              <input type="date" class="form-control" name="creacion" id="creacion" required>
            </div>

            <div class="form-group">
              <label for="act">Fecha última actualización</label>
              <input type="date" class="form-control" name="act" id="act" required>
            </div>

            <div>
              <br>
              <button type="submit" class="btn btn-primary">Guardar</button>
              <a href="tablas.php" class="btn btn-secondary">Volver al inicio</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
</body>
</html>
