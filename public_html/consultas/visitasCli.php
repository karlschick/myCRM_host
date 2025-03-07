    <!-- actualizado -->

    <?php

// Incluye el encabezado de la página
include '../../includes/header.php';
?>
<body>
    <div class="main-panel">

        <div class="content-wrapper">
            <h1 style="font-size: 32px;">Visitas tecnicas e Instalaciones</h1>
            <div class="card">
                <div class="card-body">
                    <a href="../index.php" class="btn btn-danger">Volver al inicio</a>
                    <?php
                    require_once __DIR__ . '/../../config/db.php';

                    $id = $_POST["id"];
                    $sql = "select * from usuario
                      inner join user_visita
                      inner join visitas
                      Inner join cliente
                      where usuario.`idUsuario`=user_visita.`user_idUser`
                      and user_visita.`visita_idVisita`=visitas.`idVisita`
                      and  cliente.`idCliente`=visitas.`visita_idCliente`
                      and documentoCliente=$id;";

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

                                <th><a href="visitascliente.php?id=<?php echo $row['idVisita'] ?>" class="btn btn-info">Mas detalles</a>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</body>

</html>