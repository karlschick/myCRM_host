<?php
// Evitar el cacheo de la página
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

error_reporting(0);

// Verificar sesión
$varsesion = $_SESSION['usuario'] ?? null;
$rol = $_SESSION['rol'] ?? null;
$fotoPerfilBD = $_SESSION['foto'] ?? null;

if (empty($varsesion)) {
    header("location: ../login/login.php");
    exit();
}

$usuarioTexto = htmlspecialchars($varsesion) . " - " . htmlspecialchars($rol);

// 📁 Rutas (ajustadas a tu estructura)
// Ruta que se usará en las etiquetas <img> (relativa a las páginas en public_html)
$rutaWebFotos = "../assets/images/faces-clipart/";

// Ruta física real en el servidor: desde este archivo (proyecto/includes) hacia public_html/assets/...
// -> includes/  .. / public_html / assets / images / faces-clipart
$rutaServidorFotos = realpath(__DIR__ . "/../public_html/assets/images/faces-clipart/") . "/";

// Si no hay foto en sesión, obtenerla desde la BD
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

// Mostrar foto real si existe físicamente, o por defecto
if (!empty($fotoPerfilBD) && $rutaServidorFotos && file_exists($rutaServidorFotos . $fotoPerfilBD)) {
    // rawurlencode para manejar espacios y caracteres especiales en el src
    $fotoPerfil = $rutaWebFotos . rawurlencode($fotoPerfilBD);
} else {
    $fotoPerfil = $rutaWebFotos . "pic-1.png";
}
?>

<!-- ================== MENÚ PRINCIPAL ================== -->
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
                            <!-- Foto de usuario -->
                            <img class="img-xs rounded-circle" src="<?php echo $fotoPerfil; ?>" alt="Foto de perfil">
                            <span class="count bg-success"></span>
                        </div>
                        <div class="profile-name">
                            <h5 class="mb-0 font-weight-normal"><?php echo $usuarioTexto; ?></h5>
                        </div>
                    </div>
                </div>
            </li>

            <li class="nav-item nav-category">
                <span class="nav-link">PANEL DE CONTROL</span>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="../clientes/tablas.php">
                    <span class="menu-icon"><i class="mdi mdi-laptop"></i></span>
                    <span class="menu-title">Gestión Clientes</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="../planes/tablaplanes.php">
                    <span class="menu-icon"><i class="mdi mdi-laptop"></i></span>
                    <span class="menu-title">Gestión Planes</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="../facturacion/facturas.php">
                    <span class="menu-icon"><i class="mdi mdi-playlist-play"></i></span>
                    <span class="menu-title">Gestión Facturación</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="../inventario/tablasinventario.php">
                    <span class="menu-icon"><i class="mdi mdi-chart-bar"></i></span>
                    <span class="menu-title">Gestión Inventario</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="../pqr/pqr.php">
                    <span class="menu-icon"><i class="mdi mdi-contacts"></i></span>
                    <span class="menu-title">Atención al Cliente</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="../visitas/tablasVisitas.php">
                    <span class="menu-icon"><i class="mdi mdi-table-large"></i></span>
                    <span class="menu-title">Gestión Visitas</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="../usuarios/tablasUser.php">
                    <span class="menu-icon"><i class="mdi mdi-table-large"></i></span>
                    <span class="menu-title">Usuarios Empresa</span>
                </a>
            </li>

            <li class="nav-item menu-items">
                <a class="nav-link" href="../planes/solicitudes.php">
                    <span class="menu-icon"><i class="mdi mdi-table-large"></i></span>
                    <span class="menu-title">Solicitudes</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Contenedor principal -->
    <div class="container-fluid page-body-wrapper">
<!-- Navbar superior -->
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

        <!-- 🔍 Buscador global -->
        <form class="d-flex ms-auto me-4 buscador-global" style="position: relative; width: 400px;">
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

        <!-- ✅ Aquí incluyes los estilos y el script del buscador -->
        <?php include_once '../../includes/search.php'; ?>

        <ul class="navbar-nav navbar-nav-right align-items-center">
            <li class="nav-item me-2">
                <a href="../planes/solicitudes.php" class="btn btn-info btn-sm px-3" role="button">Nuevos Clientes</a>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link collapsed d-flex align-items-center" id="profileDropdown" href="#" data-toggle="dropdown">
                    <p class="mb-0 d-none d-sm-block navbar-profile-name me-2"><?php echo $usuarioTexto; ?></p>
                    <i class="mdi mdi-menu-down d-none d-sm-block me-1"></i>
                    <img class="rounded-circle" 
                         src="<?php echo $fotoPerfil; ?>" 
                         alt="Foto de perfil" 
                         style="width:40px; height:40px; object-fit:cover;">
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

<!-- ✅ Ajustes CSS específicos para móviles -->
<style>
@media (max-width: 992px) {
    .buscador-global {
        width: 100% !important;
        margin: 10px auto;
        padding: 0 15px;
    }

    .navbar-nav-right {
        flex-direction: row;
        justify-content: center;
        gap: 8px;
    }

    .navbar-profile-name, .mdi-menu-down {
        display: none !important;
    }

    .navbar-toggler {
        margin-left: 8px;
    }

    .btn-info {
        font-size: 0.85rem;
        padding: 5px 10px;
    }

    .navbar .rounded-circle {
        width: 36px !important;
        height: 36px !important;
    }
}
</style>


    <!-- Scripts -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <script src="../assets/js/dashboard.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('.borrar').on('click', function(e) {
            e.preventDefault();
            var self = $(this);
            Swal.fire({
                title: '¿Está seguro que desea continuar?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'No',
                background: '#34495E'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = self.attr('href');
                }
            });
        });
    </script>
</body>
</html>
