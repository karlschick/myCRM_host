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
    <div class="content-wrapper"> 
      <div class="page-header">
        <h1 style="font-size: 32px;">GESTIÓN INVENTARIO</h1>
      </div>
      <div class="card">
        <div class="card-body">

                  <!-- 🔘 Botones principales -->
          <a href="inactivosinv.php" class="btn btn-danger btn-lg">Consutlar productos inactivos.</a>
          <a href="../excel/excelInventario.php" class="btn btn-success btn-lg">Exportar tabla a Excel</a>
          <a href="ingresarp.php" class="btn btn-info btn-lg">Ingresar nuevo producto</a>

          <?php

          require_once __DIR__ . '/../../config/db.php';

          $sql = "SELECT * FROM producto WHERE estadoProducto='Activo';";

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
                <th>
                  <a href="actinv.php?id=<?php echo $row['idProducto'] ?>" class="btn btn-primary"> Editar Producto </a>
                </th>


                <th><a href="elmproducto.php?id=<?php echo $row['idProducto'] ?>" class="borrar btn btn-danger">Eliminar</a></th>

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