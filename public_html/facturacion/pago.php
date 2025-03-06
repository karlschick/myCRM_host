<?php
include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';

if (isset($_GET['id'])) {
    $idFactura = $_GET['id'];
} else {
    echo "<div style='text-align: center; margin-top: 50px;'>
            <h2>❌ No se recibió una factura válida</h2>
          </div>";
    exit;
}
?>

<head>

    <title>Pago PSE</title>
    <style>
        body {
            text-align: center;
            font-family: Arial, sans-serif;
            margin-top: 50px;
        }
        .pse-logo {
            width: 300px; /* Ajusta el tamaño según tu imagen */
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h2>Haga clic en el logo para pagar con PSE</h2>

    <!-- Imagen del logo de PSE -->
    <img src="../assets/images/empresa/logo-pse.png" alt="Pagar con PSE" class="pse-logo" onclick="procesarPago()">

    <script>
        function procesarPago() {
            // Simulación del pago: Redirige al servidor para actualizar el estado
            window.location.href = "procesar_pago.php?id=<?php echo $idFactura; ?>";
        }
    </script>

</body>
</html>

