    <!-- actualizado -->

    <?php
// Incluye el encabezado de la página
include '../../includes/header.php';
?>

<body>
    <div class="main-panel">
        <div class="content-wrapper">
        <div class="page-header">
    <div class="mx-auto text-center" style="width: fit-content;">
        <h1 style="font-size: 32px;">¡Bienvenido al portal de consulta de facturas!</h1>
    </div>
</div>
            <div class="row justify-content-center">
                <div class="col-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                        <p style="font-size: 18px;">Por favor, ingrese su número de identificación para consultar su factura de pago.</p>
                            <form class="forms-sample" action="cfacturaC.php" method="post">
                                <div class="form-group">
                                    <label for="id">Número de Identificación:</label>
                                    <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese su número de identificación" required>
                                </div>
                                <div class="text-center mt-4">
                                    <button id="submit" type="submit" class="btn btn-primary btn-lg">Consultar</button>
                                    <button type="button" class="btn btn-secondary btn-lg" onclick="window.location.href='../index.php'">
    Volver al inicio
</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
