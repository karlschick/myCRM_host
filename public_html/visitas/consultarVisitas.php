<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
    header("location:../index.html");
    die();
    exit;
}

// Incluye el encabezado de la página
include '../../includes/header.php';
?>

<body>
<?php include '../../includes/menu.php'; ?>
    <!-- Parcial -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h1 style="font-size: 32px;">Consultas Visitas</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page">Esta usted en el módulo de Visitas</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <!-- CONTENIDO -->
                        <h4 class="card-title">Consultas de Visitas</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="docCliente">Ingresar cedula de cliente</label>
                                <input type="text" class="form-control" name="docCliente" id="docCliente" placeholder="Ingrese celuda cliente">
                            </div>
                            <div>
                                <br>
                                <button id="submit" type="submit" formmethod="post" formaction="../visitas/tablaConsultada.php" class="btn btn-primary">Consultar Visitas de Cliente</button>
                                <!--<button id="submit" type="submit" formmethod="post" formaction="../principal.html" class="btn btn-primary">Volver al inicio</button> -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Extremos del contenedor de contenido -->

        <!-- Parcial -->
    </div>
    <!-- main-panel fin -->
    </div>
    <!-- page-body-wrapper fin -->
    </div>
    <!-- container-scroller -->
    <!-- Scripts -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <!-- Fin de los scripts -->
</body>

</html>