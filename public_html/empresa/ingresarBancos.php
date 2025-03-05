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
        <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">INGRESO DE CUENTAS BANCARIAS</h4>
                        <p class="card-description"> Ingrese información del banco</p>
                        <form class="forms-sample" method="POST" action="insertarBanco.php">
                            <div class="form-group">
                                <label for="num_cuenta">Numero de cuenta</label>
                                <input type="text" class="form-control" name="num_cuenta" id="num_cuenta" placeholder="ingrese numero de cuenta" >
                            </div>

                            <div class="form-group">
                                <label for="nomb_banco">Nombre del banco</label>
                                <input type="text" class="form-control" name="nomb_banco" id="nomb_banco" placeholder="ingrese nombre del banco" >
                            </div>

                            <p class="card-description"> Estado cuenta bancaria:</p>
                            <select class="form-select" aria-label="Default select example" name="estadoCuenta" id="estadoCuenta" >
                                <option value="Activo">Activo </option>
                                <option value="Archivado">Inactivo</option>
                                <p></p>
                            </select>

                            <div>
                                <br>
                                <button id="submit" type="submit" formmethod="post" formaction="insertarBanco.php" class="btn btn-primary">Guardar</button>
                                <button id="submit" type="submit" formmethod="post" formaction="actualizarEmpresa.php" class="btn btn-primary"> Volver al inicio </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>