<?php
include '../../includes/header.php';
require_once __DIR__ . '/../../config/db.php';

if (isset($_GET['id'])) {
    $idFactura = $_GET['id'];

    // Actualiza el estado de la factura a "Archivada"
    $sql = "UPDATE factura SET estadoFactura = 'Archivada' WHERE idFactura = '$idFactura'";

    if ($con->query($sql) === TRUE) {
        echo "<div style='text-align: center; margin-top: 50px;'>
                <h2>✅ Su factura ha sido pagada con éxito</h2>
                <p>Redirigiendo a la página principal...</p>
              </div>";
        // Redirige a index.php después de 3 segundos
        echo "<script>
                setTimeout(function() {
                    window.location.href = '../index.php';
                }, 3000);
              </script>";
    } else {
        echo "<div style='text-align: center; margin-top: 50px;'>
                <h2>❌ Error al procesar el pago</h2>
                <p>Por favor, intente nuevamente.</p>
              </div>";
    }
} else {
    echo "<div style='text-align: center; margin-top: 50px;'>
            <h2>❌ No se recibió una factura válida</h2>
          </div>";
}
?>
