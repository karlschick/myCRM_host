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

  <style type="text/css">
    /* Chart.js */
    @keyframes chartjs-render-animation {
      from {
        opacity: .99
      }

      to {
        opacity: 1
      }
    }

    .chartjs-render-monitor {
      animation: chartjs-render-animation 1ms
    }

    .chartjs-size-monitor,
    .chartjs-size-monitor-expand,
    .chartjs-size-monitor-shrink {
      position: absolute;
      direction: ltr;
      left: 0;
      top: 0;
      right: 0;
      bottom: 0;
      overflow: hidden;
      pointer-events: none;
      visibility: hidden;
      z-index: -1
    }

    .chartjs-size-monitor-expand>div {
      position: absolute;
      width: 1000000px;
      height: 1000000px;
      left: 0;
      top: 0
    }

    .chartjs-size-monitor-shrink>div {
      position: absolute;
      width: 200%;
      height: 200%;
      left: 0;
      top: 0
    }
  </style>
</head>

<body>
    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>

  <div class="main-panel">

    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <h1 style="font-size: 32px;">OBSERVACIONES</h1>
      <div class="card ">
        <div class="card-body">


          <a href="../principal.php" class="btn btn-primary btn-lg " role="button" aria-pressed="true">Volver al inicio</a>

          <a href="../excel/excelPQR.php" class="btn btn-success btn-lg">Exportar tabla a Excel</a>
          <?php

          require_once __DIR__ . '/../../config/db.php';

          $sql = "SELECT * FROM pqr2 WHERE estadoPqr='Activo';";

          echo '<div class="table-responsive">
            <table class="table table-hover">
            <thead>
        <tr>
        <th> Id </th>
        <th> Tipo de documento</th>
        <th> Numero de documento</th>
        <th> Nombres de cliente</th>
        <th> Tipo </th>
        <th> Consultar </th>
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

                <th><a href="consultarpqr.php?i=<?php echo $row['idPqr'] ?>" class="btn btn-primary">Observacion </a></th>
                <th><a href="comentario.php?i=<?php echo $row['idPqr'] ?>" class="btn btn-info">Agregar comentario </a></th>
                <th><a href="eliminarpqr.php?i=<?php echo $row['idPqr'] ?>" class="borrar btn btn-danger">Eliminar</a></th>

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