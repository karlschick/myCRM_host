    <!-- actualizado -->

    <?php
// Seguridad de sesiones (prueba 1)
session_start();
error_reporting(0);

// Verifica si el usuario tiene una sesión activa
$varsesion = $_SESSION['usuario'];
if (empty($varsesion)) {
    header("Location: ../index.php");
    die(); // No es necesario usar exit después de die()
}

// Incluye el encabezado de la página
include '../../includes/header.php';
?>

<body>

    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>
    <!-- Contenedor principal -->
  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <div class="page-header">
        <h1 style="font-size: 32px;">GESTIÓN FACTURAS</h1>
      </div>
      <div class="card">
        <div class="card-body">
          <a href="factcliente.php" class="btn btn-danger btn-lg" role="button" aria-pressed="true">Ingresar factura</a>
          <a href="fpagas.php" class="btn btn-primary active btn-lg" role="button" aria-pressed="true">Ver facturas pagas</a>
          <a href="consultarf.php" class="btn btn-primary active btn-lg" role="button" aria-pressed="true">Consultar facturas</a>
          <a href="../excel/excelFactura.php" class="btn btn-success btn-lg">Exportar tabla a Excel</a>
          <?php
            require_once __DIR__ . '/../../config/db.php';


          $sql = "SELECT cliente.idCliente,factura.cliente_idCliente,cliente.documentoCliente,cliente.nombreCliente,factura.idFactura,factura.valorTotalFactura,factura.estadoFactura,factura.fechaVencimiento,factura.nPlan FROM cliente 
                    INNER JOIN factura
                    ON cliente.idCliente=factura.cliente_idCliente
                    WHERE estadoFactura='Pendiente'
                    ORDER BY fechaVencimiento ASC;";

          echo '<div class="table-responsive">
            <table class="table table-hover">
            <thead>
        <tr>
        <th> Documento Cliente </th>
        <th> Nombre Cliente</th>
        <th> Fecha límite de pago</th>
        <th> Valor Total</th>
        <th> Estado factura</th>
        <th> Plan </th>
        <th> Consultas</th>
        <th> Pago</th>
    </tr>
    </thead>
    ';

          if ($rta = $con->query($sql)) {
            while ($row = $rta->fetch_assoc()) {
              $a = $row['idCliente'];
              $b = $row['cliente_idCliente'];
              $dc = $row['documentoCliente'];
              $nomc = $row['nombreCliente'];
              $idf=$row['idFactura'];
              $st = $row['valorTotalFactura'];
              $estf = $row['estadoFactura'];
              $ffact=$row['fechaVencimiento'];
              $nplan=$row['nPlan']


          ?>
              <tr>
                <td> <?php echo "$dc" ?></td>
                <td> <?php echo "$nomc" ?></td>
                <td> <?php echo "$ffact" ?></td>
                <td> <?php echo "$st" ?></td>
                <td> <?php echo "$estf" ?></td>
                <td> <?php echo "$nplan" ?></td>
                <th>
                  <a href="verfacturaAdmin.php?id=<?php echo  $row['idFactura'] ?>" class="btn btn-info">ver factura</a>

                <th><a href="eliminarf.php?id=<?php echo $row['idFactura']   ?>" class="borrar btn btn-danger">Pago</a></th>

              </tr>
          <?php
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</body>

</html>