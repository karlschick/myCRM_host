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

  <?php
  require_once __DIR__ . '/../../config/db.php';
  $id = $_GET['id'];
  $sql = "SELECT * FROM cliente
  INNER JOIN plan
  WHERE plan.`idPlan`=cliente.`plan_idPlan`
  AND idCliente='$id';";

  if ($rta = $con->query($sql)) {
    while ($row = $rta->fetch_assoc()) {
      $idc = $row['idCliente'];
      $tdc = $row['tipoDocumento'];
      $docCliente = $row['documentoCliente'];
      $nomCliente = $row['nombreCliente'];
      $telCliente = $row['telefonoCliente'];
      $emailCliente = $row['correoCliente'];
      $dirCliente = $row['direccion'];
      $estado_cliente = $row['estadoCliente'];
      $plan_idPlan = $row['plan_idPlan'];
      $crearcliente = $row['creado'];
      $uacliente = $row['ultimaActualizacion'];
      $tipoplan = $row['tipoPlan'];
      $nombreplan = $row['nombrePlan'];
    }
  };

  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);
  ?>
  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title">NUEVA VISITA</h1>
            <h2 class="card-title">Información del cliente</h2>
            <h4 class="card-title">Nombre del cliente: <?php echo "$nomCliente" ?></h4>
            <form class="forms-sample">
              <div class="form-group">
                <h4 for="">Telefono Cliente: <?php echo "$telCliente" ?></h4>
              </div>
              <div class="form-group">
                <h4 for="">nombre del plan: <?php echo "$nombreplan" ?> del tipo: <?php echo "$tipoplan" ?></h4>
              </div>
              <div>
                <h1 class="card-tittle">Información de la visita</h1>
                <form action="insertarVisita.php" method="POST">
                  <input type="hidden" name="idCliente" value="<?php echo $row['idCliente']  ?>">
                  <label for="tipoVisita">Tipo de visita: </label>
                  <select class="form-control" name="tipoVisita" id="tipoVisita" placeholder="Tipo de visita">
                    <option value="Instalacion">Instalacion</option>
                    <option value="Desinstalacion">Desinstalacion</option>
                    <option value="Reparacion">Reparacion</option>
                  </select>

                  <p></p>
                  <label>Motivo de la visita</label>
                  <input type="text" class="form-control mb-3" name="motivoVisita" placeholder="Motivo de la visita">
                  <label>Dia de la visita</label>
                  <input type="date" class="form-control mb-3" name="diaVisita" placeholder="Dia de la visita">
                  <label for="">Estado de la visita</label>
                  <select class="form-control" name="estadoVisita" id="estadoVisita" placeholder="Estado de visita">
                    <option value="Activo">Activo</option>
                    <option value="Completado">Completado</option>
                    <option value="Archivado">Archivado</option>
                  </select>
                  <p></p>
                  <label for="">Tecnico asignado</label>
                  <select class="form-control" aria-label="Default select example" name="idTecnico" id="idTecnico" placeholder="Técnico asignado">

                    <?php
                    $sql = "SELECT * FROM usuario WHERE rol='Tecnico' and estadoUsuario='Activo';";
                    $query = mysqli_query($con, $sql);
                    $row = mysqli_fetch_array($query);
                    if ($rta = $con->query($sql)) {
                      while ($row = $rta->fetch_assoc()) {
                        $idUsuario = $row['idUsuario'];
                        $nombresUsuario = $row['nombresUsuario'];

                    ?>
                        <option value="<?php echo $idUsuario ?>"><?php echo "$nombresUsuario" ?> </option>

                    <?php
                      }
                    }
                    ?>
                    <input type="submit" class="btn btn-primary btn-block" value="Crear Visita" formmethod="post" formaction=../visitas/insertarVisita.php>
                    <input type="submit" class="btn btn-danger btn-block" value="Cancelar" formmethod="post" formaction=../visitas/tablasVisitas.php>
                </form>
              </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</body>

</html>