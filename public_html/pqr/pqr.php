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
      <h1 style="font-size: 32px;">ATENCION AL CLIENTE</h1>
      <div class="card">
        <div class="card-body">


          <a href="../principal.php" class="btn btn-primary " role="button" aria-pressed="true">Volver al inicio</a>

          <a href="../excel/excelPQR.php" class="btn btn-success">Exportar tabla a Excel</a>
          <?php

          require_once __DIR__ . '/../../config/db.php';

          $sql = "SELECT * FROM pqr2 WHERE estadoPqr='Activo';";

          echo '<div class="table-responsive">
            <table class="table table-hover">
            <thead>
        <tr>
        <th> Id PQR </th>
        <th> Tipo de documento</th>
        <th> Numero de documento</th>
        <th> Nombres de cliente</th>
        <th> Tipo de PQR </th>
        <th> Consultar PQR</th>
        <th> Comentario</th>
        <th> Eliminar</th>
    </tr>
    </thead>
    ';

          if ($rta = $con->query($sql)) {
            while ($row = $rta->fetch_assoc()) {
              $i = $row['idPqr'];
              $td = $row['tipoDocumento'];
              $id = $row['nDocumento'];
              $nombres = $row['nombresCliente'];
              $tel = $row['telefonoCliente'];
              $email = $row['emailCliente'];
              $soli = $row['tPqr'];
              $dp = $row['desPqr'];
              $epqr = $row['estadoPqr'];
              $com = $row['comentario'];
          ?>
              <tr>
                <td> <?php echo "$i" ?></td>
                <td> <?php echo "$td" ?></td>
                <td> <?php echo "$id" ?></td>
                <td> <?php echo "$nombres" ?></td>
                <td> <?php echo "$soli" ?></td>

                <th><a href="consultarpqr.php?i=<?php echo $row['idPqr'] ?>" class="btn btn-primary">Consultar</a></th>
                <th><a href="comentario.php?i=<?php echo $row['idPqr'] ?>" class="btn btn-info">Agregar comentario </a></th>
                <th><a href="eliminarpqr.php?i=<?php echo $row['idPqr'] ?>" class="borrar btn btn-danger">Archivar contacto</a></th>

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