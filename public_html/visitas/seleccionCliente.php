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
            <h1 style="font-size: 32px;">Seleccionar cliente para visita</h1>
            <div class="card-body">
                
                <?php
                require_once __DIR__ . '/../../config/db.php';

                $id=$_POST["id"];
                      $sql= "SELECT * FROM cliente
                      INNER JOIN plan
                      WHERE plan.`idPlan`=cliente.`plan_idPlan`
                      AND documentoCliente='$id';";

                echo '<div class="table-responsive">
                <table class="table table-hover">
                <thead>
            <tr>
            <th> Tipo de documento</th>
            <th> Documento Cliente</th>
            <th> Nombre Cliente</th>
            <th> Direccion cliente</th>
            <th> Tipo Plan</th>
            <th> Nombre Plan</th>
        </tr>
        </thead>
        ';

        if ($rta = $con->query($sql)) {
            while ($row = $rta->fetch_assoc()) {
                $idc=$row['idCliente'];
                $tdc=$row['tipoDocumento'];                  
                $docCliente = $row['documentoCliente'];
                $nomCliente = $row['nombreCliente'];
                $telCliente = $row['telefonoCliente'];
                $emailCliente = $row['correoCliente'];
                $dirCliente = $row['direccion'];
                $estado_cliente=$row['estadoCliente'];
                $plan_idPlan=$row['plan_idPlan'];
                $crearcliente=$row['creado'];
                $uacliente=$row['ultimaActualizacion'];
                $tipoplan=$row['tipoPlan'];
                $nombreplan=$row['nombrePlan'];


                ?>
                        <tr>
                                <td> <?php echo "$tdc" ?></td>
                                <td> <?php echo "$docCliente" ?></td>
                                <td> <?php echo "$nomCliente" ?></td>
                                <td> <?php echo "$dirCliente" ?></td>
                                <td> <?php echo "$tipoplan" ?></td>
                                <td> <?php echo "$nombreplan" ?></td>
                            
                            <th><a href="crearvisita.php?id=<?php echo $row['idCliente'] ?>" class="btn btn-info">Crear Visita</a>
                        </tr>
                <?php
                    }
                }

                ?>


            </div>


        </div>
        <!-- page-body-wrapper ends -->


    </div>


    <div class="jvectormap-tip"></div>
</body>

</html>