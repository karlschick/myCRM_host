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

</body>

</html>