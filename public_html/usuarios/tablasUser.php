<?php
// Seguridad de sesiones
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';

// Determinar vista (Activo / Inactivo)
$vistaRaw = $_GET['estado'] ?? 'Activo';
$vista = ($vistaRaw === 'Inactivo') ? 'Inactivo' : 'Activo';

// Preparar SQL según vista, excluyendo idUsuario = 1
if ($vista === 'Activo') {
    $sql = "SELECT * FROM usuario 
            WHERE estadoUsuario='Activo' 
            AND idUsuario <> 1 
            ORDER BY nombresUsuario ASC;";
} else {
    $sql = "SELECT * FROM usuario 
            WHERE (estadoUsuario='Inactivo' OR estadoUsuario IS NULL) 
            AND idUsuario <> 1 
            ORDER BY nombresUsuario ASC;";
}
?>
<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="page-header">
            <h1 style="font-size: 32px;">
                GESTIÓN USUARIOS DE LA EMPRESA - <?php echo strtoupper($vista); ?>
            </h1>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <a href="?estado=Activo" class="btn btn-outline-secondary btn-fw flex-fill <?php echo ($vista === 'Activo') ? 'active' : ''; ?>">Ver Activos</a>
                    <a href="ingresarUser.php" class="btn btn-outline-primary btn-fw flex-fill">Crear nuevo usuario</a>
                    <a href="../excel/excelUsuario.php" class="btn btn-outline-success btn-fw flex-fill">Exportar tabla a Excel</a>
                    <a href="?estado=Inactivo" class="btn btn-outline-danger btn-fw flex-fill <?php echo ($vista === 'Inactivo') ? 'active' : ''; ?>">Ver Inactivos</a>
                </div>
                <?php
                if ($rta = $con->query($sql)) {
                    if ($rta->num_rows > 0) {
                        echo '<div class="table-responsive mt-3">
                                <table class="table table-hover">
                                  <thead class="table-light">
                                        <tr>
                                            <th>Ver</th>
                                            <th>Tipo</th>
                                            <th>Núm doc</th>
                                            <th>Nombres</th>
                                            <th>Rol</th>
                                            <th>Tel. uno</th>
                                            <th>Email</th>
                                            <th>Estado</th>
                                            <th>Ciudad</th>
                                            <th>inicio</th>
                                        </tr>
                                    </thead>
                                    <tbody>';
                        while ($row = $rta->fetch_assoc()) {
                            $tipoDoc = htmlspecialchars($row['tipoDocumento']);
                            $doc = htmlspecialchars($row['documentoUsuario']);
                            $nombres = htmlspecialchars($row['nombresUsuario']);
                            $rol = htmlspecialchars($row['rol']);
                            $telefono = htmlspecialchars($row['telefonoUsuario']);
                            $email = htmlspecialchars($row['correoUsuario']);
                            $estado = htmlspecialchars($row['estadoUsuario'] ?? 'Inactivo');
                            $ciudad = htmlspecialchars($row['ciudadUsuario']);
                            $creado = htmlspecialchars($row['creado']);
                            $idusuario = $doc;

                            echo "<tr>
                                    <td><a href='verusuario.php?id={$idusuario}' class='btn btn-secondary'>Ver</a></td>
                                    <td>{$tipoDoc}</td>
                                    <td>{$doc}</td>
                                    <td>{$nombres}</td>
                                    <td>{$rol}</td>
                                    <td>{$telefono}</td>
                                    <td>{$email}</td>
                                    <td>{$estado}</td>
                                    <td>{$ciudad}</td>
                                    <td>{$creado}</td>

                                  </tr>";
                        }
                        echo '</tbody></table></div>';
                    } else {
                        echo "<p class='mt-3'>No hay usuarios con estado <strong>{$vista}</strong>.</p>";
                    }
                } else {
                    echo "<p class='text-danger'>Error en la consulta: " . htmlspecialchars($con->error) . "</p>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>
