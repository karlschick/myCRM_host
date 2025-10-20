<?php
// Evitar el cacheo de la página
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

session_start();
error_reporting(0);

// Verificar sesión
$nombreUsuarioSesion = $_SESSION['nombresUsuario'] ?? $_SESSION['usuario'] ?? null;
$rol = $_SESSION['rol'] ?? null;
$fotoPerfilBD = $_SESSION['foto'] ?? null;

if (empty($nombreUsuarioSesion)) {
    header("location: ../login/login.php");
    exit();
}

$usuarioTexto = htmlspecialchars($nombreUsuarioSesion) . " - " . htmlspecialchars($rol);

// 📁 Rutas
$rutaWebFotos = "../assets/images/faces-clipart/";
$rutaServidorFotos = realpath(__DIR__ . "/../public_html/assets/images/faces-clipart/") . "/";

// Buscar foto en BD si no está en sesión
if (empty($fotoPerfilBD)) {
    require_once __DIR__ . '/../../config/db.php';
    if ($con) {
        $stmt = $con->prepare("SELECT foto FROM usuario WHERE nombresUsuario = ?");
        $stmt->bind_param("s", $varsesion);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($row = $result->fetch_assoc()) {
            $fotoPerfilBD = $row['foto'];
            $_SESSION['foto'] = $fotoPerfilBD;
        }
        $stmt->close();
        $con->close();
    }
}

// Verificar foto existente
if (!empty($fotoPerfilBD) && file_exists($rutaServidorFotos . $fotoPerfilBD)) {
    $fotoPerfil = $rutaWebFotos . rawurlencode($fotoPerfilBD);
} else {
    $fotoPerfil = $rutaWebFotos . "pic-1.png";
}
?>

