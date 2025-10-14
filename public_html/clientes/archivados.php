<?php
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if (empty($varsesion)) {
    header("Location: ../index.php");
    die();
}
include '../../includes/header.php';
include '../../includes/menu.php';
require_once __DIR__ . '/../../config/db.php';
?>

<div class="main-panel">
  <div class="content-wrapper">
    <div class="page-header">
      <h1 style="font-size: 32px;">CLIENTES ARCHIVADOS</h1>
    </div>

    <div class="card">
      <div class="card-body">
        <a href="tablas.php" class="btn btn-light btn-lg">Volver</a>
        <?php
        $sql = "SELECT cliente.tipoDocumento, cliente.documentoCliente, cliente.nombreCliente, plan.nombrePlan
                FROM cliente
                INNER JOIN plan ON cliente.plan_idPlan = plan.idPlan
                WHERE estadoCliente != 'Activo'
                ORDER BY nombreCliente ASC;";

        $rta = $con->query($sql);
        if (!$rta) {
            die("Error en la consulta: " . $con->error);
        }

        echo '<div class="table-responsive">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th>Tipo identificación</th>
                      <th>Número de documento</th>
                      <th>Nombres</th>
                      <th>Plan</th>
                      <th>Reactivar</th>
                    </tr>
                  </thead>';

        if ($rta->num_rows > 0) {
            while ($row = $rta->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['tipoDocumento']}</td>
                        <td>{$row['documentoCliente']}</td>
                        <td>{$row['nombreCliente']}</td>
                        <td>{$row['nombrePlan']}</td>
                        <td><a href='reactivar.php?id={$row['documentoCliente']}' class='btn btn-success'>Reactivar</a></td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No hay clientes archivados.</td></tr>";
        }

        echo "</table></div>";
        ?>
      </div>
    </div>
  </div>
</div>
