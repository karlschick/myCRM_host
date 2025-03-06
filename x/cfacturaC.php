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
    <div class="main-panel">
        <div class="content-wrapper">
            <h1 style="font-size: 32px;">CONSULTA TU FACTURA</h1>
            <div class="card">
                <div class="card-body">
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
                    <th> Fecha de Pago</th>
                    <th> Valor Total</th>
                    <th> Estado factura</th>
                    <th> Consultas</th>
                </tr>
                </thead>
                ';

                    if ($rta = $con->query($sql)) {
                        while ($row = $rta->fetch_assoc()) {
                            $a = $row['idCliente'];
                            $b = $row['cliente_idCliente'];
                            $dc = $row['documentoCliente'];
                            $nomc = $row['nombreCliente'];
                            $idf = $row['idFactura'];
                            $st = $row['valorTotalFactura'];
                            $estf = $row['estadoFactura'];
                            $ffact = $row['fechaVencimiento'];
                            $nplan = $row['nplan']


                    ?>
                            <tr>
                                <td> <?php echo "$dc" ?></td>
                                <td> <?php echo "$nomc" ?></td>
                                <td> <?php echo "$ffact" ?></td>
                                <td> <?php echo "$st" ?></td>
                                <td> <?php echo "$estf" ?></td>
                                <td> <?php echo "$nplan" ?></td>
                                <th>
                                    <a href="verfactura.php?id=<?php echo  $row['idFactura'] ?>" class="btn btn-info">ver factura</a>
                                </th>



                            </tr>
                    <?php
                        }
                    }
                    ?>
                </div>
                <a href="../index.html" class="btn btn-danger btn-lg ">Volver al inicio</a>
            </div>
        </div>
    </div>

</body>

</html>