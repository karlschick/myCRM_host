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
  <!-- partial -->


  <div class="main-panel">

    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <h1 style="font-size: 32px;">GESTIÓN PQR</h1>
      <div class="card">
        <div class="card-body">
          <a href="../dashboard/principal.php" class="btn btn-primary " role="button" aria-pressed="true">Volver al inicio</a>

          <a href="../excel/excelPQR.php" class="btn btn-success">Exportar tabla a Excel</a>
          <?php

          require_once __DIR__ . '/../../config/db.php';
          $id = $_POST['id'];
          $sql = "SELECT * FROM pqr2
          WHERE nDocumento='$id';";

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

                <th><a href="pqrscliente.php?i=<?php echo $row['idPqr'] ?>" class="btn btn-primary">Consultar PQR </a></th>

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