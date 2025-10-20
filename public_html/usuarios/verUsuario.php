<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verifica sesión activa
if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit();
}

require_once __DIR__ . '/../../config/db.php';
include '../../includes/header.php';

// Helper de saneamiento
function s($v) {
    return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}
?>
<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h1 style="font-size: 32px;">DETALLES DEL USUARIO</h1>
    </div>

    <div class="card">
      <div class="card-body">

        <?php
        // Validar que venga el identificador (puede ser idUsuario o documentoUsuario)
        if (!isset($_GET['id']) || trim($_GET['id']) === '') {
            echo "<div class='alert alert-danger'>No se especificó un usuario.</div>";
        } else {
            $idRaw = trim($_GET['id']);
            $idParam = $idRaw;

            // Consulta todos los campos relevantes de la tabla usuario
            $sql = "
                SELECT
                    idUsuario,
                    tipoDocumento,
                    documentoUsuario,
                    nombresUsuario,
                    user_usuario,
                    telefonoUsuario,
                    telefonoUsuario_dos,
                    telefonoUsuario_tres,
                    correoUsuario,
                    direccionUsuario,
                    claveUsuario,
                    estadoUsuario,
                    creado,
                    ultimaActualizacion,
                    rol,
                    foto, /* foto personalizada */
                    ciudadUsuario,
                    departamentoUsuario,
                    paisUsuario,
                    codigoPostalUsuario,
                    contactoEmergenciaNombre,
                    contactoEmergenciaTelefono,
                    contactoEmergenciaParentesco,
                    referenciaPersonalNombre,
                    referenciaPersonalTelefono,
                    fechaNacimiento,
                    estadoCivil,
                    numeroHijos,
                    cargo,
                    area,
                    fechaIngreso,
                    tipoContrato,
                    salarioBase,
                    supervisorId,
                    idEmpresa,
                    idSucursal,
                    estadoLaboral,
                    eps,
                    arl,
                    fondoPension,
                    banco,
                    numeroCuentaBancaria,
                    ultimoLogin,
                    intentosFallidos,
                    tokenRecuperacion,
                    tokenExpira,
                    twoFactorEnabled,
                    ultimoCambioClave,
                    eliminado,
                    creadoPor,
                    actualizadoPor,
                    ipRegistro,
                    ipUltimoAcceso,
                    navegadorUltimoAcceso,
                    documentosAdjuntos,
                    notas
                FROM usuario
                WHERE documentoUsuario = ? OR idUsuario = ?
                LIMIT 1
            ";

            if ($stmt = $con->prepare($sql)) {
                $stmt->bind_param("ss", $idParam, $idParam);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result && $result->num_rows > 0) {
                    $usuario = $result->fetch_assoc();

                    // --- Manejo de foto ---
                    // Ruta relativa desde este archivo hasta public_html/assets/images/faces-clipart/
                    // Ajusta "../" según la ubicación real de este archivo; según lo indicado se usa "../"
                    $fotoBasePath = "../assets/images/faces-clipart/";
                    $fotoPorDefecto = "pic-1.png";

                    if (!empty($usuario['foto']) && file_exists($fotoBasePath . $usuario['foto'])) {
                        $rutaFoto = $fotoBasePath . $usuario['foto'];
                    } else {
                        $rutaFoto = $fotoBasePath . $fotoPorDefecto;
                    }
                    // --- Fin manejo de foto ---
                    ?>

                    <!-- FOTO Y NOMBRE -->
<div class="text-center mb-4">
  <img src="<?php echo s($rutaFoto); ?>" 
       alt="Foto del usuario" 
       class="img-fluid rounded-circle border mb-3" 
       style="width:80px; height:80px; object-fit:cover;">
  <h3 class="fw-bold mb-0 text-secondary"><?php echo s($usuario['nombresUsuario']); ?></h3>
  <small class="text-muted d-block"><?php echo s($usuario['cargo'] . ' • ' . $usuario['area']); ?></small>
</div>

<!-- TABLA DETALLES -->
<div class="table-responsive">
  <table class="table table-bordered table-striped align-middle">
    <tbody>

      <!-- Información personal -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Información personal</th></tr>
      <tr>
        <th>ID Usuario</th><td><?php echo s($usuario['idUsuario']); ?></td>
        <th>Tipo Documento</th><td><?php echo s($usuario['tipoDocumento']); ?></td>
      </tr>
      <tr>
        <th>Número Documento</th><td><?php echo s($usuario['documentoUsuario']); ?></td>
        <th>Usuario (login)</th><td><?php echo s($usuario['user_usuario']); ?></td>
      </tr>
      <tr>
        <th>Fecha nacimiento</th><td><?php echo s($usuario['fechaNacimiento']); ?></td>
        <th>Estado civil</th><td><?php echo s($usuario['estadoCivil']); ?></td>
      </tr>
      <tr>
        <th>Número de hijos</th><td><?php echo s($usuario['numeroHijos']); ?></td>
        <th>País</th><td><?php echo s($usuario['paisUsuario']); ?></td>
      </tr>

      <!-- Contacto -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Contacto</th></tr>
      <tr>
        <th>Teléfono 1</th><td><?php echo s($usuario['telefonoUsuario']); ?></td>
        <th>Teléfono 2</th><td><?php echo s($usuario['telefonoUsuario_dos']); ?></td>
      </tr>
      <tr>
        <th>Teléfono 3</th><td><?php echo s($usuario['telefonoUsuario_tres']); ?></td>
        <th>Correo</th><td><?php echo s($usuario['correoUsuario']); ?></td>
      </tr>
      <tr>
        <th>Dirección</th><td><?php echo s($usuario['direccionUsuario']); ?></td>
        <th>Ciudad</th><td><?php echo s($usuario['ciudadUsuario']); ?></td>
      </tr>
      <tr>
        <th>Departamento</th><td><?php echo s($usuario['departamentoUsuario']); ?></td>
        <th>Código Postal</th><td><?php echo s($usuario['codigoPostalUsuario']); ?></td>
      </tr>

      <!-- Información laboral -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Información laboral</th></tr>
      <tr>
        <th>Cargo</th><td><?php echo s($usuario['cargo']); ?></td>
        <th>Área</th><td><?php echo s($usuario['area']); ?></td>
      </tr>
      <tr>
        <th>Tipo Contrato</th><td><?php echo s($usuario['tipoContrato']); ?></td>
        <th>Fecha Ingreso</th><td><?php echo s($usuario['fechaIngreso']); ?></td>
      </tr>
      <tr>
        <th>Salario Base</th><td><?php echo isset($usuario['salarioBase']) ? '$' . number_format($usuario['salarioBase'], 0, ',', '.') : ''; ?></td>
        <th>Estado Laboral</th><td><?php echo s($usuario['estadoLaboral']); ?></td>
      </tr>
      <tr>
        <th>ID Empresa</th><td><?php echo s($usuario['idEmpresa']); ?></td>
        <th>ID Sucursal</th><td><?php echo s($usuario['idSucursal']); ?></td>
      </tr>

      <!-- Contactos de referencia -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Contactos de referencia</th></tr>
      <tr>
        <th>Emergencia</th><td><?php echo s($usuario['contactoEmergenciaNombre']); ?></td>
        <th>Teléfono emergencia</th><td><?php echo s($usuario['contactoEmergenciaTelefono']); ?></td>
      </tr>
      <tr>
        <th>Parentesco</th><td><?php echo s($usuario['contactoEmergenciaParentesco']); ?></td>
        <th>Referencia personal</th><td><?php echo s($usuario['referenciaPersonalNombre']); ?></td>
      </tr>
      <tr>
        <th>Teléfono referencia</th><td><?php echo s($usuario['referenciaPersonalTelefono']); ?></td>
        <td colspan="2"></td>
      </tr>

      <!-- Seguridad Social -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Seguridad Social</th></tr>
      <tr>
        <th>EPS</th><td><?php echo s($usuario['eps']); ?></td>
        <th>ARL</th><td><?php echo s($usuario['arl']); ?></td>
      </tr>
      <tr>
        <th>Fondo pensión</th><td><?php echo s($usuario['fondoPension']); ?></td>
        <th>Banco</th><td><?php echo s($usuario['banco']); ?></td>
      </tr>
      <tr>
        <th>Cuenta Bancaria</th><td><?php echo s($usuario['numeroCuentaBancaria']); ?></td>
        <th>Supervisor ID</th><td><?php echo s($usuario['supervisorId']); ?></td>
      </tr>

      <!-- Auditoría -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Auditoría y trazabilidad</th></tr>
      <tr>
        <th>Creado</th><td><?php echo s($usuario['creado']); ?></td>
        <th>Última actualización</th><td><?php echo s($usuario['ultimaActualizacion']); ?></td>
      </tr>
      <tr>
        <th>IP Registro</th><td><?php echo s($usuario['ipRegistro']); ?></td>
        <th>IP Último acceso</th><td><?php echo s($usuario['ipUltimoAcceso']); ?></td>
      </tr>
      <tr>
        <th>Navegador</th><td colspan="3"><?php echo s($usuario['navegadorUltimoAcceso']); ?></td>
      </tr>

      <!-- Notas -->
      <tr class="section-title"><th colspan="4" class="text-center text-secondary">Notas y documentos</th></tr>
      <tr>
        <th>Notas</th><td colspan="3"><?php echo nl2br(s($usuario['notas'])); ?></td>
      </tr>
      <tr>
        <th>Documentos adjuntos</th><td colspan="3"><?php echo nl2br(s($usuario['documentosAdjuntos'])); ?></td>
      </tr>

    </tbody>
  </table>
</div>

<?php
                } else {
                    echo "<div class='alert alert-warning'>Usuario no encontrado.</div>";
                }

                $stmt->close();
            } else {
                echo "<div class='alert alert-danger'>Error en la consulta: " . s($con->error) . "</div>";
            }
        }
        ?>

<div class="mt-3">
    <a href="tablasUser.php" class="btn btn-secondary">← Volver a la lista</a>
    <a href="actualizarUser.php?id=<?php echo urlencode($usuario['documentoUsuario'] ?: $usuario['idUsuario']); ?>" class="btn btn-info">Editar Usuario</a>

    <?php
    // Botón condicional según el estado
    $estado = $usuario['estadoUsuario'] ?? '';
    $doc = $usuario['documentoUsuario'] ?: $usuario['idUsuario'];

    if (strtolower($estado) === 'activo') {
        echo "<a href='deleteUsuario.php?id={$doc}&accion=archivar' class='btn btn-warning' onclick='return confirm(\"¿Archivar este usuario?\")'>Archivar</a>";
    } else {
        echo "<a href='deleteUsuario.php?id={$doc}&accion=eliminar' class='btn btn-danger' onclick='return confirm(\"¿Eliminar definitivamente este usuario?\")'>Eliminar</a>";
    }
    ?>
</div>

      </div>
    </div>
  </div>
</div>

</body>
</html>



