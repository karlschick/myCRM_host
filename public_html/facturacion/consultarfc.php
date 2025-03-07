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
                                        <h1 class="card-title text-left mb-3" style="font-size: 32px;">¡Bienvenido al portal de consulta de facturas!</h1>
                                    </div>
                                </div>
                                <div class="row justify-content-center">
                                    <div class="col-20 grid-margin stretch-card">
                                        <div class="card">
                                            <!-- CONTENIDO -->
                                            <div class="card-body">
                                                <p style="font-size: 18px;">Por favor, ingrese su número de identificación para consultar su factura de pago.</p>

                                                <form class="forms-sample" action="cfacturaC.php" method="post">
                                                    <div class="form-group">
                                                        <label for="id">Número de Identificación:</label>
                                                        <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese su número de identificación" required>
                                                    </div>

                                                    <div class="row justify-content-center mt-4">
                                                        <div class="col-md-6 mb-3">
                                                            <div class="d-flex flex-column align-items-center border p-3">
                                                                <button id="submit" type="submit" class="btn btn-lg btn-primary w-70">Consultar</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 mb-3">
                                                            <div class="d-flex flex-column align-items-center border p-3">
                                                                <button type="button" class="btn btn-lg btn-secondary w-70" onclick="window.location.href='../index.php'">
                                                                    Volver al inicio
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
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