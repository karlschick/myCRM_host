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
    <?php include '../../includes/menutec.php'; ?>

    <!-- partial -->


    <div class="main-panel">

        <div class="content-wrapper">
            <div class="page-header">
                <h1 style="font-size: 32px;">Visitas tecnicas e Instalaciones</h1>
            </div>
            <div class="col-6 grid-margin ">
                <div class="card">
                    <!-- CONTENIDO -->
                    <div class="card-body">
                        <h4 class="card-title">CONSULTAR VISITAS ASIGNADAS</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="id">Ingrese su numero de identificación</label>
                                <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese Número de Identificación">
                            </div>
                            <div>
                                <br>
                                <button id="submit" type="submit" formmethod="post" formaction="tablasVisitasT.php" class="btn btn-info btn-lg">Consultar Visitas Activas</button>
                                <button id="submit" type="submit" formmethod="post" formaction="tablasAtendidasT.php" class="btn btn-danger btn-lg">Consultar Visitas Atendidas</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</body>

</html>