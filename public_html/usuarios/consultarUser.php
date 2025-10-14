<!-- actualizado -->
<?php
// Seguridad de sesiones
session_start();
error_reporting(0);

// Verifica si el usuario tiene una sesión activa
if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

// Incluye el encabezado
include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';
?>
<style type="text/css">
/* Chart.js */
@keyframes chartjs-render-animation {
    from { opacity: .99 }
    to { opacity: 1 }
}
.chartjs-render-monitor {
    animation: chartjs-render-animation 1ms
}
.chartjs-size-monitor,
.chartjs-size-monitor-expand,
.chartjs-size-monitor-shrink {
    position: absolute;
    direction: ltr;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    pointer-events: none;
    visibility: hidden;
    z-index: -1
}
.chartjs-size-monitor-expand>div {
    position: absolute;
    width: 1000000px;
    height: 1000000px;
    left: 0;
    top: 0
}
.chartjs-size-monitor-shrink>div {
    position: absolute;
    width: 200%;
    height: 200%;
    left: 0;
    top: 0
}
</style>
</head>

<body>
    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card-body">
                <a href="usuarios.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Volver al inicio</a>

                <?php
                if (isset($_POST['id']) && !empty($_POST['id'])) {
                    $id = mysqli_real_escape_string($con, $_POST['id']);
                    $sql = "SELECT * FROM usuario WHERE documentoUsuario='$id'";
                    $rta = $con->query($sql);

                    if ($rta && $rta->num_rows > 0) {
                        echo '<div class="table-responsive mt-4">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Tipo ide</th>
                                    <th>Núm doc</th>
                                    <th>Nombres</th>
                                    <th>Teléfono</th>
                                    <th>Email</th>
                                    <th>Clave</th>
                                    <th>Estado</th>
                                    <th>Fecha creación</th>
                                    <th>Última Actual</th>
                                    <th>Actualizar</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>';

                        while ($row = $rta->fetch_assoc()) {
                            $tipo = htmlspecialchars($row['tipoDocumento']);
                            $doc = htmlspecialchars($row['documentoUsuario']);
                            $nombre = htmlspecialchars($row['nombresUsuario']);
                            $tel = htmlspecialchars($row['telefonoUsuario']);
                            $email = htmlspecialchars($row['correoUsuario']);
                            $estado = htmlspecialchars($row['estadoUsuario']);
                            $creado = htmlspecialchars($row['creado']);
                            $actualizado = htmlspecialchars($row['ultimaActualizacion']);

                            // Mostrar texto fijo en lugar de la contraseña cifrada
                            $clave_mostrada = "Protegida";

                            echo "<tr>
                                <td>{$tipo}</td>    
                                <td>{$doc}</td> 
                                <td>{$nombre}</td> 
                                <td>{$tel}</td> 
                                <td>{$email}</td> 
                                <td>{$clave_mostrada}</td> 
                                <td>{$estado}</td> 
                                <td>{$creado}</td> 
                                <td>{$actualizado}</td> 
                                <td>
                                    <a href='actualizarUser.php?id={$doc}' class='btn btn-info'>Editar</a>
                                </td>
                                <td>";

                            // Si el usuario está activo → botón "Archivar"
                            if (strtolower($estado) === 'activo') {
                                echo "<a href='deleteUsuario.php?id={$doc}&accion=archivar' class='btn btn-warning' onclick='return confirm(\"¿Archivar este usuario?\")'>Archivar</a>";
                            } else {
                                // Si está inactivo → botón "Eliminar"
                                echo "<a href='deleteUsuario.php?id={$doc}&accion=eliminar' class='btn btn-danger' onclick='return confirm(\"¿Eliminar definitivamente este usuario?\")'>Eliminar</a>";
                            }

                            echo "</td></tr>";
                        }

                        echo "</tbody></table></div>";
                    } else {
                        echo "<p class='text-danger mt-3'>No se encontró ningún usuario con el documento ingresado.</p>";
                    }
                } else {
                    echo "<p class='text-danger mt-3'>No se ha recibido un documento válido.</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
