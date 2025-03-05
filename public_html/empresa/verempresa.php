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
  <!-- partial -->
  <?php
  require_once __DIR__ . '/../../config/db.php';

    $sql = "SELECT * FROM empresa WHERE id='1';";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    ?>
    <!-- partial -->


    <div class="main-panel">
        <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                <div class="card-body">
    <h4 class="card-title">VER INFORMACIÓN DE LA EMPRESA</h4>
    <form class="forms-sample">
        <?php
        $labels = [
            "rz" => "Razón Social",
            "nombEmpresa" => "Nombre de la Empresa",
            "nit" => "NIT",
            "crc" => "Registro CRC",
            "nombrepleg" => "Representante Legal",
            "docurepleg" => "Documento del Representante",
            "dirsede" => "Dirección de la Sede",
            "telsede" => "Teléfono",
            "telsede2" => "Teléfono 2",
            "email" => "Email",
            "paginaWeb" => "Página Web",
            "fechaConstitucion" => "Fecha de Constitución"
        ];

        foreach ($labels as $key => $label) {
            echo "<div class='form-group' style='margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #ccc;'>";
            echo "<label for='$key' style='font-weight: bold; font-size: 16px; display: block;'>$label:</label>";
            echo "<span style='font-size: 16px; display: block; padding-top: 5px;'>" . htmlspecialchars($row[$key]) . "</span>";
            echo "</div>";
        }
        ?>

            <!-- Datos Bancarios -->
            <?php
            $sql = "SELECT * FROM bancario WHERE estadoCuenta != 'Archivado';"; // Excluir bancos archivados
            $query = mysqli_query($con, $sql);

            if ($query && mysqli_num_rows($query) > 0) {
                echo "<div class='form-group' style='margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #000;'>";
                echo "<h4 class='form-text' style='font-weight: bold;'>Datos Bancarios:</h4>";

                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<p style='margin-top: 10px; font-size: 16px;'><strong>Número de cuenta:</strong> " . htmlspecialchars($row['num_cuenta']) . "</p>";
                    echo "<p style='font-size: 16px;'><strong>Nombre del banco:</strong> " . htmlspecialchars($row['nomb_banco']) . "</p>";
                    echo "<p style='font-size: 16px;'><strong>Estado de cuenta:</strong> " . htmlspecialchars($row['estadoCuenta']) . "</p>";
                    echo "<hr style='border: 1px dashed #bbb;'>";
                }

                echo "</div>";
            } else {
                echo "<p style='font-size: 16px; color: red;'>No hay bancos activos registrados.</p>";
            }
            ?>


        <!-- Botones -->
        <div style="margin-top: 20px;">
            <button type="submit" formmethod="post" formaction="../dashboard/principal.php" class="btn btn-danger">Volver al inicio</button>
            <button type="submit" formmethod="post" formaction="ingresarBancos.php" class="btn btn-primary">Ingresar a Bancos</button>
            <button type="submit" formmethod="post" formaction="actualizarEmpresa.php" class="btn btn-primary">Actualizar Información</button>
        </div>
    </form>
</div>

                </div>
            </div>
            <!-- ESTO ES LO QUE PODEMOS MODIFICAR -->
        </div>

    </div>

</body>

</html>