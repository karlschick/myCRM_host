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

    <!-- Contenedor principal -->
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
                <div class="col- grid-margin stretch-card">
                    <div class="card">
                        <!-- Sección de contenido principal -->
                        <div class="card-body">
                            <h4 class="card-title">CONSULTAR CLIENTES</h4>
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="id">Ingrese identificación de cliente</label>
                                    <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese Número de Identificación">
                                </div>
                                <div>
                                    <br>
                                    <!-- Botones de acción -->
                                    <button id="submit" type="submit" formmethod="post" formaction="../clientes/consultar.php" class="btn btn-primary btn-lg">Consultar</button>
                                    <button id="submit" type="submit" formmethod="post" formaction="../clientes/tablas.php" class="btn btn-primary btn-lg">Ver tabla de clientes</button>
                                    <button id="submit" type="submit" formmethod="post" formaction="../clientes/ingresar.php" class="btn btn-primary btn-lg">Ingresar nuevo cliente</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- Fin de content-wrapper -->
    </div> <!-- Fin de main-panel -->


</body>
</html>
