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
        <link rel="stylesheet" href="../.assets/vendors/css/vendor.bundle.base.css">
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
        <!-- Hasta aca es toda la barra lateral y la barra superior (lo que se deja igual en todas las paginas de admin) -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h1 style="font-size: 32px;">CREAR FACTURAS </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Crear Facturas</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <!-- CONTENIDO -->
                                <h4 class="card-title">Facturas</h4>
                                <form class="forms-sample">
                                    <div class="form-group">
                                        <label for="id">Ingrese identificación de cliente</label>
                                        <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese Número de Identificación">
                                    </div>
                                    <div>
                                        <br>
                                        <button id="submit" type="submit" formmethod="post" formaction="crearfactura.php" class="btn btn-primary">Crear Factura</button>
                                        <button id="submit" type="submit" formmethod="post" formaction="facturas.php" class="btn btn-primary">Ver todas las facturas</button>

                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Extremos del contenedor de contenido -->
            <!-- FOOTER o pie de pagina-->
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Derechos de autor © atory.com 2023</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                        <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">atory.com</a>
                    </span>
                </div>
            </footer>

        </div>

        </div>

        </div>

        <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
        <script src="../assets/js/off-canvas.js"></script>
        <script src="../assets/js/hoverable-collapse.js"></script>
        <script src="../assets/js/misc.js"></script>
        <!-- Fin de los scripts -->
    </body>

    </html>