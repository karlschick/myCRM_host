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


    <?php
    include 'menu/menu.php';
    require_once __DIR__ . '/../../config/db.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM cliente 
    INNER JOIN plan
    ON cliente.plan_idPlan=plan.idPlan
    WHERE documentoCliente=$id;";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);
    ?>
    <div class="main-panel">
        <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">GESTION DE CLIENTES</h4>
                        <p class="card-description"> Ingrese los datos del cliente</p>
                        <form action="update.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['documentoCliente']  ?>">
                            <p class="card-description"> Tipo de documento: </p>
                            <select class="form-select" aria-label="Default select example" name="td" id="td" value="<?php echo $row['tipoDocumento']  ?>">
                                <option value="C.C">C.C</option>
                                <option value="C.E">C.E</option>
                                <option value="R.C">R.C</option>
                                <option value="T.I">T.I</option>
                            </select>
                            <p></p>
                            <p class="card-description"> Documento cliente:</p>
                            <input type="text" class="form-control mb-3" name="id" placeholder="Numero documento" value="<?php echo $row['documentoCliente']  ?>">
                            <p class="card-description"> Nombre cliente:</p>
                            <input type="text" class="form-control mb-3" name="nombre" placeholder="Nombres Completos" value="<?php echo $row['nombreCliente']  ?>">
                            <p class="card-description"> Telefono cliente:</p>
                            <input type="text" class="form-control mb-3" name="tel" placeholder="Ingrese telefono" value="<?php echo $row['telefonoCliente']  ?>">
                            <p class="card-description"> Correo cliente:</p>
                            <input type="text" class="form-control mb-3" name="email" placeholder="Ingrese correo electronico" value="<?php echo $row['correoCliente']  ?>">
                            <p class="card-description"> Direccion cliente:</p>
                            <input type="text" class="form-control mb-3" name="dir" placeholder="direccion" value="<?php echo $row['direccion']  ?>">

                            <p class="card-description"> Estado cliente:</p>
                            <select class="form-select" aria-label="Default select example" name="estado" id="estado" value="<?php echo $row['estadoCliente']  ?>">
                                <option value="Activo">Activo </option>
                                <option value="Archivado">Inactivo</option>
                                <p></p>
                            </select>
                            <p class="card-description"> Fecha creacion:</p>
                            <input type="date" class="form-control mb-3" name="creacion" placeholder="fecha de creacion" value="<?php echo $row['creado']  ?>">
                            <p class="card-description"> Fecha Ultima actualizacion:</p>
                            <input type="date" class="form-control mb-3" name="act" placeholder="ultima actualizacion" value="<?php echo $row['ultimaActualizacion']  ?>">
                            <div class="form-group">
                                <label for="estado">Seleccione el plan</label>
                                <select class="form-control" name="plan" id="plan">
                                    <?php
                                    $sql = "SELECT * FROM plan WHERE estadoPlan='activo';";
                                    $query = mysqli_query($con, $sql);
                                    $row = mysqli_fetch_array($query);
                                    if ($rta = $con->query($sql)) {
                                        while ($row = $rta->fetch_assoc()) {
                                            $cp = $row['codigoPlan'];
                                            $nplan = $row['nombrePlan'];

                                    ?>
                                            <option value="<?php echo $cp ?>"><?php echo "$nplan" ?> </option>

                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type="submit" class="btn btn-primary btn-lg" value="Actualizar" formmethod="post" formaction=update.php>
                            <input type="submit" class="btn btn-primary btn-lg" value="Volver" formmethod="post" formaction=tablas.php>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>