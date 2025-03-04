<?php
// Configurar encabezados para exportar a Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=Usuarios.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Agregar firma UTF-8 para evitar caracteres extraños en Excel
echo "\xEF\xBB\xBF";

// Incluir conexión a la base de datos
require_once __DIR__ . "/../../config/db.php";

// Consulta SQL
$sql = "SELECT * FROM usuario WHERE estadoUsuario='Activo';";
$rta = $con->query($sql);

// Iniciar tabla HTML (compatible con Excel)
echo '<table border="1">
        <thead>
            <tr>
                <th>Tipo de identificación</th>
                <th>Número de documento</th>
                <th>Nombres</th>
                <th>Teléfono</th>
                <th>Email</th>
                <th>Clave</th>
                <th>Estado</th>
                <th>Fecha de creación</th>
                <th>Última actualización</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>';

// Generar filas con datos de la base de datos
if ($rta) {
    while ($row = $rta->fetch_assoc()) {
        echo '<tr>
                <td>' . htmlspecialchars($row['tipoDocumento']) . '</td>
                <td>' . htmlspecialchars($row['documentoUsuario']) . '</td>
                <td>' . htmlspecialchars($row['nombresUsuario']) . '</td>
                <td>' . htmlspecialchars($row['telefonoUsuario']) . '</td>
                <td>' . htmlspecialchars($row['correoUsuario']) . '</td>
                <td>' . htmlspecialchars($row['claveUsuario']) . '</td>
                <td>' . htmlspecialchars($row['estadoUsuario']) . '</td>
                <td>' . htmlspecialchars($row['creado']) . '</td>
                <td>' . htmlspecialchars($row['ultimaActualizacion']) . '</td>
                <td>' . htmlspecialchars($row['rol']) . '</td>
            </tr>';
    }
}

// Cerrar la tabla
echo '</tbody></table>';

// Finalizar script
exit;
?>
