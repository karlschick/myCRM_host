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

<?php
require_once __DIR__ . '/../../config/db.php';

// Consulta de datos de la empresa
$sql = "SELECT * FROM empresa WHERE id = 1 LIMIT 1;";
$query = mysqli_query($con, $sql);
$empresa = mysqli_fetch_assoc($query);
?>



<div class="main-panel">
    <div class="content-wrapper">
        <div class="col-md-10 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">ACTUALIZAR EMPRESA</h2>
                    <p class="card-description">Ingrese los siguientes datos:</p>

                    <form class="forms-sample">
                        <?php
                        $campos = [
                            "rz" => "Razón Social de la Empresa",
                            "nombEmpresa" => "Nombre de la Empresa",
                            "nit" => "NIT de la Empresa",
                            "crc" => "Registro CRC",
                            "nombrepleg" => "Nombre del Representante Legal",
                            "docurepleg" => "Documento del Representante Legal",
                            "dirsede" => "Dirección Sede",
                            "telsede" => "Teléfono",
                            "telsede2" => "Teléfono 2",
                            "email" => "Correo Electrónico",
                            "paginaWeb" => "Página Web",
                            "fechaConstitucion" => "Fecha de Constitución"
                        ];

                        foreach ($campos as $campo => $label) {
                            $type = ($campo === "email") ? "email" : (($campo === "fechaConstitucion") ? "date" : "text");
                            echo "<div class='form-group'>
                                    <label for='$campo'>$label</label>
                                    <input type='$type' class='form-control' name='$campo' id='$campo' placeholder='$label' value='" . htmlspecialchars($empresa[$campo]) . "'>
                                  </div>";
                        }
                        ?>

                        <!-- Información Bancaria -->
                        <h3 class="mt-4">Información Bancaria</h3>

                        <?php
                        $sql = "SELECT num_cuenta, nomb_banco, estadoCuenta FROM bancario WHERE estadoCuenta = 'Activo';";
                        $query = mysqli_query($con, $sql);

                        while ($banco = mysqli_fetch_assoc($query)) :
                        ?>
                            <div class="form-group p-3 border rounded mb-3">
                                <p><strong>Nombre del banco:  </strong> <?php echo htmlspecialchars($banco['nomb_banco']); ?></p>
                                <p><strong>Número de cuenta:  </strong> <?php echo htmlspecialchars($banco['num_cuenta']); ?></p>
                                <p><strong>Estado de cuenta:  </strong> <?php echo htmlspecialchars($banco['estadoCuenta']); ?></p>
                            </div>
                        <?php endwhile; ?>


                        <!-- Botones -->
                        <div class="mt-3">
                            <button type="submit" formmethod="post" formaction="indatos.php" class="btn btn-primary">Guardar</button>
                            <button type="submit" formmethod="post" formaction="../empresa/verempresa.php" class="btn btn-secondary">Volver al inicio</button>
                            <button type="submit" formmethod="post" formaction="ingresarBancos.php" class="btn btn-info">Ingresar a Bancos</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>

</html>