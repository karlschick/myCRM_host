<?php
// Configurar encabezados para exportar a Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=Visitas.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Agregar firma UTF-8 para evitar caracteres extraños en Excel
echo "\xEF\xBB\xBF";

// Incluir conexión a la base de datos
require_once __DIR__ . "/../../config/db.php";

// Consulta SQL
$sql = "SELECT * FROM visitas";
$rta = $con->query($sql);

// Iniciar tabla HTML (compatible con Excel)
echo '<table border="1">
        <thead>
            <tr>
                <th>ID Visita</th>
                <th>Documento Cliente</th>
                <th>Nombre Cliente</th>
                <th>Teléfono Cliente</th>
                <th>Correo Cliente</th>
                <th>Dirección Cliente</th>
                <th>Documento Técnico</th>
                <th>Nombre Técnico</th>
                <th>Teléfono Técnico</th>
                <th>Correo Técnico</th>
                <th>Motivo de Visita</th>
                <th>Día de la Visita</th>
                <th>Estado de la Visita</th>
            </tr>
        </thead>
        <tbody>';

// Generar filas con datos de la base de datos
if ($rta) {
    while ($row = $rta->fetch_assoc()) {
        echo '<tr>
                <td>' . htmlspecialchars($row['idVisita']) . '</td>
                <td>' . htmlspecialchars($row['documentoCliente']) . '</td>
                <td>' . htmlspecialchars($row['nombreCliente']) . '</td>
                <td>' . htmlspecialchars($row['telefonoCliente']) . '</td>
                <td>' . htmlspecialchars($row['emailCliente']) . '</td>
                <td>' . htmlspecialchars($row['direccionCliente']) . '</td>
                <td>' . htmlspecialchars($row['documentoTecnico']) . '</td>
                <td>' . htmlspecialchars($row['nombreTecnico']) . '</td>
                <td>' . htmlspecialchars($row['telefonoTecnico']) . '</td>
                <td>' . htmlspecialchars($row['emailTecnico']) . '</td>
                <td>' . htmlspecialchars($row['motivoVisita']) . '</td>
                <td>' . htmlspecialchars($row['diaVisita']) . '</td>
                <td>' . htmlspecialchars($row['estadoVisita']) . '</td>
            </tr>';
    }
}

// Cerrar la tabla
echo '</tbody></table>';

// Finalizar script
exit;
?>
