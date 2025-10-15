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

          <form class="forms-sample" method="post" action="insertar.php" onsubmit="return validarFormulario();">
            
            <!-- Tipo de documento -->
            <div class="form-group">
              <label for="td">Seleccione tipo de documento</label>
              <select class="form-control" name="td" id="td">
                <option value="C.C">C.C</option>
                <option value="C.E">C.E</option>
              </select>
            </div>

            <!-- Documento -->
            <div class="form-group">
              <label for="id">Ingrese documento</label>
              <input type="text" class="form-control" name="id" id="id" 
                     required pattern="[0-9]+" minlength="6" maxlength="10"
                     title="Solo se permiten números (6 a 10 dígitos)">
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
              <input type="date" class="form-control" name="creacion" id="creacion">
            </div>

            <div class="form-group">
              <label for="act">Fecha última actualización</label>
              <input type="date" class="form-control" name="act" id="act">
            </div>

            <!-- Fecha de suspensión automática -->
            <div class="form-group">
              <label for="fechaSuspencion">Fecha de suspensión</label>
              <input type="date" class="form-control" name="fechaSuspencion" id="fechaSuspencion">
            </div>

            <!-- Estado de la factura -->
            <div class="form-group">
              <label for="estadoFactura">Estado de la factura</label>
              <select class="form-control" name="estadoFactura" id="estadoFactura">
                <option value="Pendiente">Pendiente</option>
                <option value="Pagada">Pagada</option>
                <option value="Vencida">Vencida</option>
                <option value="Gratis">Gratis</option>
                <option value="Anulada">Anulada</option>
              </select>
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

<script>
// Validar formulario antes de enviar
function validarFormulario() {
  const id = document.getElementById('id').value.trim();
  if (!/^[0-9]+$/.test(id) || id.length < 6 || id.length > 10) {
    alert('La cédula debe contener solo números (6 a 10 dígitos).');
    return false;
  }

  const creacion = document.getElementById('creacion');
  const act = document.getElementById('act');

  // Si las fechas están vacías, asignar valores automáticos
  if (!creacion.value) {
    const hoy = new Date().toISOString().split('T')[0];
    creacion.value = hoy;
  }
  if (!act.value) {
    act.value = creacion.value;
  }

  return true;
}

// Calcular fecha de suspensión = creación + 1 mes exacto
document.getElementById('creacion').addEventListener('change', function() {
  const fecha = new Date(this.value);
  if (!isNaN(fecha)) {
    fecha.setMonth(fecha.getMonth() + 1); // sumar 1 mes exacto
    const fechaSusp = fecha.toISOString().split('T')[0];
    document.getElementById('fechaSuspencion').value = fechaSusp;
  }
});
</script>

</body>
</html>
