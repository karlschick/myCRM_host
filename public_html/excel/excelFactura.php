<?php
// Configurar encabezados para exportar a Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header('Content-Disposition: attachment; filename="Factura.xls"');
header("Pragma: no-cache");
header("Expires: 0");

// Agregar firma UTF-8 para evitar caracteres extraños
echo "\xEF\xBB\xBF";

// Incluir conexión a la base de datos
require_once __DIR__ . "/../../config/db.php";

// Consulta SQL
$sql = "SELECT cliente.idCliente, factura.cliente_idCliente, cliente.documentoCliente, 
               cliente.nombreCliente, factura.fechaFactura, factura.valorTotalFactura, 
               factura.estadoFactura 
        FROM cliente 
        INNER JOIN factura ON cliente.idCliente = factura.cliente_idCliente";

$rta = $con->query($sql);

// Iniciar tabla HTML (compatible con Excel)
echo '<table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Documento Cliente</th>
                <th>Nombre Cliente</th>
                <th>Fecha Factura</th>
                <th>Valor Total</th>
                <th>Estado Factura</th>
            </tr>
        </thead>
        <tbody>';

// Generar filas con datos de la base de datos
if ($rta) {
    while ($row = $rta->fetch_assoc()) {
        echo '<tr>
                <td>' . mb_convert_encoding($row['idCliente'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['documentoCliente'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['nombreCliente'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['fechaFactura'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['valorTotalFactura'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['estadoFactura'], 'UTF-16LE', 'UTF-8') . '</td>
            </tr>';
    }
}

// Cerrar la tabla
echo '</tbody></table>';

// Finalizar script
exit;
?>
