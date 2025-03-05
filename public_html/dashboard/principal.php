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

        </div> 
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Derechos de autor © atory.com 2025</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                        <a href="derAutor.php" target="_blank">atory.com</a>
                    </span>
                </div>
            </footer>
    </div> <!-- Fin de main-panel -->


</body>
</html>
