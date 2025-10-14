<?php
require_once '../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Crear instancia con opciones adecuadas
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Conexión a base de datos
require_once __DIR__ . '/../../config/db.php';

// Obtener datos de la factura
$id = $_GET['id'];
$sql = "SELECT * FROM cliente  
INNER JOIN plan ON cliente.plan_idPlan = plan.idPlan
INNER JOIN factura ON cliente.idCliente = factura.cliente_idCliente
WHERE idFactura = '$id';";

if ($rta = $con->query($sql)) {
  while ($row = $rta->fetch_assoc()) {
    $td = $row['tipoDocumento'];
    $doc = $row['documentoCliente']; // ← Cédula del cliente
    $nomc = $row['nombreCliente'];
    $telc = $row['telefonoCliente'];
    $emailc = $row['correoCliente'];
    $fing = $row['fechaFactura'];
    $ffact = $row['fechaVencimiento'];
    $flim = $row['fechaSuspencion'];
    $nplan = $row['nombrePlan'];
    $vp = $row['velocidad'];
    $estf = $row['estadoFactura'];
    $sub = $row['subTotal'];
    $impt = $row['impuestoTotal'];
    $st = $row['valorTotalFactura'];
  }
}

$sql2 = "SELECT * FROM empresa WHERE id='1';";
$query2 = mysqli_query($con, $sql2);
$rowEmpresa = mysqli_fetch_array($query2);

// ✅ Ruta del logo y conversión a Base64
$logo_path = __DIR__ . '/../assets/images/empresa/logoEmpresa.png';
if (file_exists($logo_path)) {
    $logo_base64 = base64_encode(file_get_contents($logo_path));
    $logo_html = '<img src="data:image/png;base64,' . $logo_base64 . '" style="max-width: 120px;">';
} else {
    $logo_html = '<strong>Logo no disponible</strong>';
}

// --- Contenido HTML del PDF ---
$html = '
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Factura</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      font-size: 12px;
      color: #000;
    }
    .container {
      text-align: center;
      margin: 0 auto;
      width: 100%;
    }
    .logo {
      margin-bottom: 10px;
    }
    h2 {
      margin: 5px 0;
      color: #333;
    }
    .section {
      margin-top: 10px;
      text-align: center;
    }
    .line {
      border-bottom: 1px solid #000;
      margin: 8px 0;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">' . $logo_html . '</div>
    <h2>' . $rowEmpresa['nombEmpresa'] . '</h2>
    <p>' . $rowEmpresa['rz'] . '</p>
    <p><strong>NIT:</strong> ' . $rowEmpresa['nit'] . '</p>
    <p><strong>Tel:</strong> ' . $rowEmpresa['telsede'] . ' | ' . $rowEmpresa['telsede2'] . '</p>
    <div class="line"></div>

    <h3>Factura</h3>
    <p><strong>Cliente:</strong> ' . $nomc . '</p>
    <p><strong>' . $td . ':</strong> ' . $doc . '</p>
    <p><strong>Teléfono:</strong> ' . $telc . '</p>
    <p><strong>Correo:</strong> ' . $emailc . '</p>

    <div class="line"></div>

    <p><strong>Fecha factura:</strong> ' . $fing . '</p>
    <p><strong>Fecha límite de pago:</strong> ' . $ffact . '</p>
    <p><strong>Fecha de suspensión:</strong> ' . $flim . '</p>
    <p><strong>Plan:</strong> ' . $nplan . '</p>
    <p><strong>Velocidad:</strong> ' . $vp . '</p>
    <p><strong>Estado:</strong> ' . $estf . '</p>

    <div class="line"></div>

    <p><strong>Subtotal:</strong> $' . number_format($sub, 0, ',', '.') . '</p>
    <p><strong>IVA 19%:</strong> $' . number_format($impt, 0, ',', '.') . '</p>
    <p><strong>Total a pagar:</strong> $' . number_format($st, 0, ',', '.') . '</p>
  </div>
</body>
</html>';

// --- Generar PDF ---
$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'portrait');
$dompdf->render();

// --- Nombre del archivo con cédula, mes y año ---
$meses = [
  1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril', 5 => 'mayo',
  6 => 'junio', 7 => 'julio', 8 => 'agosto', 9 => 'septiembre',
  10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
];

$numero_mes = date('n', strtotime($fing));
$nombre_mes = $meses[$numero_mes];
$anio_actual = date('Y');

// 🔹 El nombre del archivo tendrá la cédula primero
$nombre_archivo = $doc . '_factura_' . $nombre_mes . '_' . $anio_actual . '.pdf';

// --- Descargar PDF (pregunta dónde guardarlo) ---
$dompdf->stream($nombre_archivo, ["Attachment" => true]);
?>
