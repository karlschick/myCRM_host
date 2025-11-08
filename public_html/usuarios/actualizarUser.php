<?php
session_start();
error_reporting(0);

// Seguridad de sesión
if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';

// Obtener parámetro id (documentoUsuario)
$id = $_GET['id'] ?? '';
$sql = "SELECT * FROM usuario WHERE documentoUsuario='" . mysqli_real_escape_string($con, $id) . "' LIMIT 1";
$query = mysqli_query($con, $sql);
$row = mysqli_fetch_array($query);

// Helper para convertir datetime -> datetime-local (YYYY-MM-DDTHH:MM)
function to_datetime_local($dt) {
    if (empty($dt) || $dt === '0000-00-00 00:00:00') return '';
    $part = substr($dt, 0, 16);
    return str_replace(' ', 'T', $part);
}
?>

<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="card-body" style="max-width:1100px; margin:0 auto;">
      <h1 style="font-size:32px; text-align:center;">GESTIÓN DE USUARIOS</h1>
      <p class="card-description" style="text-align:center;">Actualice los datos del Usuario</p>

      <form action="updateUser.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($row['idUsuario']); ?>">

        <!-- FOTO -->
        <div style="text-align:center; margin:20px 0;">
          <img src="../assets/images/faces-clipart/<?php echo htmlspecialchars($row['foto'] ?: $row['fotoUsuario'] ?: 'pic-1.png'); ?>"
               alt="Foto de usuario"
               width="140" height="140"
               style="border-radius:10px; border:1px solid #ccc; object-fit:cover;">
          <div style="margin-top:10px;">
            <label class="form-label">Subir nueva foto (opcional)</label>
            <input type="file" class="form-control" name="foto" accept="image/*" style="max-width:400px; margin:0 auto;">
          </div>
        </div>

        <!-- IDENTIFICACIÓN -->
        <h3 style="text-align:center; color:#666; margin-top:16px;">Información personal</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-3">
            <label>ID Usuario</label>
            <input type="text" class="form-control" name="idUsuario" value="<?php echo htmlspecialchars($row['idUsuario']); ?>" readonly>
          </div>
          <div class="col-md-3">
            <label>Tipo Documento</label>
            <select class="form-select" name="tipoDocumento">
              <option value="C.C" <?php echo $row['tipoDocumento']=='C.C'?'selected':''; ?>>C.C</option>
              <option value="C.E" <?php echo $row['tipoDocumento']=='C.E'?'selected':''; ?>>C.E</option>
              <option value="R.C" <?php echo $row['tipoDocumento']=='R.C'?'selected':''; ?>>R.C</option>
              <option value="T.I" <?php echo $row['tipoDocumento']=='T.I'?'selected':''; ?>>T.I</option>
            </select>
          </div>
          <div class="col-md-3">
            <label>Documento usuario</label>
            <input type="text" class="form-control" name="documentoUsuario" value="<?php echo htmlspecialchars($row['documentoUsuario']); ?>">
          </div>
          <div class="col-md-3">
            <label>Nombres</label>
            <input type="text" class="form-control" name="nombresUsuario" value="<?php echo htmlspecialchars($row['nombresUsuario']); ?>">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-3">
            <label>Usuario (login)</label>
            <input type="text" class="form-control" name="user_usuario" value="<?php echo htmlspecialchars($row['user_usuario']); ?>">
          </div>
          <div class="col-md-3">
            <label>Teléfono 1</label>
            <input type="text" class="form-control" name="telefonoUsuario" value="<?php echo htmlspecialchars($row['telefonoUsuario']); ?>">
          </div>
          <div class="col-md-3">
            <label>Teléfono 2</label>
            <input type="text" class="form-control" name="telefonoUsuario_dos" value="<?php echo htmlspecialchars($row['telefonoUsuario_dos']); ?>">
          </div>
          <div class="col-md-3">
            <label>Teléfono 3</label>
            <input type="text" class="form-control" name="telefonoUsuario_tres" value="<?php echo htmlspecialchars($row['telefonoUsuario_tres']); ?>">
          </div>
        </div>

        <!-- CONTACTO / UBICACIÓN -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Contacto y ubicación</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Correo</label>
            <input type="email" class="form-control" name="correoUsuario" value="<?php echo htmlspecialchars($row['correoUsuario']); ?>">
          </div>
          <div class="col-md-4">
            <label>Dirección</label>
            <input type="text" class="form-control" name="direccionUsuario" value="<?php echo htmlspecialchars($row['direccionUsuario']); ?>">
          </div>
          <div class="col-md-4">
            <label>Ciudad</label>
            <input type="text" class="form-control" name="ciudadUsuario" value="<?php echo htmlspecialchars($row['ciudadUsuario']); ?>">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Departamento</label>
            <input type="text" class="form-control" name="departamentoUsuario" value="<?php echo htmlspecialchars($row['departamentoUsuario']); ?>">
          </div>
          <div class="col-md-4">
            <label>País</label>
            <input type="text" class="form-control" name="paisUsuario" value="<?php echo htmlspecialchars($row['paisUsuario']); ?>">
          </div>
          <div class="col-md-4">
            <label>Código Postal</label>
            <input type="text" class="form-control" name="codigoPostalUsuario" value="<?php echo htmlspecialchars($row['codigoPostalUsuario']); ?>">
          </div>
        </div>

        <!-- REFERENCIAS / EMERGENCIA -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Contactos de referencia</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Contacto emergencia - Nombre</label>
            <input type="text" class="form-control" name="contactoEmergenciaNombre" value="<?php echo htmlspecialchars($row['contactoEmergenciaNombre']); ?>">
          </div>
          <div class="col-md-4">
            <label>Contacto emergencia - Teléfono</label>
            <input type="text" class="form-control" name="contactoEmergenciaTelefono" value="<?php echo htmlspecialchars($row['contactoEmergenciaTelefono']); ?>">
          </div>
          <div class="col-md-4">
            <label>Parentesco</label>
            <input type="text" class="form-control" name="contactoEmergenciaParentesco" value="<?php echo htmlspecialchars($row['contactoEmergenciaParentesco']); ?>">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-6">
            <label>Referencia personal - Nombre</label>
            <input type="text" class="form-control" name="referenciaPersonalNombre" value="<?php echo htmlspecialchars($row['referenciaPersonalNombre']); ?>">
          </div>
          <div class="col-md-6">
            <label>Referencia personal - Teléfono</label>
            <input type="text" class="form-control" name="referenciaPersonalTelefono" value="<?php echo htmlspecialchars($row['referenciaPersonalTelefono']); ?>">
          </div>
        </div>

        <!-- PERSONAL -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Datos personales</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-3">
            <label>Fecha de nacimiento</label>
            <input type="date" class="form-control" name="fechaNacimiento" value="<?php echo htmlspecialchars($row['fechaNacimiento']); ?>">
          </div>
          <div class="col-md-3">
            <label>Estado civil</label>
            <input type="text" class="form-control" name="estadoCivil" value="<?php echo htmlspecialchars($row['estadoCivil']); ?>">
          </div>
          <div class="col-md-3">
            <label>Número hijos</label>
            <input type="number" class="form-control" name="numeroHijos" value="<?php echo htmlspecialchars($row['numeroHijos']); ?>">
          </div>
          <!-- Eliminado duplicado user_usuario -->
        </div>


        <!-- LABORAL -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Información laboral / administrativa</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-3">
            <label>Cargo</label>
            <input type="text" class="form-control" name="cargo" value="<?php echo htmlspecialchars($row['cargo']); ?>">
          </div>
          <div class="col-md-3">
            <label>Área</label>
            <input type="text" class="form-control" name="area" value="<?php echo htmlspecialchars($row['area']); ?>">
          </div>
          <div class="col-md-3">
            <label>Fecha ingreso</label>
            <input type="date" class="form-control" name="fechaIngreso" value="<?php echo htmlspecialchars($row['fechaIngreso']); ?>">
          </div>
          <div class="col-md-3">
            <label>Tipo contrato</label>
            <input type="text" class="form-control" name="tipoContrato" value="<?php echo htmlspecialchars($row['tipoContrato']); ?>">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-3">
            <label>Salario base</label>
            <input type="number" step="0.01" class="form-control" name="salarioBase" value="<?php echo htmlspecialchars($row['salarioBase']); ?>">
          </div>
          <div class="col-md-3">
            <label>Supervisor ID</label>
            <input type="text" class="form-control" name="supervisorId" value="<?php echo htmlspecialchars($row['supervisorId']); ?>">
          </div>
          <div class="col-md-3">
            <label>ID Empresa</label>
            <input type="text" class="form-control" name="idEmpresa" value="<?php echo htmlspecialchars($row['idEmpresa']); ?>">
          </div>
          <div class="col-md-3">
            <label>ID Sucursal</label>
            <input type="text" class="form-control" name="idSucursal" value="<?php echo htmlspecialchars($row['idSucursal']); ?>">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Estado laboral</label>
            <select class="form-select" name="estadoLaboral">
              <option value="activo" <?php echo $row['estadoLaboral']=='activo'?'selected':''; ?>>activo</option>
              <option value="vacaciones" <?php echo $row['estadoLaboral']=='vacaciones'?'selected':''; ?>>vacaciones</option>
              <option value="licencia" <?php echo $row['estadoLaboral']=='licencia'?'selected':''; ?>>licencia</option>
              <option value="retirado" <?php echo $row['estadoLaboral']=='retirado'?'selected':''; ?>>retirado</option>
            </select>
          </div>
        </div>

        <!-- SEGURIDAD Y AUTENTICACIÓN -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Seguridad y autenticación</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Clave usuario (dejar vacío para no cambiar)</label>
            <input type="password" class="form-control" name="claveUsuario" placeholder="Nueva contraseña (opcional)">
          </div>
          <div class="col-md-4">
            <label>Último login</label>
            <input type="datetime-local" class="form-control" name="ultimoLogin" value="<?php echo to_datetime_local($row['ultimoLogin']); ?>">
          </div>
          <div class="col-md-4">
            <label>Intentos fallidos</label>
            <input type="number" class="form-control" name="intentosFallidos" value="<?php echo htmlspecialchars($row['intentosFallidos']); ?>">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Token recuperación</label>
            <input type="text" class="form-control" name="tokenRecuperacion" value="<?php echo htmlspecialchars($row['tokenRecuperacion']); ?>">
          </div>
          <div class="col-md-4">
            <label>Token expira</label>
            <input type="datetime-local" class="form-control" name="tokenExpira" value="<?php echo to_datetime_local($row['tokenExpira']); ?>">
          </div>
          <div class="col-md-4">
            <label>Two factor enabled</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="twoFactorEnabled" value="1" <?php echo $row['twoFactorEnabled'] ? 'checked' : ''; ?> >
              <label class="form-check-label">Habilitado</label>
            </div>
          </div>
        </div>

        <!-- ESTADO CUENTA Y PERMISOS -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Estado de cuenta y permisos</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-4">
            <label>Estado usuario</label>
            <select class="form-select" name="estadoUsuario">
              <option value="Activo" <?php echo $row['estadoUsuario']=='Activo'?'selected':''; ?>>Activo</option>
              <option value="Inactivo" <?php echo $row['estadoUsuario']=='Inactivo'?'selected':''; ?>>Inactivo</option>
            </select>
          </div>
          <div class="col-md-4">
            <label>Rol</label>
            <input type="text" class="form-control" name="rol" value="<?php echo htmlspecialchars($row['rol']); ?>">
          </div>
          <div class="col-md-4">
            <label>Eliminado</label>
            <div class="form-check">
              <input class="form-check-input" type="checkbox" name="eliminado" value="1" <?php echo $row['eliminado'] ? 'checked' : ''; ?> >
              <label class="form-check-label">Registro eliminado (lógico)</label>
            </div>
          </div>
        </div>

        <!-- SEGURIDAD SOCIAL / NÓMINA -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Seguridad social / Nómina</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-3"><label>EPS</label><input type="text" class="form-control" name="eps" value="<?php echo htmlspecialchars($row['eps']); ?>"></div>
          <div class="col-md-3"><label>ARL</label><input type="text" class="form-control" name="arl" value="<?php echo htmlspecialchars($row['arl']); ?>"></div>
          <div class="col-md-3"><label>Fondo pensión</label><input type="text" class="form-control" name="fondoPension" value="<?php echo htmlspecialchars($row['fondoPension']); ?>"></div>
          <div class="col-md-3"><label>Banco</label><input type="text" class="form-control" name="banco" value="<?php echo htmlspecialchars($row['banco']); ?>"></div>
        </div>

        <div class="row mb-2">
          <div class="col-md-6"><label>Número cuenta bancaria</label><input type="text" class="form-control" name="numeroCuentaBancaria" value="<?php echo htmlspecialchars($row['numeroCuentaBancaria']); ?>"></div>
          <div class="col-md-6"><label>fotoUsuario (ruta)</label><input type="text" class="form-control" name="fotoUsuario" value="<?php echo htmlspecialchars($row['fotoUsuario']); ?>"></div>
        </div>

        <!-- AUDITORÍA Y Trazabilidad -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Auditoría y trazabilidad</h3>
        <hr>

        <div class="row mb-2">
          <div class="col-md-3">
            <label>Creado</label>
            <input type="date" class="form-control" name="creado" value="<?php echo htmlspecialchars($row['creado']); ?>">
          </div>
          <div class="col-md-3">
            <label>Última actualización</label>
            <input type="date" class="form-control" name="ultimaActualizacion" value="<?php echo htmlspecialchars($row['ultimaActualizacion']); ?>">
          </div>
          <div class="col-md-3">
            <label>Creado por (ID)</label>
            <input type="text" class="form-control" name="creadoPor" value="<?php echo htmlspecialchars($row['creadoPor']); ?>">
          </div>
          <div class="col-md-3">
            <label>Actualizado por (ID)</label>
            <input type="text" class="form-control" name="actualizadoPor" value="<?php echo htmlspecialchars($row['actualizadoPor']); ?>">
          </div>
        </div>

        <div class="row mb-2">
          <div class="col-md-4"><label>IP registro</label><input type="text" class="form-control" name="ipRegistro" value="<?php echo htmlspecialchars($row['ipRegistro']); ?>"></div>
          <div class="col-md-4"><label>IP último acceso</label><input type="text" class="form-control" name="ipUltimoAcceso" value="<?php echo htmlspecialchars($row['ipUltimoAcceso']); ?>"></div>
          <div class="col-md-4"><label>Navegador último acceso</label><input type="text" class="form-control" name="navegadorUltimoAcceso" value="<?php echo htmlspecialchars($row['navegadorUltimoAcceso']); ?>"></div>
        </div>

        <!-- TOKENS / CAMBIOS -->
        <div class="row mb-2">
          <div class="col-md-6"><label>Último cambio de clave</label><input type="datetime-local" class="form-control" name="ultimoCambioClave" value="<?php echo to_datetime_local($row['ultimoCambioClave']); ?>"></div>
          <div class="col-md-6"><label>Token recuperacion (texto)</label><input type="text" class="form-control" name="tokenRecuperacion" value="<?php echo htmlspecialchars($row['tokenRecuperacion']); ?>"></div>
        </div>

        <!-- DOCUMENTOS Y NOTAS -->
        <h3 style="text-align:center; color:#666; margin-top:18px;">Documentos y notas</h3>
        <hr>

        <div class="mb-2">
          <label>Documentos adjuntos (texto/JSON/rutas)</label>
          <textarea class="form-control" name="documentosAdjuntos" rows="3"><?php echo htmlspecialchars($row['documentosAdjuntos']); ?></textarea>
        </div>

        <div class="mb-2">
          <label>Notas</label>
          <textarea class="form-control" name="notas" rows="4"><?php echo htmlspecialchars($row['notas']); ?></textarea>
        </div>

        <!-- OTROS CAMPOS RESTANTES (visibles/edicion directa) -->
        <div class="row mb-3">
          <div class="col-md-4"><label>foto (campo)</label><input type="text" class="form-control" name="foto" value="<?php echo htmlspecialchars($row['foto']); ?>"></div>
          <div class="col-md-4"><label>tokenExpira (datetime)</label><input type="datetime-local" class="form-control" name="tokenExpira" value="<?php echo to_datetime_local($row['tokenExpira']); ?>"></div>
          <div class="col-md-4"><label>intentosFallidos</label><input type="number" class="form-control" name="intentosFallidos" value="<?php echo htmlspecialchars($row['intentosFallidos']); ?>"></div>
        </div>

        <!-- BOTONES -->
        <div style="text-align:center; margin-top:18px;">
          <input type="submit" class="btn btn-primary btn-lg" value="Actualizar">
          <a href="tablasUser.php" class="btn btn-secondary btn-lg" style="margin-left:8px;">Volver</a>
        </div>

      </form>
    </div>
  </div>
</div>

</body>
</html>

<style>
/* ====== Campos de solo lectura en color oscuro ====== */
input.form-control[readonly],
textarea.form-control[readonly],
select.form-control[readonly],
input.form-control:disabled,
textarea.form-control:disabled,
select.form-control:disabled {
  background-color: #2c2c2c !important; /* gris oscuro */
  color: #ffffff !important;             /* texto blanco */
  border: 1px solid #555 !important;     /* borde gris */
  opacity: 1 !important;                 /* sin transparencia */
  cursor: not-allowed;                   /* indicar que no se puede editar */
}

/* Ajustar color del texto del label para visibilidad */
label {
  color: #f0f0f0 !important;
}
</style>
