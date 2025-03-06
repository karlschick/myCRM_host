<?php
// Seguridad de sesiones (prueba 1)
session_start();
error_reporting(0);

// Verifica si el usuario tiene una sesión activa
$varsesion = $_SESSION['usuario'];
if (empty($varsesion)) {
    header("Location: ../index.php");
    die();
}

// Incluye el encabezado de la página
include '../../includes/header.php';
?>

<body>
    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
            <div class="card">
                <div class="card-body">
                    <a href="facturas.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Volver a facturas</a>
                    <?php

                    require_once __DIR__ . '/../../config/db.php';
                    $dc = $_POST['id'];
                    $sql = "SELECT cliente.idCliente,factura.cliente_idCliente,cliente.documentoCliente,cliente.nombreCliente,factura.idFactura,factura.valorTotalFactura,factura.estadoFactura,factura.fechaVencimiento,factura.nplan FROM cliente 
                    INNER JOIN factura
                    ON cliente.idCliente=factura.cliente_idCliente
                    WHERE documentoCliente='$dc';";

                    echo '<div class="table-responsive">
                        <table class="table table-hover">
                        <thead>
                    <tr>
                    <th> Documento Cliente </th>
                    <th> Nombre Cliente</th>
                    <th> Fecha Límite de Pago</th>
                    <th> Valor Total</th>
                    <th> Estado Factura</th>
                    <th> Plan</th>
                    <th> Consultas</th>
                    <th> Volver a Pago</th>
                    <th> Editar</th>
                </tr>
                </thead>
                ';

                    if ($rta = $con->query($sql)) {
                        while ($row = $rta->fetch_assoc()) {
                            $a = $row['idCliente'];
                            $b = $row['cliente_idCliente'];
                            $dc = $row['documentoCliente'];
                            $nomc = $row['nombreCliente'];
                            $if = $row['idFactura'];
                            $st = $row['valorTotalFactura'];
                            $estf = $row['estadoFactura'];
                            $ffact = $row['fechaVencimiento'];
                            $nplan = $row['nplan'];
                    ?>
                            <tr>
                                <td> <?php echo "$dc" ?></td>
                                <td> <?php echo "$nomc" ?></td>
                                <td> <?php echo "$ffact" ?></td>
                                <td> <?php echo "$st" ?></td>
                                <td> <?php echo "$estf" ?></td>
                                <td> <?php echo "$nplan" ?></td>

                                <th>
                                    <a href="verfacturaAdmin.php?id=<?php echo  $row['idFactura'] ?>" class="btn btn-info">Ver Factura</a>
                                </th>
                                <th><a href="eliminarf.php?id=<?php echo $row['idFactura'] ?>" class="btn btn-danger">Pago</a></th>
                                
                                <!-- El botón "Editar Factura" ahora siempre estará activo -->
                                <th><a href="editfactura.php?if=<?php echo  $row['idFactura'] ?>" class="btn btn-primary">Editar Factura</a></th>

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
