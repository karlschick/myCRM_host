    <!-- actualizado -->

    <?php

include '../../includes/header.php';
?>
<body>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
            <div class="mx-auto text-center" style="width: fit-content;">
                <h1 style="font-size: 32px;">CONSULTAR VISITAS</h1>
    </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-6 grid-margin stretch-card">
                    <div class="card">
                        <!-- CONTENIDO -->
                        <div class="card-body">
                            <h4 class="card-title">Estimado cliente, Seleccione si quiere consultar para cuando esta agendada su visita</h4>
                            <form class="forms-sample" action="visitasCli.php" method="post">
                                <div class="form-group">
                                    <label for="id">Ingrese su numero de identificacion</label>
                                    <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese Número de Identificación" required>
                                </div>
                                <div>
                                    <br>
                                    <button id="submit" type="submit" class="btn btn-primary btn-lg">Consultar</button>
                                    <button type="button" class="btn btn-secondary btn-lg" onclick="window.location.href='../index.php'">Volver al inicio</button>
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