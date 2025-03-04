<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
    header("location:index.html");
    die();
    exit;
}

/* 
include "login/claseSeguridad.php";

$seguridad = new Seguridad();
if ($seguridad->getUsuario()==null) {
    header ('location:index.html');
}
*/
?>

<!-- CODIGO HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ATORY - Admin</title>
    <!-- Estilos de los plugins -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- Fin de los estilos de los plugins -->
    <!-- Estilos del archivo actual -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Fin de los estilos del archivo actual -->
    <link rel="shortcut icon" href="../assets/images/favicon.png">
</head>

<body>
    <?php
    include '../menu/menuint.php';
    ?>
    <!-- HASTA ACA ESTA LA BARRA LATERAL Y LA BARRA PRINCIPAL -->


    <div class="main-panel">
        <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
            <div class="card">
                <div class="card-body">
                    <a href="facturas.php" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Volver a facturas</a>
                    <?php

                    include("conexion.php");
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
                    <th> Fecha Limite de pago</th>
                    <th> Valor Total</th>
                    <th> Estado factura</th>
                    <th> Plan</th>
                    <th> Consultas</th>
                    <th> Volver a pago</th>
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
                                    <a href="verfacturaAdmin.php?id=<?php echo  $row['idFactura'] ?>" class="btn btn-info">ver factura</a>
                                </th>
                                <th><a href="eliminarf.php?id=<?php echo $row['idFactura']   ?>" class="btn btn-danger">Pago</a></th>
                                <?php if ($estf == 'Pendiente'){ ?>
                                <th><a href="editfactura.php?if=<?php echo  $row['idFactura'] ?>" class="btn btn-primary">Editar factura</a>
                                </th>
                                <?php }?>


                            </tr>
                    <?php
                        }
                    }
                    ?>

                </div>
                <!-- ESTO ES LO QUE PODEMOS MODIFICAR -->

            </div>


        </div>



    </div>

    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>

    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>

    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>

    <script src="../assets/js/dashboard.js"></script>


    <div class="jvectormap-tip"></div>
</body>

</html>