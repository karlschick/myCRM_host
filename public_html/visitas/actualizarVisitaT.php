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
    <?php include '../../includes/menutec.php'; ?>
  
  <?php
    require_once __DIR__ . '/../../config/db.php';
  $id = $_GET['id'];
  $sql = "SELECT * FROM usuario
  INNER JOIN user_visita
  INNER JOIN visitas
  INNER JOIN cliente
  INNER JOIN plan
  WHERE usuario.`idUsuario`=user_visita.`user_idUser`
  AND user_visita.`visita_idVisita`=visitas.`idVisita`
  AND  cliente.`idCliente`=visitas.`visita_idCliente`
  AND cliente.`plan_idPlan`=plan.`idPlan`
  AND idVisita='$id';";

  if ($rta = $con->query($sql)) {
    while ($row = $rta->fetch_assoc()) {
      $idu = $row['idUsuario'];
      $tdu = $row['tipoDocumento'];
      $docu = $row['documentoUsuario'];
      $nombresu = $row['nombresUsuario'];
      $telu = $row['telefonoUsuario'];
      $emailu = $row['correoUsuario'];
      $estadou = $row['estadoUsuario'];
      $creadou = $row['creado'];
      $upu = $row['ultimaActualizacion'];
      $rolu = $row['rol'];
      $uservisita = $row['iduser_visita'];
      $visita_idvisita = $row['visita_idVisita'];
      $user_idUser = $row['user_idUser'];
      $idv = $row['idVisita'];
      $tipov = $row['tipoVisita'];
      $motivo = $row['motivoVisita'];
      $diaVisita = $row['diaVisita'];
      $eVisita = $row['estadoVisita'];
      $visitacliente = $row['visita_idCliente'];
      $comentario = $row['comentario'];
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
    }
  };

  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);
  ?>

</head>

<body>
  <?php
  include '../menu/menuint.php';
  ?>

  <!-- partial -->


  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <h1 class="card-title">GESTION DE VISITAS</h1>
            <h2 class="card-title">Información de la visita</h2>
            <h3>Numero de visita: <?php echo $row['idVisita']  ?></h3>
            <h4 class="card-title">Nombre del cliente: <?php echo "$nomCliente" ?></h4>
            <form class="forms-sample">
              <div class="form-group">
                <h4 for="">Telefono Cliente: <?php echo "$telCliente" ?></h4>
              </div>
              <form action="updateVisita.php" method="POST">

                <input type="hidden" name="idVisita" value="<?php echo $row['idVisita']  ?>">
                <input type="hidden" name="visita_idVisita" value="<?php echo $row['visita_idVisita']  ?>">
                <label for="tipoVisita">Tipo de visita: </label>
                <select class="form-control" name="tipoVisita" id="tipoVisita" value="<?php echo $row['tipoVisita']  ?>">
                  <option value="Instalacion">Instalacion</option>
                  <option value="Desinstalacion">Desinstalacion</option>
                  <option value="Reparacion">Reparacion</option>
                </select>

                <p></p>
                <label>Motivo de la visita</label>
                <input type="text" class="form-control mb-3" name="motivoVisita" placeholder="Motivo de la visita" value="<?php echo $row['motivoVisita']  ?>">
                <label>Dia de la visita</label>
                <input type="date" class="form-control mb-3" name="diaVisita" placeholder="Dia de la visita" value="<?php echo $row['diaVisita']  ?>">
                <label for="">Estado de la visita</label>
                <select class="form-control" name="estadoVisita" id="estadoVisita" value="<?php echo $row['estadoVisita']  ?>">
                  <option value="Activo">Activo</option>
                  <option value="Completado">Completado</option>
                  <option value="Archivado">Archivado</option>
                </select>
                <p></p>
                <label for="">Tecnico asignado</label>
                <select class="form-control" aria-label="Default select example" name="idTecnico" id="idTecnico" value="<?php echo $row['nombreTecnico']  ?>">

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
                </select>
                <p></p>
                <label>Comentario</label>
                <h5><?php echo "$comentario"  ?></h5>
                <p></p>





                <input type="submit" class="btn btn-primary btn-block" value="Actualizar" formmethod="post" formaction=../visitas/updateVisitaT.php>
                <input type="submit" class="btn btn-danger btn-block" value="Cancelar" formmethod="post" formaction=../visitas/eliminarVisitaT.php>
              </form>


          </div>
          <!-- ESTO ES LO QUE PODEMOS MODIFICAR -->
          <!-- partial:partials/_footer.html -->

          <!-- partial -->
        </div>
      </div>
    </div>

    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->


  </div>


</body>

</html>