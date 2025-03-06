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
        <div class="card-body px-5 py-5">
        <div class="content-wrapper">
            <div class="page-header">
            <div class="mx-auto text-center" style="width: fit-content;">
        <h1 class="card-title text-left mb-3" style="font-size: 32px;">CONSULTAS COMUNES</h1>
    </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-10 grid-margin stretch-card">
                    <div class="card">
                        <!-- CONTENIDO -->
                        <div class="card-body">
                            <h4 class="card-title">Estimado cliente, Seleccione qué quiere consultar</h4>
                            <div class="form-group">
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <a href="../facturacion/consultarfC.php" class="btn btn-lg btn-info">Consultar Factura</a>
                                </div>
                                <div class="col mb-3">
                                    <a href="../consultas/consultavisitasCli.php" class="btn btn-lg btn-primary">Consultar Visitas</a>
                                </div>
                                <!-- <div class="col mb-3">
                                    <a href="../pqr/consultarpqr.php" class="btn btn-lg btn-primary">Consultar contacto a la empresa</a>
                                </div>
                                <div class="col"> -->
                                <div class="col mb-3">    
                                <a href="../index.php" class="btn btn-lg btn-danger">Volver al inicio</a>
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