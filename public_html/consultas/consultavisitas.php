    <!-- actualizado -->

    <?php

include '../../includes/header.php';
?>
<body>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h1 style="font-size: 32px;">CONSULTAR VISITAS</h1>
                <nav aria-label="breadcrumb">
                </nav>
            </div>
            <div class="row">
                <div class="col-6 grid-margin stretch-card">
                    <div class="card">
                        <!-- CONTENIDO -->
                        <div class="card-body">
                            <h4 class="card-title">Visitas</h4>
                            <form class="forms-sample" action="visitas.php" method="post">
                                <div class="form-group">
                                    <label for="id">Ingrese su numero de identificacion</label>
                                    <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese Número de Identificación" required>
                                </div>
                                <div>
                                    <br>
                                    <button id="submit" type="submit" class="btn btn-primary btn-lg">Consultar</button>
                                    <input type="submit" value="Volver al inicio" class="btn btn-primary btn-lg" formaction="../index.html" />
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