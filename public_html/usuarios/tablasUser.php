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

// Preparar SQL según vista
if ($vista === 'Activo') {
    $sql = "SELECT * FROM usuario WHERE estadoUsuario='Activo' ORDER BY nombresUsuario ASC;";
} else {
    // Inactivos: explícitamente 'Inactivo' o NULL
    $sql = "SELECT * FROM usuario WHERE estadoUsuario='Inactivo' OR estadoUsuario IS NULL ORDER BY nombresUsuario ASC;";
}
?>
<body>
    <!-- Incluye el menú de navegación -->
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
                    <a href="ingresarUser.php" class="btn btn-primary btn-lg" role="button">Crear nuevo usuario</a>
                    <a href="usuarios.php" class="btn btn-primary btn-lg" role="button">Consultar usuario</a>
                    <a href="../excel/excelUsuario.php" class="btn btn-success btn-lg">Exportar tabla a Excel</a>

                    <!-- Botones para cambiar vista -->
                    <div class="mt-3 mb-3">
                        <a href="?estado=Activo" class="btn btn-outline-primary <?php echo ($vista === 'Activo') ? 'active' : ''; ?>">Ver Activos</a>
                        <a href="?estado=Inactivo" class="btn btn-outline-secondary <?php echo ($vista === 'Inactivo') ? 'active' : ''; ?>">Ver Inactivos</a>
                    </div>

                    <?php
                    if ($rta = $con->query($sql)) {
                        if ($rta->num_rows > 0) {
                            echo '<div class="table-responsive mt-3">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Tipo ide</th>
                                                <th>Núm doc</th>
                                                <th>Nombres</th>
                                                <th>Teléfono</th>
                                                <th>Email</th>
                                                <th>Estado</th>
                                                <th>Fecha creación</th>
                                                <th>Última Actual</th>
                                                <th>Rol</th>
                                                <th>Actualizar</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                            while ($row = $rta->fetch_assoc()) {
                                $tipoDoc = htmlspecialchars($row['tipoDocumento']);
                                $doc = htmlspecialchars($row['documentoUsuario']);
                                $nombres = htmlspecialchars($row['nombresUsuario']);
                                $telefono = htmlspecialchars($row['telefonoUsuario']);
                                $email = htmlspecialchars($row['correoUsuario']);
                                $estado = htmlspecialchars($row['estadoUsuario'] ?? 'Inactivo');
                                $creado = htmlspecialchars($row['creado']);
                                $ultima = htmlspecialchars($row['ultimaActualizacion']);
                                $rol = htmlspecialchars($row['rol']);

                                echo "<tr>
                                        <td>{$tipoDoc}</td>
                                        <td>{$doc}</td>
                                        <td>{$nombres}</td>
                                        <td>{$telefono}</td>
                                        <td>{$email}</td>
                                        <td>{$estado}</td>
                                        <td>{$creado}</td>
                                        <td>{$ultima}</td>
                                        <td>{$rol}</td>
                                        <td><a href='actualizarUser.php?id={$doc}' class='btn btn-info'>Editar</a></td>";

                                // 🔸 CUANDO ESTÁ EN "VER ACTIVOS" → Botón se llama "Archivar"
                                if ($vista === 'Activo') {
                                    echo "<td><a href='deleteUsuario.php?id={$doc}&accion=archivar' class='btn btn-warning'>Archivar</a></td>";
                                } 
                                // 🔸 CUANDO ESTÁ EN "VER INACTIVOS" → Botón se llama "Eliminar"
                                else {
                                    echo "<td><a href='deleteUsuario.php?id={$doc}&accion=eliminar' class='btn btn-danger' onclick='return confirm(\"¿Seguro que desea eliminar este usuario definitivamente?\")'>Eliminar</a></td>";
                                }

                                echo "</tr>";
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
