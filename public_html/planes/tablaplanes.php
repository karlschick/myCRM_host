<?php
// Seguridad de sesiones
session_start();
error_reporting(0);

// Verifica si el usuario tiene una sesión activa
if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

// Incluye el encabezado de la página
include '../../includes/header.php';
?>
<body>
    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>

    <!-- Contenedor principal -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h1 style="font-size: 32px;">GESTIÓN PLANES</h1>
            </div>

            <div class="card">
                <div class="card-body">
                    <!-- Botones de acción -->
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <a href="../planes/nuevoplan.php" class="btn btn-outline-primary btn-fw flex-fill">Ingresar nuevo plan</a>
                        <a href="../excel/excelPlanes.php" class="btn btn-outline-success btn-fw flex-fill">Exportar tabla a Excel</a>
                        <a href="../planes/tablaplanesinac.php" class="btn btn-outline-warning btn-fw flex-fill">Ver planes Inactivos</a>
                    </div>

                    <!-- Tabla de planes -->
                    <?php
                    require_once __DIR__ . '/../../config/db.php';
                    $sql = "SELECT * FROM plan WHERE estadoPlan='activo';";
                    
                    echo '<div class="table-responsive">
                            <table class="table table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Ver</th>
                                        <th>Código Plan</th>
                                        <th>Velocidad de Plan</th>
                                        <th>Nombre de Plan</th>
                                        <th>Precio de Plan</th>
                                        <th>Estado de Plan</th>
                                        <th>Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>';

                    if ($rta = $con->query($sql)) {
                        while ($row = $rta->fetch_assoc()) {
                            $cp = htmlspecialchars($row['codigoPlan']);
                            $vel = htmlspecialchars($row['velocidad']);
                            $nplan = htmlspecialchars($row['nombrePlan']);
                            $pplan = htmlspecialchars($row['precioPlan']);
                            $estadop = htmlspecialchars($row['estadoPlan']);
                    ?>
                            <tr>
                                <td>
                                    <a href="actualizar.php?cp=<?php echo $cp; ?>" class='btn btn-secondary'>Ver</a>
                                </td>
                                <td><?php echo $cp; ?></td>
                                <td><?php echo $vel; ?></td>
                                <td><?php echo $nplan; ?></td>
                                <td><?php echo $pplan; ?></td>
                                <td><?php echo $estadop; ?></td>
                                <td>
                                    <a href="eliminarplan.php?cp=<?php echo $cp; ?>" class="borrar btn btn-danger">Archivar</a>
                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='7' class='text-center text-danger'>Error al consultar los datos.</td></tr>";
                    }

                    echo '          </tbody>
                                </table>
                            </div>'; // Cierra table-responsive
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>