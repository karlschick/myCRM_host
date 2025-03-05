    <!-- actualizado -->

    <?php
// Seguridad de sesiones (prueba 1)


// Incluye el encabezado de la página
include '../../includes/header.php';
?>
<body>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h1 style="font-size: 32px;">CONSULTAS</h1>
                <nav aria-label="breadcrumb"></nav>
            </div>
            <div class="row justify-content-center">
                <div class="col-6 grid-margin stretch-card">
                    <div class="card">
                        <!-- CONTENIDO -->
                        <div class="card-body">
                            <h4 class="card-title">Seleccione qué quiere consultar</h4>
                            <div class="form-group">
                                <label for="id">Elija</label>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <a href="../facturacion/consultarfc.php" class="btn btn-lg btn-info">Consultar Factura</a>
                                </div>
                                <div class="col mb-3">
                                    <a href="consultavisitas.php" class="btn btn-lg btn-primary">Consultar Visitas</a>
                                </div>
                                <div class="col mb-3">
                                    <a href="consultapqrs.php" class="btn btn-lg btn-primary">Consultar contacto a la empresa</a>
                                </div>
                                <div class="col">
                                    <a href="../index.html" class="btn btn-lg btn-danger">Volver al inicio</a>
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