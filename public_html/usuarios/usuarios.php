    <!-- actualizado -->

    <?php
// Seguridad de sesiones (prueba 1)
session_start();
error_reporting(0);

// Verifica si el usuario tiene una sesión activa
$varsesion = $_SESSION['usuario'];
if (empty($varsesion)) {
    header("Location: ../index.php");
    die(); // No es necesario usar exit después de die()
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

    </div>
    <!-- main-panel fin -->
    </div>
    <!-- page-body-wrapper fin -->
    </div>


</body>

</html>