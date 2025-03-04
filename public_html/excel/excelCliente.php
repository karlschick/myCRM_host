<?php
// Configurar encabezados para exportar a Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header('Content-Disposition: attachment; filename="Clientes.xls"');
header("Pragma: no-cache");
header("Expires: 0");

// Agregar firma de archivo UTF-8 para evitar caracteres raros en Excel
echo "\xEF\xBB\xBF";

// Incluir conexión a la base de datos
require_once __DIR__ . "/../../config/db.php";

// Consulta SQL para obtener clientes activos
$sql = "SELECT * FROM cliente WHERE estadoCliente='Activo';";
$rta = $con->query($sql);

// Iniciar tabla HTML (compatible con Excel)
echo '<table border="1">
        <thead>
            <tr>
                <th>Tipo identificación</th>
                <th>Número de documento</th>
                <th>Nombres</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Dirección</th>
                <th>Estado</th>
                <th>Fecha de creación</th>
                <th>Última Actualización</th>
            </tr>
        </thead>
        <tbody>';

// Generar filas de la tabla con los datos de la base de datos
if ($rta) {
    while ($row = $rta->fetch_assoc()) {
        echo '<tr>
                <td>' . mb_convert_encoding($row['tipoDocumento'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['documentoCliente'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['nombreCliente'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['telefonoCliente'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['correoCliente'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['direccion'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['estadoCliente'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['creado'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['ultimaActualizacion'], 'UTF-16LE', 'UTF-8') . '</td>
            </tr>';
    }
}

// Cerrar la tabla
echo '</tbody></table>';

// Finalizar script
exit;
?>
