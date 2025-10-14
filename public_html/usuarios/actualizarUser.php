<!-- actualizado -->
<?php
// Seguridad de sesiones (prueba 1)
session_start();
error_reporting(0);

// Verifica si el usuario tiene una sesión activa
$varsesion = $_SESSION['usuario'];
if (empty($varsesion)) {
    header("Location: ../index.php");
    die();
}

// Incluye el encabezado de la página
include '../../includes/header.php';
?>

<body>
    <?php include '../../includes/menu.php'; ?>

    <?php
    require_once __DIR__ . '/../../config/db.php';
    $id = $_GET['id'];
    $sql = "SELECT * FROM usuario WHERE documentoUsuario='$id'";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);
    ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="card-body">
                <h1 style="font-size: 32px;">GESTIÓN DE USUARIOS</h1>
                <p class="card-description">Actualice los datos del Usuario</p>

                <!-- IMPORTANTE: enctype para poder subir archivos -->
                <form action="updateUser.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" value="<?php echo $row['idUsuario']; ?>">

                    <p class="card-description">Tipo de documento:</p>
                    <select class="form-select" name="td" id="td">
                        <option value="C.C" <?= $row['tipoDocumento'] == 'C.C' ? 'selected' : ''; ?>>C.C</option>
                        <option value="C.E" <?= $row['tipoDocumento'] == 'C.E' ? 'selected' : ''; ?>>C.E</option>
                        <option value="R.C" <?= $row['tipoDocumento'] == 'R.C' ? 'selected' : ''; ?>>R.C</option>
                        <option value="T.I" <?= $row['tipoDocumento'] == 'T.I' ? 'selected' : ''; ?>>T.I</option>
                    </select>

                    <p class="card-description">Documento usuario:</p>
                    <input type="text" class="form-control mb-3" name="docusuario" value="<?php echo $row['documentoUsuario']; ?>">

                    <p class="card-description">Nombre usuario:</p>
                    <input type="text" class="form-control mb-3" name="nombre" value="<?php echo $row['nombresUsuario']; ?>">

                    <p class="card-description">Teléfono usuario:</p>
                    <input type="text" class="form-control mb-3" name="tel" value="<?php echo $row['telefonoUsuario']; ?>">

                    <p class="card-description">Correo usuario:</p>
                    <input type="text" class="form-control mb-3" name="email" value="<?php echo $row['correoUsuario']; ?>">

                    <p class="card-description">Clave usuario (déjela en blanco si no desea cambiarla):</p>
                    <input type="password" class="form-control mb-3" name="clave" placeholder="Nueva clave (opcional)">

                    <p class="card-description">Estado usuario:</p>
                    <select class="form-select" name="estado" id="estado">
                        <option value="Activo" <?= $row['estadoUsuario'] == 'Activo' ? 'selected' : ''; ?>>Activo</option>
                        <option value="Inactivo" <?= $row['estadoUsuario'] == 'Inactivo' ? 'selected' : ''; ?>>Inactivo</option>
                    </select>

                    <p class="card-description">Fecha de creación:</p>
                    <input type="date" class="form-control mb-3" name="creacion" value="<?php echo $row['creado']; ?>">

                    <p class="card-description">Fecha de última actualización:</p>
                    <input type="date" class="form-control mb-3" name="act" value="<?php echo $row['ultimaActualizacion']; ?>">

                    <p class="card-description">Rol del usuario:</p>
                    <select class="form-select" name="rol" id="rol">
                        <option value="Administrador" <?= $row['rol'] == 'Administrador' ? 'selected' : ''; ?>>Administrador</option>
                        <option value="Tecnico" <?= $row['rol'] == 'Tecnico' ? 'selected' : ''; ?>>Técnico</option>
                    </select>

                    <br>
                    <!-- FOTO DE PERFIL -->
                    <p class="card-description">Foto actual:</p>
                    <div style="margin-bottom: 10px;">
                        <img src="../assets/images/faces-clipart/<?php echo $row['foto'] ?: 'pic-1.png'; ?>" 
                             alt="Foto de usuario" 
                             width="120" height="120" 
                             style="border-radius: 10px; border: 1px solid #ccc;">
                    </div>

                    <p class="card-description">Subir nueva foto (opcional):</p>
                    <input type="file" class="form-control mb-3" name="foto" accept="image/*">

                    <input type="submit" class="btn btn-primary btn-lg" value="Actualizar">
                    <input type="submit" class="btn btn-secondary btn-lg" value="Volver" formmethod="post" formaction="tablasUser.php">
                </form>
            </div>
        </div>
    </div>
</body>
</html>
