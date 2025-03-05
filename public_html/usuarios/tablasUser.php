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

    <!-- partial -->


    <div class="main-panel">
        <div class="content-wrapper">
            <div class="page-header">
                <h1 style="font-size: 32px;">GESTIÓN USUARIOS</h1>

            </div>
            <div class="card">
                <div class="card-body">
                    <a href="ingresarUser.php" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Crear nuevo usuario</a>
                    <a href="usuarios.php" class="btn btn-primary btn-lg" role="button" aria-pressed="true">Consultar usuario</a>

                    <a href="../excel/excelUsuario.php" class="btn btn-success btn-lg">Exportar tabla a Excel</a>
                    <?php
                    require_once __DIR__ . '/../../config/db.php';


                    $sql = "SELECT * FROM usuario WHERE estadoUsuario='Activo';";

                    echo '<div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Tipo ide</th>
                            <th>Núm doc</th>
                            <th>Nombres</th>
                            <th>Teléfono</th>
                            <th>Email</th>
                            
                            <th>Estado</th>
                            <th>Fecha creación</th>
                            <th>Última Actual</th>
                            <th>Rol</th>
                            <th>Actualizar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>';

                    if ($rta = $con->query($sql)) {
                        while ($row = $rta->fetch_assoc()) {
                            $td = $row['tipoDocumento'];
                            $id = $row['documentoUsuario'];
                            $nombres = $row['nombresUsuario'];
                            $telefono = $row['telefonoUsuario'];
                            $email = $row['correoUsuario'];
                            $clave = $row['claveUsuario'];
                            $estado = $row['estadoUsuario'];
                            $creacion = $row['creado'];
                            $act = $row['ultimaActualizacion'];
                            $rol = $row['rol'];
                    ?>
                            <tr>

                                <td> <?php echo $td ?></td>
                                <td> <?php echo $id ?></td>
                                <td> <?php echo $nombres ?></td>
                                <td> <?php echo $telefono ?></td>
                                <td> <?php echo $email ?></td>

                                <td> <?php echo $estado ?></td>
                                <td> <?php echo $creacion ?></td>
                                <td> <?php echo $act ?></td>
                                <td> <?php echo $rol ?></td>
                                <td>
                                    <a href="actualizarUser.php?id=<?php echo $row['documentoUsuario'] ?>" class="btn btn-info">Editar</a>
                                </td>
                                <td>
                                    <a href="deleteUsuario.php?id=<?php echo $row['documentoUsuario']  ?> " class="borrar btn btn-danger">Eliminar</a>
                                </td>
                            </tr>

                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    </div>

    </div>

    </div>


</body>

</html>