<!-- ================== MENÚ TÉCNICO ================== -->
<div class="container-scroller">
    <!-- Sidebar lateral -->
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <div class="sidebar-brand-wrapper d-none d-lg-flex align-items-center justify-content-center fixed-top">
            <a class="sidebar-brand brand-logo" href="../dashboard/principal.php">
                <img src="../assets/images/atori.png" alt="logo">
            </a>
            <a class="sidebar-brand brand-logo-mini" href="../dashboard/principal.php">
                <img src="../assets/images/logo-mini.png" alt="logo">
            </a>
        </div>

        <ul class="nav">
            <li class="nav-item profile">
                <div class="profile-desc">
                    <div class="profile-pic">
                        <div class="count-indicator">
                            <img class="img-xs rounded-circle" src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil">
                            <span class="count bg-success"></span>
                        </div>
                        <div class="profile-name">
                            <h5 class="mb-0 font-weight-normal"><?php echo htmlspecialchars($rol) ?></h5>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item nav-category">
                <span class="nav-link">PANEL TÉCNICO</span>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="../visitas/tablasVisitasT.php">
                    <span class="menu-icon"><i class="mdi mdi-table-large"></i></span>
                    <span class="menu-title">Gestión Visitas</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="../inventario/tablasinventarioT.php">
                    <span class="menu-icon"><i class="mdi mdi-package-variant-closed"></i></span>
                    <span class="menu-title">Inventario Técnico</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="../planes/solicitudesT.php">
                    <span class="menu-icon"><i class="mdi mdi-format-list-bulleted"></i></span>
                    <span class="menu-title">Solicitudes de Servicio</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Navbar superior -->
    <div class="container-fluid page-body-wrapper">
        <nav class="navbar p-0 fixed-top d-flex flex-row">
            <div class="navbar-brand-wrapper d-flex d-lg-none align-items-center justify-content-center">
                <a class="navbar-brand brand-logo-mini" href="../dashboard/principal.php">
                    <img src="../assets/images/logo-mini.png" alt="logo">
                </a>
            </div>

            <div class="navbar-menu-wrapper flex-grow d-flex align-items-stretch">
                <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                    <span class="mdi mdi-menu"></span>
                </button>


            <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid">

                <!-- 🔍 Buscador global -->
                <form class="d-flex ms-auto me-4" style="position: relative; width: 400px;">
                <input 
                    type="text" 
                    id="busqueda" 
                    class="form-control form-control-lg shadow-sm" 
                    placeholder="🔍 Buscar cliente por nombre, documento o plan..."
                    style="
                    width: 100%;
                    border-radius: 50px;
                    padding-left: 45px;
                    border: 2px solid #ced4da;
                    transition: all 0.3s ease;
                    "
                >
                <i 
                    class="bi bi-search" 
                    style="
                    position: absolute;
                    top: 50%;
                    left: 15px;
                    transform: translateY(-50%);
                    color: #6c757d;
                    font-size: 1.2rem;
                    "
                ></i>
                </form>

                <!-- otros elementos del menú -->
            </div>
            </nav>

            <!-- ✅ Aquí incluyes los estilos y el script del buscador -->
            <?php include_once '../../includes/search.php'; ?>



                <ul class="navbar-nav navbar-nav-right">
                    <a href="../planes/solicitudes.php" class="btn btn-info" role="button">Nuevos Clientes</a>

                    <li class="nav-item dropdown">
                        <a class="nav-link collapsed" id="profileDropdown" href="#" data-toggle="dropdown">
                            <div class="navbar-profile">
                                <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php echo $usuarioTexto; ?></p>
                                <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                                <img class="rounded-circle" src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil" style="width:40px; height:40px; object-fit:cover;">
                            </div>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list">
                            <h6 class="p-3 mb-0">PERFIL</h6>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item preview-item" href="../empresa/verempresa.php">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-office-building text-primary"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject mb-1">Información de la Empresa</p>
                                </div>
                            </a>

                            <a class="dropdown-item preview-item" href="../login/cerrarSesion.php">
                                <div class="preview-thumbnail">
                                    <div class="preview-icon bg-dark rounded-circle">
                                        <i class="mdi mdi-logout text-danger"></i>
                                    </div>
                                </div>
                                <div class="preview-item-content">
                                    <p class="preview-subject mb-1">Cerrar Sesión</p>
                                </div>
                            </a>
                        </div>
                    </li>
                </ul>

                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="mdi mdi-format-line-spacing"></span>
                </button>
            </div>
        </nav>

    <!-- Carga de los plugins JavaScript principales -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- Fin de la inyección de plugins -->

    <!-- Plugins específicos para esta página -->
    <script src="../assets/vendors/chart.js/Chart.min.js"></script> <!-- Plugin para gráficos -->
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script> <!-- Plugin para barras de progreso -->
    <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script> <!-- Plugin de mapas interactivos -->
    <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script> <!-- Datos del mapa mundial -->
    <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script> <!-- Plugin para carruseles de imágenes -->
    <!-- Fin de la carga de plugins específicos -->

    <!-- Inyección de scripts principales del sistema -->
    <script src="../assets/js/off-canvas.js"></script> <!-- Manejo de menú lateral -->
    <script src="../assets/js/hoverable-collapse.js"></script> <!-- Animaciones de colapso -->
    <script src="../assets/js/misc.js"></script> <!-- Scripts misceláneos -->
    <script src="../assets/js/settings.js"></script> <!-- Configuraciones generales -->
    <script src="../assets/js/todolist.js"></script> <!-- Manejo de lista de tareas -->
    <!-- Fin de la inyección de scripts -->

    <!-- Script personalizado para esta página -->
    <script src="../assets/js/dashboard.js"></script> <!-- Lógica específica del panel de control -->
    <!-- Fin del script personalizado -->

    <!-- Elemento de tooltip para el mapa interactivo -->
    <div class="jvectormap-tip"></div>

    <!-- Importación de SweetAlert para mostrar alertas visuales -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Script para manejar la funcionalidad de eliminación con SweetAlert -->
    <script>
        $('.borrar').on('click', function(e) {
            e.preventDefault(); // Previene la acción por defecto del enlace

            var self = $(this); // Guarda la referencia del elemento clickeado

            console.log(self.data('title')); // Muestra en consola el título del elemento (si tiene)

            // Muestra una alerta de confirmación antes de proceder con la acción
            Swal.fire({
                title: '¿Está seguro que desea continuar?', // Mensaje de la alerta
                icon: 'warning', // Icono de advertencia
                showCancelButton: true, // Muestra el botón de cancelar
                confirmButtonColor: '#3085d6', // Color del botón de confirmar
                cancelButtonColor: '#d33', // Color del botón de cancelar
                confirmButtonText: 'Confirmar', // Texto del botón de confirmación
                cancelButtonText: 'No', // Texto del botón de cancelación
                background: '#34495E' // Color de fondo de la alerta
            }).then((result) => {
                if (result.isConfirmed) { // Si el usuario confirma
                    location.href = self.attr('href'); // Redirige a la URL del enlace
                }
            })
        })
    </script>
</body>

</html>