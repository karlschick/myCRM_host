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
    <div class="main-panel">
        <div class="content-wrapper">
            <h1 style="font-size: 32px;">CONSULTA TU FACTURA</h1>
            <div class="card">
                <div class="card-body">

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

    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->

    <div class="jvectormap-tip"></div>
</body>

</html>