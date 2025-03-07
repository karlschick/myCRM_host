    <!-- actualizado -->

    <?php
    // Incluye el encabezado de la página
    include '../../includes/header.php';
    ?>

    <body>
        <div class="container-scroller">
            <div class="container-fluid page-body-wrapper full-page-wrapper">
                <div class="row w-100 m-0">
                    <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
                        <div class="card col-lg-10 mx-auto">
                            <div class="card-body px-2 py-3">
                                <div class="content-wrapper">
                                    <div class="page-header">
                                        <div class="mx-auto text-center" style="width: fit-content;">
                                        <img class="logo" src="../assets/images/empresa/logoEmpresa.png" alt="logo" style="max-width: 40%; height: auto" class="img-responsive" />
                                            <h1 class="card-title text-left mb-3" style="font-size: 32px;">CONSULTAS COMUNES</h1>
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                        <div class="col-20 grid-margin stretch-card">
                                            <div class="card">
                                                <!-- CONTENIDO -->
                                                <div class="card-body">
                                                    <p style="font-size: 18px;">Estimado cliente, Seleccione qué quiere consultar</p>
                                                    <div class="form-group">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col mb-3">
                                                            <div class="d-flex flex-column align-items-center border p-3">
                                                                <a href="../facturacion/consultarfC.php" class="btn btn-lg btn-info w-70">Consulta Factura</a>
                                                            </div>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <div class="d-flex flex-column align-items-center border p-3">
                                                                <a href="../consultas/consultavisitasCli.php" class="btn btn-lg btn-primary w-70">Consulta Visitas</a>
                                                            </div>
                                                        </div>
                                                        <div class="col mb-3">
                                                            <div class="d-flex flex-column align-items-center border p-3">
                                                                <a href="../index.php" class="btn btn-lg btn-danger w-70">Regresar al inicio</a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </body>

    </html>