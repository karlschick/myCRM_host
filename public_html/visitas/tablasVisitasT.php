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
    <?php include '../../includes/menutec.php'; ?>

    <!-- Contenedor principal -->
    <div class="main-panel">

        <div class="content-wrapper">
            <div class="page-header">
                <h1 style="font-size: 32px;">Visitas tecnicas e Instalaciones</h1>
            </div>
            <div class="card">
                <div class="card-body">

                    <?php
                    require_once __DIR__ . '/../../config/db.php';

                    $sql = "SELECT * from usuario
                    INNER JOIN user_visita
                    INNER JOIN visitas
                    INNER JOIN cliente
                    WHERE usuario.idUsuario=user_visita.user_idUser
                    AND user_visita.visita_idVisita=visitas.idVisita
                    AND  cliente.idCliente=visitas.visita_idCliente
                    AND estadoVisita='Activo'
                    ORDER BY visitas.idVisita ASC;";

                    echo '<div class="table-responsive">
                <table class="table table-hover">
                <thead>
            <tr>
            <th> Visita No.</th>
            <th> Nombre Cliente</th>
            <th> Telefono Cliente</th>
            <th> Nombre técnico</th>
            <th> Tipo de visita</th>
            <th> Dia de la visita </th>
        </tr>
        </thead>
        ';

                    if ($rta = $con->query($sql)) {
                        while ($row = $rta->fetch_assoc()) {
                            $idu = $row['idUsuario'];
                            $tdu = $row['tipoDocumento'];
                            $docu = $row['documentoUsuario'];
                            $nombresu = $row['nombresUsuario'];
                            $telu = $row['telefonoUsuario'];
                            $emailu = $row['correoUsuario'];
                            $estadou = $row['estadoUsuario'];
                            $creadou = $row['creado'];
                            $upu = $row['ultimaActualizacion'];
                            $rolu = $row['rol'];
                            $uservisita = $row['iduser_visita'];
                            $visita_idvisita = $row['visita_idVisita'];
                            $user_idUser = $row['user_idUser'];
                            $idv = $row['idVisita'];
                            $tipov = $row['tipoVisita'];
                            $motivo = $row['motivoVisita'];
                            $diaVisita = $row['diaVisita'];
                            $eVisita = $row['estadoVisita'];
                            $visitacliente = $row['visita_idCliente'];
                            $idc = $row['idCliente'];
                            $tdc = $row['tipoDocumento'];
                            $docCliente = $row['documentoCliente'];
                            $nomCliente = $row['nombreCliente'];
                            $telCliente = $row['telefonoCliente'];
                            $emailCliente = $row['correoCliente'];
                            $dirCliente = $row['direccion'];
                            $estado_cliente = $row['estadoCliente'];
                            $plan_idPlan = $row['plan_idPlan'];
                            $crearcliente = $row['creado'];
                            $uacliente = $row['ultimaActualizacion'];
                    ?>
                            <tr>
                                <td> <?php echo "$idv" ?></td>
                                <td> <?php echo "$nomCliente" ?></td>
                                <td> <?php echo "$telCliente" ?></td>
                                <td> <?php echo "$nombresu" ?></td>
                                <td> <?php echo "$tipov" ?></td>
                                <td> <?php echo "$diaVisita" ?></td>


                                <th><a href="consultaT.php?id=<?php echo $row['idVisita'] ?>" class="btn btn-primary">Ver informacion de la visita</a></th>


                        <th><a href="eliminarVisitaDesT.php?id=<?php echo $row['idVisita'] ?>" class="borrar btn btn-danger">Marcar como Atendida</a></th>
                        </th>
                        </tr>
                    <?php
                        }
                    }

                    ?>


                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->


    </div>

   
</body>

</html>