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

            <div class="row">
                <div class="col-6 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <!-- CONTENIDO -->
                            <h4 class="card-title">Consultas de Planes</h4>
                            <form class="forms-sample">
                                <div class="form-group">
                                    <label for="cp">Ingrese codigo de plan</label>
                                    <input type="text" class="form-control" name="cp" id="cp" placeholder="Ingrese Código del plan">
                                </div>
                                <div>
                                    <br>
                                    <button id="submit" type="submit" formmethod="post" formaction="../planes/plan.php" class="btn btn-primary btn-lg">Consultar Plan</button>
                                    <!--<button id="submit" type="submit" formmethod="post" formaction="../principal.html" class="btn btn-primary">Volver al inicio</button> -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    </div>
    </div>

</body>

</html>