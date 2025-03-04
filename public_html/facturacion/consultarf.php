<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
    header("location:index.html");
    die();
    exit;
}

?>

<!-- CODIGO HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ATORY - Admin</title>
    <!-- Estilos de los plugins -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../.assets/vendors/css/vendor.bundle.base.css">
    <!-- Fin de los estilos de los plugins -->
    <!-- Estilos del archivo actual -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Fin de los estilos del archivo actual -->
    <link rel="shortcut icon" href="../assets/images/favicon.png">
</head>

<body>
    <?php
    include '../menu/menuint.php';
    ?>
    <!-- Hasta aca es toda la barra lateral y la barra superior (lo que se deja igual en todas las paginas de admin) -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h1 style="font-size: 32px;">CONSULTAR FACTURAS</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item" aria-current="page">Consulte sus facturas</li>
                    </ol>
                </nav>
            </div>
            <div class="row">
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <!-- CONTENIDO -->
                        <h4 class="card-title">Facturas</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="id">Ingrese identificación de cliente</label>
                                <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese Número de Identificación">
                            </div>
                            <div>
                                <br>
                                <button id="submit" type="submit" formmethod="post" formaction="cfactura.php" class="btn btn-primary btn-lg">Consultar</button>
                                <button id="submit" type="submit" formmethod="post" formaction="facturas.php" class="btn btn-primary btn-lg">Ver todas las facturas</button>
                                <button id="submit" type="submit" formmethod="post" formaction="factcliente.php" class="btn btn-primary btn-lg">Ingresar nueva factura</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

    </div>

    </div>


    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>

</body>

</html>