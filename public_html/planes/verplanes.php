<?php
// Incluye el encabezado de la página
include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';

// ===========================================
// CONSULTAS PLANES
// ===========================================
$planes = [];
$sql = "SELECT * FROM plan ORDER BY codigoPlan ASC";
if ($rta = $con->query($sql)) {
    while ($row = $rta->fetch_assoc()) {
        $planes[$row['codigoPlan']] = [
            'cp' => $row['codigoPlan'],
            'vel' => $row['velocidad'],
            'nplan' => $row['nombrePlan'],
            'pplan' => $row['precioPlan'],
            'des' => $row['desPlan'],
            'estadop' => $row['estadoPlan'],
            'tplan' => $row['tipoPlan'],
        ];
    }
}

// Imágenes asociadas a cada plan
$imagenesPlanes = [
    1 => '20MEGAS.gif',
    2 => '50MEGAS.gif',
    3 => '70MEGAS.gif',
    4 => '120MEGAS.gif',
    5 => '5MEGAS.gif',
    6 => '150MEGAS.gif',
    7 => '10MEGAS.gif',
];
?>

<body>
<div class="container-scroller">
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">

                <!-- ===========================================
                     FORMULARIO DE CONTACTO
                     =========================================== -->
                <div class="col-md-6 col-sm-12 grid-margin stretch-card">
                    <div class="card" style="background: url('../assets/images/planes/fondoplanes.jpg') center / cover no-repeat; border-radius: 20px;">
                        <div class="card-body text-dark">
                            <h4 class="card-title text-center">Solicitar uno de nuestros Servicios</h4>
                            <p class="card-title text-center">Ingrese sus datos para ponernos en contacto</p>
                            <form class="forms-sample" method="POST" action="enviarplan.php">
                                <div class="form-group">
                                    <label for="nombre">Ingrese nombres y apellidos</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="tel">Ingrese número de teléfono</label>
                                    <input type="text" class="form-control" name="tel" id="tel" placeholder="Número de teléfono" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Ingrese correo electrónico</label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico" required>
                                </div>
                                <div class="text-center mt-3">
                                    <button type="submit" class="btn btn-primary">Enviar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- ===========================================
                     TARJETAS DE PLANES
                     =========================================== -->
                <?php foreach ($planes as $plan): ?>
                    <div class="col-md-6 col-sm-12 grid-margin stretch-card">
                        <div class="card" style="background: url('../assets/images/planes/fondoplanes.jpg') center / cover no-repeat; border-radius: 20px;">
                            <div class="card-body text-dark">
                                <h4 class="card-title text-dark" style="font-weight: bold; font-size: 25px;">
                                    <?php echo htmlspecialchars($plan['nplan']); ?>
                                </h4>
                                <?php if (isset($imagenesPlanes[$plan['cp']])): ?>
                                    <img src="../assets/images/planes/<?php echo $imagenesPlanes[$plan['cp']]; ?>" 
                                         alt="Imagen del plan <?php echo htmlspecialchars($plan['nplan']); ?>" 
                                         class="card-img-top" 
                                         style="border-radius: 20px 20px 0 0; width: 80%; height: auto; display: block; margin: 15px auto;">
                                <?php endif; ?>
                                <div class="plan-info mt-3">
                                    <p><strong>Tipo de plan:</strong> <?php echo htmlspecialchars($plan['tplan']); ?></p>
                                    <p><strong>Velocidad:</strong> <?php echo htmlspecialchars($plan['vel']); ?></p>
                                    <p><strong>Precio:</strong> <?php echo htmlspecialchars($plan['pplan']); ?></p>
                                    <p><?php echo htmlspecialchars($plan['des']); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div> <!-- row -->
        </div> <!-- content-wrapper -->
    </div> <!-- main-panel -->
</div> <!-- container-scroller -->

<!-- ======== Estilos Mobile ======== -->
<style>
@media (max-width: 768px) {
    .card-body h4.card-title { font-size: 20px; }
    .plan-info p { font-size: 14px; }
    .card-img-top { width: 100% !important; height: auto !important; }
}
</style>
</body>
</html>
