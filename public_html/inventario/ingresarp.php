<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
    header("../location:index.html");
    die();
    exit;
}

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
    <!-- partial -->


    <div class="main-panel">
        <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->

            <h1 style="font-size: 32px;">GESTIÓN INVENTARIO</h1>
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <p class="card-description"> Ingrese los datos del nuevo producto </p>
                        <form class="forms-sample">

                            <div class="form-group">
                                <label for="nombrep">Ingrese nombre del producto</label>
                                <input type="text" class="form-control" name="nombrep" id="nombrep" placeholder="Nombre del Producto">
                            </div>

                            <!--valor de nombres y apellidos-->
                            <div class="form-group">
                                <label for="serial">Serial Del producto</label>
                                <input type="text" class="form-control" name="serial" id="serial" placeholder="Ingrese serial del producto">
                            </div>


                            <!--valor de numero de telefono-->
                            <div class="form-group">
                                <label for="desp">Descripción del producto</label>
                                <input type="text" class="form-control" name="desp" id="desp" placeholder="Ingrese descripción del producto">
                            </div>

                            <!--valor de email-->
                            <div class="form-group">
                                <label for="cantidad">Cantidad ue se tiene</label>
                                <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad que se tiene">
                            </div>

                            <div>
                                <br>
                                <button id="submit" type="submit" formmethod="post" formaction="inp.php" class="btn btn-primary">Guardar</button>
                                <button id="submit" type="submit" formmethod="post" formaction="tablasinventario.php" class="btn btn-primary"> Volver al inicio </button>

                            </div>
                        </form>


                    </div>
                </div>






            </div>
            <!-- ESTO ES LO QUE PODEMOS MODIFICAR -->
            <!-- partial:partials/_footer.html -->

            <!-- partial -->
        </div>
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Atory Solution 2023</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> <a href=" " target="_blank"></a> </span>
            </div>
        </footer>

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