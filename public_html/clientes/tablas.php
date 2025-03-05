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
    <!-- partial -->

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h1 style="font-size: 32px;">GESTIÓN CLIENTES</h1>

            </div>
            <div class="card">
                <div class="card-body">
                    <a href="ingresar.php" class="btn btn-primary btn-lg " role="button" aria-pressed="true">Crear nuevo cliente</a>
                    <a href="principal.php" class="btn btn-primary btn-lg " role="button" aria-pressed="true">Consultar cliente</a>

                    <a href="../excel/excelCliente.php" class="btn btn-success btn-lg" onclick="return confirmarExportacion();">
                        Exportar a Excel
                    </a>

                    <script>
                    function confirmarExportacion() {
                        return confirm("¿Está seguro de que desea exportar la lista a Excel?");
                    }
                    </script>
                    <?php
                    require_once __DIR__ . '/../../config/db.php';
                    $sql = "SELECT cliente.tipoDocumento,cliente.documentoCliente,cliente.nombreCliente,plan.nombrePlan FROM cliente 
                    INNER JOIN plan
                    ON cliente.plan_idPlan=plan.idPlan
                    WHERE estadoCliente='Activo'
                    ORDER BY nombreCliente ASC;";

                    echo
                    '<div class="table-responsive">
                    
        <table class="table table-hover ">
          <thead>
            <tr>
              <th> Tipo identificacion </th>
              <th> Numero de documento</th>
              <th> Nombres</th>
              <th> Plan</th>
              <th> Actualizar</th>
              <th> Eliminar</th>
            </tr>
          </thead>';

                    if ($rta = $con->query($sql)) {
                        while ($row = $rta->fetch_assoc()) {
                            $td = $row['tipoDocumento'];
                            $id = $row['documentoCliente'];
                            $nombres = $row['nombreCliente'];
                            $plan = $row['nombrePlan'];
                    ?>
                            <tr>
                                <td> <?php echo $td ?></td>
                                <td> <?php echo $id ?></td>
                                <td> <?php echo $nombres ?></td>
                                <td> <?php echo $plan ?></td>
                                <td>
                                    <a href="actualizar.php?id=<?php echo $row['documentoCliente'] ?>" class="btn btn-info">Editar</a>
                                </td>
                                <td>
                                    <a class="borrar btn btn-danger" href="delete.php?id=<?php echo $row['documentoCliente'] ?>">Eliminar</a>
                                </td>



                            </tr>
                    <?php
                        }
                    }
                    ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
     </div>
</body>

</html>