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
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Todos los planes activos</h3>
      </div>
      <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Lista de Planes</h4>
                <form class="forms-sample">
                    <?php
                    require_once __DIR__ . '/../../config/db.php';

                    $sql = "SELECT * FROM plan WHERE estadoPlan='activo';";
                    $rta = $con->query($sql);

                    if ($rta) {
                        echo '<div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th> Código Plan </th>
                                        <th> Velocidad de Plan </th>
                                        <th> Nombre de Plan </th>
                                        <th> Precio de Plan </th>
                                        <th> Descripción del Plan </th>
                                        <th> Estado de Plan </th>
                                        <th> Actualizar </th>
                                        <th> Eliminar </th>
                                    </tr>
                                </thead>
                                <tbody>';

                        while ($row = $rta->fetch_assoc()) {
                            echo '<tr>
                                <td>' . htmlspecialchars($row['codigoPlan']) . '</td>
                                <td>' . htmlspecialchars($row['velocidad']) . '</td>
                                <td>' . htmlspecialchars($row['nombrePlan']) . '</td>
                                <td>' . htmlspecialchars($row['precioPlan']) . '</td>
                                <td>' . htmlspecialchars($row['desPlan']) . '</td>
                                <td>' . htmlspecialchars($row['estadoPlan']) . '</td>
                                <td>
                                    <a href="actualizar.php?cp=' . urlencode($row['codigoPlan']) . '" class="btn btn-info">Editar</a>
                                </td>
                                <td>
                                    <a href="eliminarplan.php?cp=' . urlencode($row['codigoPlan']) . '" class="btn btn-danger">Eliminar</a>
                                </td>
                            </tr>';
                        }

                        echo '</tbody></table></div>';
                    } else {
                        echo '<p class="text-danger">Error al consultar la base de datos.</p>';
                    }
                    ?>

                    <div class="form-button mt-5">
                        <button id="submit" type="submit" formmethod="post" formaction="tablaplanes.php" class="btn btn-primary">Consultar planes activos</button>
                        <button id="submit" type="submit" formmethod="post" formaction="nuevoplan.php" class="btn btn-primary">Ingresar nuevo plan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    </div>
  </div>
  </div>
  </div>
</body>

</html>