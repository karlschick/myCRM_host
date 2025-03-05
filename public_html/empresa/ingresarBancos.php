<?php
// Seguridad de sesiones
session_start();
error_reporting(0);

$varsesion = $_SESSION['usuario'];
if (empty($varsesion)) {
    header("Location: ../index.php");
    die();
}

// Incluye el encabezado de la página
include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';
?>
<body>

<!-- Incluye el menú de navegación -->
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">INGRESO DE CUENTAS BANCARIAS</h4>
                    <p class="card-description">Ingrese información del banco</p>

                    <!-- Formulario para agregar nuevos bancos -->
                    <form method="POST" action="insertarBanco.php">
                        <div class="form-group">
                            <label for="num_cuenta">Número de cuenta</label>
                            <input type="text" class="form-control" name="num_cuenta" id="num_cuenta" placeholder="Ingrese número de cuenta" required>
                        </div>

                        <div class="form-group">
                            <label for="nomb_banco">Nombre del banco</label>
                            <input type="text" class="form-control" name="nomb_banco" id="nomb_banco" placeholder="Ingrese nombre del banco" required>
                        </div>

                        <p class="card-description">Estado de la cuenta bancaria:</p>
                        <select class="form-select" name="estadoCuenta" id="estadoCuenta">
                            <option value="Activo">Activo</option>
                            <option value="Archivado">Inactivo</option>
                        </select>

                        <br>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </form>

                    <hr>

                    <!-- Lista de bancos existentes con opción para cambiar estado -->
                    <h4 class="card-title">Lista de Cuentas Bancarias</h4>
                    <form method="POST" action="actualizarEstadoBanco.php">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Número de Cuenta</th>
                                    <th>Banco</th>
                                    <th>Estado</th>
                                    <th>Acción</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM bancario";
                                $query = mysqli_query($con, $sql);
                                if ($query && mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_assoc($query)) {
                                        echo "<tr>";
                                        echo "<td>" . $row['id_bancario'] . "</td>";
                                        echo "<td>" . htmlspecialchars($row['num_cuenta']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['nomb_banco']) . "</td>";
                                        echo "<td>";
                                        echo "<select class='form-select' name='estadoCuenta[" . $row['id_bancario'] . "]'>";
                                        echo "<option value='Activo' " . ($row['estadoCuenta'] == 'Activo' ? 'selected' : '') . ">Activo</option>";
                                        echo "<option value='Archivado' " . ($row['estadoCuenta'] == 'Archivado' ? 'selected' : '') . ">Archivado</option>";
                                        echo "</select>";
                                        echo "</td>";
                                        echo "<td><button type='submit' class='btn btn-success' name='actualizar' value='" . $row['id_bancario'] . "'>Actualizar</button></td>";

                                        // Botón para eliminar el banco
                                        echo "<td>
                                                <form method='POST' action='eliminarBanco.php' onsubmit='return confirm(\"¿Estás seguro de que deseas eliminar este banco?\");'>
                                                    <input type='hidden' name='id_bancario' value='" . $row['id_bancario'] . "'>
                                                    <button type='submit' class='btn btn-danger'>Eliminar</button>
                                                </form>
                                              </td>";

                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>No hay bancos registrados.</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </form>

                    <br>
                    <a href="actualizarEmpresa.php" class="btn btn-primary">Volver al inicio</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
