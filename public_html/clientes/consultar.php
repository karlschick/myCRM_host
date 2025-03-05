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
        <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
            <div class="card-body">
                <a href="principal.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Volver al inicio</a>
                <?php
                require_once __DIR__ . '/../../config/db.php';


                $doc = $_POST['id'];
                $sql = "SELECT * FROM cliente  
                    INNER JOIN plan
                    ON cliente.plan_idPlan=plan.idPlan
                    WHERE documentoCliente= '$doc';";


                if ($rta = $con->query($sql)) {
                    while ($row = $rta->fetch_assoc()) {
                        $id = $row['idCliente'];
                        $td = $row['tipoDocumento'];
                        $doc = $row['documentoCliente'];
                        $nombres = $row['nombreCliente'];
                        $telefono = $row['telefonoCliente'];
                        $email = $row['correoCliente'];
                        $dir = $row['direccion'];
                        $estado = $row['estadoCliente'];
                        $plan = $row['plan_idPlan'];
                        $creacion = $row['creado'];
                        $act = $row['ultimaActualizacion'];
                        $idplan = $row['idPlan'];
                        $codigoplan = $row['codigoPlan'];
                        $tipoplan = $row['tipoPlan'];
                        $velocidad = $row['velocidad'];
                        $nombreplan = $row['nombrePlan'];
                        $precioplan = $row['precioPlan'];
                        $desplan = $row['desPlan'];
                        $estadoplan = $row['estadoPlan'];
                ?>
                        <div class="main-panel">
                            <div class="content-wrapper">
                                <div class="page-header">
                                    <h2 class="page-title">Cliente</h2>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 grid-margin stretch-card">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="card-title">El cliente <?php echo "$nombres" ?>, identificado con <?php echo "$td: $doc" ?></h4>
                                                <form class="forms-sample">
                                                    <div class="form-group">
                                                        <div class="card-body">


                                                            <form class="forms-sample">
                                                                <div class="form-group">
                                                                    <label for="cp"> Telefono: <?php echo "$telefono" ?> </label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="cp">Email: <?php echo "$email" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="plan">Direccion: <?php echo "$dir" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="plan">Creado: <?php echo "$creacion" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="plan">Actualizado: <?php echo "$act" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="des">Tipo de plan: <?php echo "$tipoplan" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="des">Nombre Plan: <?php echo "$nombreplan"  ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="des">Velocidad: <?php echo "$velocidad" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="des">Precio: <?php echo "$precioplan" ?></label>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="des">Descripción: <?php echo "$desplan" ?></label>
                                                                </div>
                                                                <td>
                                                                    <a href="actualizar.php?id=<?php echo $row['documentoCliente'] ?>" class="btn btn-info btn-lg">Editar</a>
                                                                </td>
                                                                <a href="tablas.php" class="btn btn-light btn-lg active" role="button" aria-pressed="true">Volver</a>
                                                            </form>
                                                        </div>
                                                    </div>
                                            </div>

                                            <!-- content-wrapper ends -->
                                            <!-- partial:../../partials/_footer.html -->


                                        </div>
                                        <!-- partial -->
                                    </div>
                                    <!-- main-panel ends -->
                                </div>
                                <!-- page-body-wrapper ends -->
                            </div>
                    <?php
                    }
                }

                    ?>
                        </div>
            </div>
        </div>
</body>

</html>