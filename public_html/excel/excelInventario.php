<?php 
// Configurar encabezados para exportar a Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header('Content-Disposition: attachment; filename="Inventario.xls"');
header("Pragma: no-cache");
header("Expires: 0");

// Agregar firma UTF-8 para evitar caracteres extraños
echo "\xEF\xBB\xBF";

// Incluir conexión a la base de datos
require_once __DIR__ . "/../../config/db.php";

// Consulta SQL
$sql = "SELECT * FROM producto WHERE estadoProducto='Activo';";
$rta = $con->query($sql);

// Iniciar tabla HTML (compatible con Excel)
echo '<table border="1">
        <thead>
            <tr>
                <th>Id Producto</th>
                <th>Nombre Producto</th>
                <th>Serial del producto</th>
                <th>Descripción del producto</th>
                <th>Cantidad en bodega</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>';

// Generar filas con datos de la base de datos
if ($rta) {
    while ($row = $rta->fetch_assoc()) {
        echo '<tr>
                <td>' . mb_convert_encoding($row['idProducto'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['nombreProducto'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['serialProducto'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['descripcionProducto'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['cantidad'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['estadoProducto'], 'UTF-16LE', 'UTF-8') . '</td>
            </tr>';
    }
}

// Cerrar la tabla
echo '</tbody></table>';

// Finalizar script
exit;
?>
