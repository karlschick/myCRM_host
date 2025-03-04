<?php
// Configurar encabezados para exportar a Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=PQR.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Agregar firma UTF-8 para evitar caracteres extraños en Excel
echo "\xEF\xBB\xBF";

// Incluir conexión a la base de datos
require_once __DIR__ . "/../../config/db.php";

// Consulta SQL
$sql = "SELECT * FROM pqr2 WHERE estadoPqr='Activo';";
$rta = $con->query($sql);

// Iniciar tabla HTML (compatible con Excel)
echo '<table border="1">
        <thead>
            <tr>
                <th>Id PQR</th>
                <th>Tipo de documento</th>
                <th>Número de documento</th>
                <th>Nombres de cliente</th>
                <th>Teléfono cliente</th>
                <th>Correo cliente</th>
                <th>Tipo de PQR</th>
                <th>Descripción</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>';

// Generar filas con datos de la base de datos
if ($rta) {
    while ($row = $rta->fetch_assoc()) {
        echo '<tr>
                <td>' . mb_convert_encoding($row['idPqr'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['tipoDocumento'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['nDocumento'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['nombresCliente'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['telefonoCliente'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['emailCliente'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['tPqr'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['desPqr'], 'UTF-16LE', 'UTF-8') . '</td>
                <td>' . mb_convert_encoding($row['estadoPqr'], 'UTF-16LE', 'UTF-8') . '</td>
            </tr>';
    }
}

// Cerrar la tabla
echo '</tbody></table>';

// Finalizar script
exit;
?>
