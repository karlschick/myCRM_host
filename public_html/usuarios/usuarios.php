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
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
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
                <h1 style="font-size: 32px;">GESTIÓN USUARIOS</h1>

            </div>
            <div class="row">
                <div class="col- grid-margin stretch-card">

                    <!-- CONTENIDO -->
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">BASE DE DATOS DE USUARIOS</h4>
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="id">Ingrese identificación del usuario</label>
                                    <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese Número de Identificación">
                                </div>
                                <div>
                                    <br>
                                    <button id="submit" type="submit" formmethod="post" formaction="consultarUser.php" class="btn btn-primary">Consultar usuarios</button>
                                    <button id="submit" type="submit" formmethod="post" formaction="tablasUser.php" class="btn btn-primary">Ver tabla de usuarios</button>
                                    <button id="submit" type="submit" formmethod="post" formaction="ingresarUser.php" class="btn btn-primary">Ingresar nuevo usuario</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FOOTER o pie de pagina-->
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