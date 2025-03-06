<?php
// Incluye el encabezado de la página
include '../../includes/header.php';
?>

<body>
    <!-- Incluye el menú de navegación -->

    <div class="main-panel">
        <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
            <div class="card">
                <div class="card-body">
                    <a href="consultarfC.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Volver a facturas</a>
                    <?php

                    require_once __DIR__ . '/../../config/db.php';
                    $dc = $_POST['id'];

                    // Modificación: Se excluyen las facturas archivadas
                    $sql = "SELECT cliente.idCliente, factura.cliente_idCliente, cliente.documentoCliente, cliente.nombreCliente, 
                                   factura.idFactura, factura.valorTotalFactura, factura.estadoFactura, factura.fechaVencimiento, factura.nplan 
                            FROM cliente 
                            INNER JOIN factura ON cliente.idCliente = factura.cliente_idCliente
                            WHERE cliente.documentoCliente = '$dc' AND factura.estadoFactura != 'Archivada';";

                    $rta = $con->query($sql);

                    // Verificar si hay facturas activas
                    if ($rta->num_rows > 0) {
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
                                    
                                </tr>
                                </thead>
                        ';

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
                                    <a href="verfacturaClie.php?id=<?php echo  $row['idFactura'] ?>" class="btn btn-info">Ver Factura</a>
                                </th>
                                <th><a href="pago.php?id=<?php echo $row['idFactura'] ?>" class="btn btn-success">Pagar</a></th>

                                <?php if ($estf == 'Pendiente') { ?>
                                <!-- <th><a href="editfactura.php?if=<?php echo  $row['idFactura'] ?>" class="btn btn-primary">Editar Factura</a> -->
                                </th>
                                <?php } ?>
                            </tr>
                    <?php
                        }
                        echo '</table></div>'; // Cerrar tabla solo si hay facturas activas
                    } else {
                        // Si no hay facturas activas, mostrar el mensaje
                        echo "<div class='text-center' style='margin-top: 20px;'>
                                <h3>✅ Usted está al día, estimado cliente.</h3>
                                <p>No hay facturas pendientes de pago.</p>
                              </div>";
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
