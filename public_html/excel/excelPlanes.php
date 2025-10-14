<?php
session_start();
error_reporting(0);

// 🔐 Seguridad de sesión
if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    exit;
}

// 📋 Encabezados para exportar a Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Pragma: no-cache");
header("Expires: 0");

// ⚙️ Determinar tipo (activo o inactivo)
$tipo = isset($_GET['tipo']) ? strtolower(trim($_GET['tipo'])) : 'activo';

// 🕒 Generar nombre dinámico del archivo
$fecha = date('Y-m-d');
$nombreArchivo = "Planes_" . ucfirst($tipo) . "_$fecha.xls";
header("Content-Disposition: attachment; filename=$nombreArchivo");

// 🧩 Firma UTF-8 (evita errores de acentos en Excel)
echo "\xEF\xBB\xBF";

// 🔌 Conexión a la base de datos
require_once __DIR__ . "/../../config/db.php";

// 🧾 Consulta SQL según el tipo
if ($tipo === 'inactivo') {
    $sql = "SELECT codigoPlan, velocidad, nombrePlan, precioPlan, desPlan, estadoPlan
            FROM plan
            WHERE LOWER(COALESCE(estadoPlan,'')) != 'activo'
            ORDER BY codigoPlan ASC;";
    $titulo = "LISTA DE PLANES INACTIVOS";
} else {
    $sql = "SELECT codigoPlan, velocidad, nombrePlan, precioPlan, desPlan, estadoPlan
            FROM plan
            WHERE LOWER(estadoPlan) = 'activo'
            ORDER BY codigoPlan ASC;";
    $titulo = "LISTA DE PLANES ACTIVOS";
}

// Ejecutar la consulta
$rta = $con->query($sql);

// 🧮 Generar tabla HTML compatible con Excel
echo "<table border='1'>
        <thead>
            <tr style='background-color:#d9edf7; font-weight:bold; text-align:center;'>
                <th colspan='6'>$titulo</th>
            </tr>
            <tr style='background-color:#f2f2f2; font-weight:bold;'>
                <th>Código Plan</th>
                <th>Velocidad del Plan</th>
                <th>Nombre del Plan</th>
                <th>Precio del Plan</th>
                <th>Descripción del Plan</th>
                <th>Estado del Plan</th>
            </tr>
        </thead>
        <tbody>";

// Mostrar resultados
if ($rta && $rta->num_rows > 0) {
    while ($row = $rta->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['codigoPlan']) . "</td>
                <td>" . htmlspecialchars($row['velocidad']) . "</td>
                <td>" . htmlspecialchars($row['nombrePlan']) . "</td>
                <td>" . htmlspecialchars($row['precioPlan']) . "</td>
                <td>" . htmlspecialchars($row['desPlan']) . "</td>
                <td>" . htmlspecialchars($row['estadoPlan']) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No hay registros para mostrar.</td></tr>";
}

echo "</tbody></table>";
exit;
?>
