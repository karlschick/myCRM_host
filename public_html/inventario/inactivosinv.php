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

  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <h1 style="font-size: 32px;">GESTIÓN INVENTARIO</h1>
      <div class="card-body">
        <a href="tablasinventario.php" class="btn btn-primary " role="button" aria-pressed="true">Volver a activos</a>
        <a href="../excel/excelPQR.php" class="btn btn-success">Exportar tabla a Excel</a>
        <?php

        require_once __DIR__ . '/../../config/db.php';

        $sql = "SELECT * FROM producto WHERE estadoProducto='Inactivo';";

        echo '<div class="table-responsive">
            <table class="table table-hover">
            <thead>
        <tr>
        <th> Id Producto </th>
        <th> Nombre Producto</th>
        <th> Serial del producto</th>
        <th> Descripcion del producto</th>
        <th> Cantidad en bodega </th>
        <th> Editar producto</th>
        <th> Eliminar</th>
    </tr>
    </thead>
    ';

        if ($rta = $con->query($sql)) {
          while ($row = $rta->fetch_assoc()) {
            $id = $row['idProducto'];
            $nombrep = $row['nombreProducto'];
            $serial = $row['serialProducto'];
            $desp = $row['descripcionProducto'];
            $cantidad = $row['cantidad'];
            $estado = $row['estadoProducto'];
        ?>
            <tr>
              <td> <?php echo "$id" ?></td>
              <td> <?php echo "$nombrep" ?></td>
              <td> <?php echo "$serial" ?></td>
              <td> <?php echo "$desp" ?></td>
              <td> <?php echo "$cantidad" ?></td>
              </th>
              <th>
              <th><a href="activarp.php?id=<?php echo $row['idProducto'] ?>" class="btn btn-danger">Volver acttivar</a></th>
              </th>
            </tr>
        <?php
          }
        }

        ?>

      </div>
      <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">

        </div>
      </footer>

    </div>
  </div>

</body>

</html>