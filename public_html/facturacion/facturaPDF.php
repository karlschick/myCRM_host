<?php
require_once '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Crear una instancia de Dompdf con las opciones adecuadas
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isRemoteEnabled', true);
$dompdf = new Dompdf($options);

// Contenido HTML del PDF
$html = '<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Factura</title>
  <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="shortcut icon" href="../assets/images/favicon.png" />
  <style>
  .form-group>div {
    margin-bottom: 1px;
  }
</style>
</head>

<body>';

$host = "localhost";
$user = "root";
$pass = "";

$bd = "atory";

$con = mysqli_connect($host, $user, $pass, $bd);
if (!$con) {

  die("No se conecto a la base de datos " . mysqli_connect_error());
} else {
  //echo " CONEXIÓN EXITOSA";
}

$id = $_GET['id'];
$sql = "SELECT * FROM cliente  
INNER JOIN plan
on cliente.plan_idPlan=plan.idPlan
INNER JOIN factura
ON cliente.idCliente=factura.cliente_idCliente
WHERE idFactura= '$id';";

if ($rta = $con->query($sql)) {
  while ($row = $rta->fetch_assoc()) {
    $id = $row['idCliente'];
    $td = $row['tipoDocumento'];
    $doc = $row['documentoCliente'];
    $nomc = $row['nombreCliente'];
    $telc = $row['telefonoCliente'];
    $emailc = $row['correoCliente'];
    $dc = $row['direccion'];
    $ec = $row['estadoCliente'];
    $plancliente = $row['plan_idPlan'];
    $creado = $row['creado'];
    $uact = $row['ultimaActualizacion'];
    $idplan = $row['idPlan'];
    $codigoplan = $row['codigoPlan'];
    $tipoplan = $row['tipoPlan'];
    $vp = $row['velocidad'];
    $nombreplan = $row['nombrePlan'];
    $precioplan = $row['precioPlan'];
    $descripcionplan = $row['desPlan'];
    $estadoplan = $row['estadoPlan'];
    $if = $row['idFactura'];
    $fing = $row['fechaFactura'];
    $impt = $row['impuestoTotal'];
    $sub = $row['subTotal'];
    $st = $row['valorTotalFactura'];
    $cid = $row['cliente_idCliente'];
    $estf = $row['estadoFactura'];
    $ffact = $row['fechaVencimiento'];
    $flim = $row['fechaSuspencion'];
    $nplan = $row['nPlan'];
  }
}
$sql2 = "SELECT * FROM empresa WHERE id='1';";
$query2 = mysqli_query($con, $sql2);
$rowEmpresa = mysqli_fetch_array($query2);

$html .= '<div class="main-panel">
  <div class="content-wrapper">
  <div class="row justify-content-center">
    <div class="page-header">
    <center>
      <h2 class="page-title">FACTURA</h2>
      </center>
    </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-md-6 col-12 grid-margin stretch-card mx-auto">
        <div class="card">
          <div class="card-body">
            
            <br>
            <center>
              <h2 class="card-title">' . $rowEmpresa['nombEmpresa'] . '</h2>
            </center>

            <form class="forms-sample">
              <div class="form-group">
                <div class="card-body">
                  <form class="forms-sample">
                    <center><class="card-title">' . $rowEmpresa['rz'] . '</center>
                    <center><class="card-title">nit : ' . $rowEmpresa['nit'] . '</center>
                    <center><class="card-title">tel : ' . $rowEmpresa['telsede'] . '</center>
                    <center><class="card-title">tel2 : ' . $rowEmpresa['telsede2'] . '</center>
                    <br>
                    <center>
                      <h4 class="card-title">Hola ' . $nomc . '</h4>
                    </center>

                    <div class="form-group">
                      <div>
                        <center><label for="cp">Con : ' . $td . ': ' . $doc . '</label></center>
                      </div>
                      <div>
                        <center><label for="des"> Su telefono es ' . $telc . '</label>
                          <center>
                      </div>
                      <div>
                        <center><label for="des"> Su correo es: ' . $emailc . '</label></center>
                      </div>
                      <div>
                        <center><label for="cp">Tu factura correspondiente al : ' . $fing . '</label></center>
                      </div>



                      <div>
                      <center><label for="cp">Tu fecha limite de pago es : ' . $ffact . '</label></center>
                    </div>
                    <div>
                      <center><label for="cp">Tu fecha de suspeción de servicio : ' . $flim . '</label></center>
                    </div>
                    <div>
                      <center><label for="cp">Con el plan : ' . $nplan . '</label></center>
                    </div>

                      


  
                      <div>
                        <center><label for="cp">Tu factura se encuentra actualmente: ' . $estf . ' </label></center>
                      </div>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <br>
                      <div>
                        <center><label for="cp">Sub total: ' . $sub . '</label></center>
                      </div>
                      <div>
                        <center><label for="vel">IVA 19%: ' . $impt . '</label></center>
                      </div>
                      <div>
                        <center><label>_______________________</label></center>
                      </div>
                      <div>
                        <center><label for="plan">Valor total a pagar: ' . $st . '</label></center>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
          </div>
        </div>
      </div>
    </div>';

$html .= '</body></html>';

// Cargar el contenido HTML en Dompdf
$dompdf->loadHtml($html);
$dompdf->setPaper(array(0, 0, 400, 700), 'portrait');
// Renderizar el PDF
$dompdf->render();



// Enviar el PDF al navegador para su descarga o visualización
$meses = [
  1 => 'enero',
  2 => 'febrero',
  3 => 'marzo',
  4 => 'abril',
  5 => 'mayo',
  6 => 'junio',
  7 => 'julio',
  8 => 'agosto',
  9 => 'septiembre',
  10 => 'octubre',
  11 => 'noviembre',
  12 => 'diciembre'
];

// Obtener el número del mes actual
$numero_mes = date('n', strtotime($fing));

// Obtener el nombre del mes en español
$nombre_mes = $meses[$numero_mes];

// Obtener el año actual
$anio_actual = date('Y');

// Crear el nombre del archivo con el mes y el año en español
$nombre_archivo = 'factura_' . $nombre_mes . '_' . $anio_actual . '.pdf';

// Enviar el PDF al navegador para su descarga o visualización
$dompdf->stream($nombre_archivo);
