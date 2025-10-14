<?php
// Incluye el encabezado de la página
include '../../includes/header.php';
?>

<body>
<?php
require_once __DIR__ . '/../../config/db.php';

$idFactura = $_GET['id'] ?? 0;

// Consulta corregida con JOINs y selección explícita
$sql = "SELECT 
            c.idCliente, c.tipoDocumento, c.documentoCliente, c.nombreCliente, c.telefonoCliente, c.correoCliente, 
            c.direccion, c.estadoCliente, c.plan_idPlan, c.creado, c.ultimaActualizacion,
            f.idFactura, f.fechaFactura, f.impuestoTotal, f.subTotal, f.valorTotalFactura, f.cliente_idCliente, f.estadoFactura, f.fechaVencimiento, f.fechaSuspencion,
            p.idPlan, p.codigoPlan, p.tipoPlan, p.velocidad, p.nombrePlan, p.precioPlan, p.desPlan, p.estadoPlan,
            e.nombEmpresa, e.rz, e.nit, e.telsede, e.telsede2
        FROM cliente c
        INNER JOIN factura f ON c.idCliente = f.cliente_idCliente
        LEFT JOIN plan p ON c.plan_idPlan = p.idPlan
        LEFT JOIN empresa e ON e.id = 1
        WHERE f.idFactura = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("i", $idFactura);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $idCliente = $row['idCliente'];
    $tipoDoc = $row['tipoDocumento'];
    $doc = $row['documentoCliente'];
    $nomc = $row['nombreCliente'];
    $telc = $row['telefonoCliente'];
    $emailc = $row['correoCliente'];
    $direccion = $row['direccion'];
    $estadoCliente = $row['estadoCliente'];
    $plancliente = $row['plan_idPlan'];
    $creado = $row['creado'];
    $ultimaActualizacion = $row['ultimaActualizacion'];
    $idPlan = $row['idPlan'];
    $codigoplan = $row['codigoPlan'];
    $tipoplan = $row['tipoPlan'];
    $vp = $row['velocidad'];
    $nombreplan = $row['nombrePlan'] ?? 'Sin Plan';
    $precioplan = $row['precioPlan'];
    $descripcionplan = $row['desPlan'];
    $estadoplan = $row['estadoPlan'];
    $idFactura = $row['idFactura'];
    $fechaFactura = $row['fechaFactura'];
    $impuesto = $row['impuestoTotal'];
    $subtotal = $row['subTotal'];
    $total = $row['valorTotalFactura'];
    $estadoFactura = $row['estadoFactura'];
    $fechaVenc = $row['fechaVencimiento'];
    $fechaSusp = $row['fechaSuspencion'];
    $empresaNombre = $row['nombEmpresa'];
    $empresaRZ = $row['rz'];
    $empresaNit = $row['nit'];
    $empresaTel1 = $row['telsede'];
    $empresaTel2 = $row['telsede2'];
} else {
    echo "<div class='text-center mt-4'><h3>No se encontró la factura.</h3></div>";
    exit;
}
?>

<div class="main-panel">
    <div class="content-wrapper">
        <!-- Título centrado -->
        <div class="page-header" style="width: 100%; display: flex; justify-content: center;">
            <h2 class="page-title" style="margin: 0;">FACTURA</h2>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-12 grid-margin stretch-card mx-auto">
                <div class="card">
                    <div class="card-body text-center">
                        <img class="logo d-block mx-auto mb-3" src="../assets/images/empresa/logoEmpresa.png" alt="logo" style="max-width: 20%; height: auto;" />
                        <h2 class="card-title"><?= htmlspecialchars($empresaNombre) ?></h2>
                        <p><?= htmlspecialchars($empresaRZ) ?> | NIT: <?= htmlspecialchars($empresaNit) ?></p>
                        <p>Tel: <?= htmlspecialchars($empresaTel1) ?> | Tel2: <?= htmlspecialchars($empresaTel2) ?></p>

                        <h4>Hola <?= htmlspecialchars($nomc) ?></h4>
                        <p>Documento: <?= htmlspecialchars("$tipoDoc: $doc") ?></p>
                        <p>Teléfono: <?= htmlspecialchars($telc) ?></p>
                        <p>Correo: <?= htmlspecialchars($emailc) ?></p>
                        <p>Factura emitida el: <?= htmlspecialchars($fechaFactura) ?></p>
                        <p>Fecha límite de pago: <?= htmlspecialchars($fechaVenc) ?></p>
                        <p>Fecha suspensión: <?= htmlspecialchars($fechaSusp) ?></p>
                        <p>Plan contratado: <?= htmlspecialchars($nombreplan) ?> | Velocidad: <?= htmlspecialchars($vp) ?></p>
                        <p>Estado factura: <?= htmlspecialchars($estadoFactura) ?></p>
                        <hr>
                        <p>Sub total: <?= htmlspecialchars($subtotal) ?></p>
                        <p>IVA 19%: <?= htmlspecialchars($impuesto) ?></p>
                        <p><strong>Valor total a pagar: <?= htmlspecialchars($total) ?></strong></p>

                        <a href="consultarfC.php" class="btn btn-light btn-lg">Volver a facturas</a>
                        <a href="facturaPDF.php?id=<?= $idFactura ?>" class="btn btn-light btn-lg">Imprimir PDF</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
