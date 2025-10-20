<?php
// Seguridad de sesiones
session_start();
error_reporting(0); // En desarrollo usa: error_reporting(E_ALL);

$varsesion = $_SESSION['usuario'];
if (empty($varsesion)) {
    header("Location: ../index.php");
    die();
}

// Incluye encabezado y conexión
include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';
?>
<script src="../assets/js/chart.js"></script>
<body>
    <!-- Incluye menú de navegación -->
    <?php include '../../includes/menu.php'; ?>

    <!-- Contenedor principal -->
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

            <?php
            // =========================
            // Conteos generales de varias tablas
            // =========================
            $tablas = [
                'cliente',
                'usuario',
                'plan',
                'factura',
                'producto',
                'pqr2',
                'visitas',
                'solicitudes'
            ];

            function obtenerConteos($tablas, $con) {
                $conteos = [];
                foreach ($tablas as $tabla) {
                    $sql = "SELECT COUNT(*) AS total FROM $tabla";
                    $res = $con->query($sql);
                    $conteos[$tabla] = $res ? $res->fetch_assoc()['total'] : 0;
                }
                return $conteos;
            }

            $conteos = obtenerConteos($tablas, $con);

            // =========================
            // Conteo de clientes (total, activos, archivados)
            // =========================
            $sqlClientes = "
                SELECT
                    COUNT(*) AS total,
                    SUM(CASE WHEN estadoCliente='Activo' THEN 1 ELSE 0 END) AS activos,
                    SUM(CASE WHEN estadoCliente='Archivado' THEN 1 ELSE 0 END) AS archivados
                FROM cliente
            ";
            $res = $con->query($sqlClientes)->fetch_assoc();

            $conteos['cliente'] = $res['total'];
            $conteos['clientes_activos'] = $res['activos'];
            $conteos['clientes_archivados'] = $res['archivados'];

            // Conteo facturas pendientes
            $sqlFacturasPend = "
                SELECT COUNT(*) AS pendientes
                FROM factura
                WHERE estadoFactura = 'Pendiente'
            ";
            $resFact = $con->query($sqlFacturasPend)->fetch_assoc();
            $conteos['facturas_pendientes'] = $resFact['pendientes'];

            // Conteo de PQR activos
            $sqlPqrActivos = "
                SELECT COUNT(*) AS activos
                FROM pqr2
                WHERE estadoPqr = 'Activo'
            ";
            $resPqr = $con->query($sqlPqrActivos)->fetch_assoc();
            $conteos['pqr_activos'] = $resPqr['activos'];

            // Conteo de visitas activas
            $sqlVisitasActivas = "
                SELECT COUNT(*) AS activas
                FROM visitas
                WHERE estadoVisita = 'Activo'
            ";
            $resVisitas = $con->query($sqlVisitasActivas)->fetch_assoc();
            $conteos['visitas_activas'] = $resVisitas['activas'];

            // Conteo de solicitudes activas
            $sqlSolicitudesActivas = "
                SELECT COUNT(*) AS activas
                FROM solicitudes
                WHERE estadoSolicitud = 'Activo'
            ";
            $resSol = $con->query($sqlSolicitudesActivas)->fetch_assoc();
            $conteos['solicitudes_activas'] = $resSol['activas'];




            // =========================
            // Incluir las cards
            // =========================
            include 'cards/dashboard_cards.php';
            ?>

            </div> <!-- cierre row -->
        </div> <!-- cierre content-wrapper -->

        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">
                    Derechos de autor © skubox 2025
                </span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                    <a href="derAutor.php" target="_blank">skubox.com</a>
                </span>
            </div>
        </footer>
    </div> <!-- Fin de main-panel -->
</body>
</html>



