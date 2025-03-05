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
  <style type="text/css">/* Chart.js */
@keyframes chartjs-render-animation{from{opacity:.99}to{opacity:1}}.chartjs-render-monitor{animation:chartjs-render-animation 1ms}.chartjs-size-monitor,.chartjs-size-monitor-expand,.chartjs-size-monitor-shrink{position:absolute;direction:ltr;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1}.chartjs-size-monitor-expand>div{position:absolute;width:1000000px;height:1000000px;left:0;top:0}.chartjs-size-monitor-shrink>div{position:absolute;width:200%;height:200%;left:0;top:0}</style></head>
<?php
// Incluir la conexión a la base de datos
require_once __DIR__ . '/../../config/db.php';
?>

<body>
    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper"> 
            <div class="card-body">
                <a href="usuarios.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Volver al inicio</a>

                <?php
                // Verificar si se recibió un ID
                if (isset($_POST['id']) && !empty($_POST['id'])) {
                    // Escapar el ID para evitar inyección SQL
                    $id = mysqli_real_escape_string($con, $_POST['id']);
                    $sql = "SELECT * FROM usuario WHERE documentoUsuario='$id'";
                    $rta = $con->query($sql);

                    if ($rta && $rta->num_rows > 0) {
                        echo '<div class="table-responsive">
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
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>';

                        while ($row = $rta->fetch_assoc()) {
                            echo "<tr>
                                <td>{$row['tipoDocumento']}</td>    
                                <td>{$row['documentoUsuario']}</td> 
                                <td>{$row['nombresUsuario']}</td> 
                                <td>{$row['telefonoUsuario']}</td> 
                                <td>{$row['correoUsuario']}</td> 
                                <td>{$row['claveUsuario']}</td> 
                                <td>{$row['estadoUsuario']}</td> 
                                <td>{$row['creado']}</td> 
                                <td>{$row['ultimaActualizacion']}</td> 
                                <td>
                                    <a href='updateUser.php?id={$row['documentoUsuario']}' class='btn btn-info'>Editar</a>
                                </td>
                                <td>
                                    <a href='../cliente/delete.php?id={$row['documentoUsuario']}' class='btn btn-danger' onclick='return confirm(\"¿Seguro que deseas eliminar este usuario?\")'>Eliminar</a>
                                </td>
                            </tr>";
                        }

                        echo "</tbody></table></div>";
                    } else {
                        echo "<p class='text-danger'>No se encontró ningún usuario con el documento ingresado.</p>";
                    }
                } else {
                    echo "<p class='text-danger'>No se ha recibido un documento válido.</p>";
                }
                ?>

            </div>
        </div>
    </div>
</body>
</html>
