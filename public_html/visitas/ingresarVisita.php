    <!-- actualizado -->

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
    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>

               <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h1 style="font-size: 32px;">CREAR VISITAS </h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item" aria-current="page">Ingresar nueva visita</li>
                        </ol>
                    </nav>
                </div>
                <div class="row">
                    <div class="col-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <!-- CONTENIDO -->
                                <h4 class="card-title">Ingresar visita</h4>
                                <form class="forms-sample">
                                    <div class="form-group">
                                        <label for="id">Ingrese identificación de cliente</label>
                                        <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese Número de Identificación">
                                    </div>
                                    <div>
                                        <br>
                                        <button id="submit" type="submit" formmethod="post" formaction="seleccionCliente.php" class="btn btn-primary">Buscar cliente</button>
                                        <button id="submit" type="submit" formmethod="post" formaction="tablasVisitas.php" class="btn btn-primary">Volver a las visitas</button>

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
            <!-- Parcial -->
        </div>
        <!-- main-panel fin -->
        </div>
        <!-- page-body-wrapper fin -->
        </div>

    </body>

    </html>