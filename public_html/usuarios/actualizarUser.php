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
  $sql = "SELECT * FROM usuario WHERE documentoUsuario='$id'";
  $query = mysqli_query($con, $sql);
  $row = mysqli_fetch_array($query);
  ?>
  <div class="main-panel">
    <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
      <div class="card-body">
        <h1 style="font-size: 32px;">GESTIÓN DE USUARIOS</h1>
        <p class="card-description"> Ingrese los datos del Usuario</p>
        <form action="update.php" method="POST">

          <input type="hidden" name="id" value="<?php echo $row['idUsuario']  ?>">
          <p class="card-description"> Tipo de documento: </p>
          <select class="form-select" aria-label="Default select example" name="td" id="td" value="<?php echo $row['tipoDocumento']  ?>">
            <option value="C.C">C.C</option>
            <option value="C.E">C.E</option>
            <option value="R.C">R.C</option>
            <option value="T.I">T.I</option>
          </select>
          <p></p>
          <p class="card-description"> Documento usuario: </p>
          <input type="text" class="form-control mb-3" name="docusuario" placeholder="Numero documento" value="<?php echo $row['documentoUsuario']  ?>">
          <p class="card-description"> Nombre usuario: </p>
          <input type="text" class="form-control mb-3" name="nombre" placeholder="Nombres Completos" value="<?php echo $row['nombresUsuario']  ?>">
          <p class="card-description"> Telefono usuario: </p>
          <input type="text" class="form-control mb-3" name="tel" placeholder="Ingrese telefono" value="<?php echo $row['telefonoUsuario']  ?>">
          <p class="card-description"> Correo usuario: </p>
          <input type="text" class="form-control mb-3" name="email" placeholder="Ingrese correo electronico" value="<?php echo $row['correoUsuario']  ?>">
          <p class="card-description"> Clave usuario: </p>
          <input type="password" class="form-control mb-3" name="clave" placeholder="clave" value="<?php echo $row['claveUsuario']  ?>">
          <p class="card-description"> Estado usuario: </p>
          <select class="form-select" aria-label="Default select example" name="estado" id="estado" value="<?php echo $row['estadoUsuario']  ?>">
            <option value="Activo">Activo </option>
            <option value="Inactivo">Inactivo</option>
            <p></p>
          </select>
          <p class="card-description"> Fecha de creacion: </p>
          <input type="date" class="form-control mb-3" name="creacion" placeholder="fecha de creacion" value="<?php echo $row['creado']  ?>">
          <p class="card-description"> Fecha de ultima actualizacion: </p>
          <input type="date" class="form-control mb-3" name="act" placeholder="ultima actualizacion" value="<?php echo $row['ultimaActualizacion']  ?>">
          <select class="form-select" aria-label="Default select example" name="rol" id="rol" value="<?php echo $row['rol']  ?>">
            <option value="Administrador">Administrador </option>
            <option value="Tecnico">Tecnico</option>


          </select>
          <p></p>
          <input type="submit" class="btn btn-primary btn-lg" value="Actualizar" formmethod="post" formaction=updateUser.php>
          <input type="submit" class="btn btn-primary btn-lg" value="Volver" formmethod="post" formaction=tablasUser.php>
        </form>

        <div class="row">
          <div>
            <div>

            </div>
          </div>

        </div>




      </div>
      <!-- ESTO ES LO QUE PODEMOS MODIFICAR -->

    </div>

    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->


  </div>


</body>

</html>