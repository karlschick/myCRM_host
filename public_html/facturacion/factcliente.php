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
        <!-- Hasta aca es toda la barra lateral y la barra superior (lo que se deja igual en todas las paginas de admin) -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="page-header">
                    <h1 style="font-size: 32px;">CREAR FACTURAS </h1>

                </div>
                <div class="row">
                    <div class="col-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <!-- CONTENIDO -->
                                <h4 class="card-title">Facturas</h4>
                                <form class="forms-sample">
                                    <div class="form-group">
                                        <label for="id">Ingrese identificación de cliente</label>
                                        <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese Número de Identificación">
                                    </div>
                                    <div>
                                        <br>
                                        <button id="submit" type="submit" formmethod="post" formaction="crearfactura.php" class="btn btn-primary">Crear Factura</button>
                                        <button id="submit" type="submit" formmethod="post" formaction="facturas.php" class="btn btn-primary">Ver todas las facturas</button>

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