<?php
// Configurar encabezados para exportar a Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=Planes.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Agregar firma UTF-8 para evitar caracteres extraños en Excel
echo "\xEF\xBB\xBF";

// Incluir conexión a la base de datos
require_once __DIR__ . "/../../config/db.php";

// Consulta SQL
$sql = "SELECT * FROM plan WHERE estadoPlan='activo';";
$rta = $con->query($sql);

// Iniciar tabla HTML (compatible con Excel)
echo '<table border="1">
        <thead>
            <tr>
                <th>Código Plan</th>
                <th>Velocidad del Plan</th>
                <th>Nombre del Plan</th>
                <th>Precio del Plan</th>
                <th>Descripción del Plan</th>
                <th>Estado del Plan</th>
            </tr>
        </thead>
        <tbody>';

// Generar filas con datos de la base de datos
if ($rta) {
    while ($row = $rta->fetch_assoc()) {
        echo '<tr>
                <td>' . mb_convert_encoding($row['codigoPlan'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['velocidad'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['nombrePlan'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['precioPlan'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['desPlan'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['estadoPlan'], 'UTF-16LE', 'UTF-8') . '</td>
            </tr>';
    }
}

// Cerrar la tabla
echo '</tbody></table>';

// Finalizar script
exit;
?>
