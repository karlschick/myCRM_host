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
    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper">
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">GESTIÓN DE USUARIOS</h4>
                        <p class="card-description">Ingrese los datos del usuario</p>

                        <!-- IMPORTANTE: enctype para permitir carga de archivos -->
                        <form class="forms-sample" enctype="multipart/form-data">

                            <!-- Tipo de documento -->
                            <div class="form-group">
                                <label for="td">Seleccione tipo de documento</label>
                                <select class="form-control" name="td" id="td">
                                    <option value="C.C">C.C</option>
                                    <option value="C.E">C.E</option>
                                    <option value="R.C">R.C</option>
                                    <option value="T.I">T.I</option>
                                </select>
                            </div>

                            <!-- Documento -->
                            <div class="form-group">
                                <label for="id">Ingrese documento</label>
                                <input type="text" class="form-control" name="id" id="id" placeholder="Número de documento">
                            </div>

                            <!-- Nombres -->
                            <div class="form-group">
                                <label for="nombre">Ingrese nombres y apellidos</label>
                                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese nombre completo">
                            </div>

                            <!-- Teléfono -->
                            <div class="form-group">
                                <label for="tel">Ingrese número de teléfono</label>
                                <input type="text" class="form-control" name="tel" id="tel" placeholder="Número de teléfono">
                            </div>

                            <!-- Email -->
                            <div class="form-group">
                                <label for="email">Ingrese correo electrónico</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico">
                            </div>

                            <!-- Password -->
                            <div class="form-group">
                                <label for="clave">Ingrese contraseña</label>
                                <input type="password" class="form-control" name="clave" id="clave" placeholder="Password">
                            </div>

                            <!-- Imagen de usuario -->
                            <div class="form-group">
                                <label for="foto">Seleccione una foto de perfil (opcional)</label>
                                <input type="file" class="form-control" name="foto" id="foto" accept="image/*">
                                <small class="text-muted">Formatos permitidos: JPG, PNG, GIF. Tamaño máximo: 2MB.</small>
                            </div>

                            <!-- Estado -->
                            <div class="form-group">
                                <label for="estado">Seleccione el estado del usuario</label>
                                <select class="form-control" name="estado" id="estado">
                                    <option value="Activo">Activo</option>
                                    <option value="Archivado">Inactivo</option>
                                </select>
                            </div>

                            <!-- Fecha de creación -->
                            <div class="form-group">
                                <label for="creacion">Fecha de creación</label>
                                <input type="date" class="form-control" name="creacion" id="creacion">
                            </div>

                            <!-- Última actualización -->
                            <div class="form-group">
                                <label for="act">Fecha de última actualización</label>
                                <input type="date" class="form-control" name="act" id="act">
                            </div>

                            <!-- Rol -->
                            <div class="form-group">
                                <label for="rol">Seleccione tipo de usuario</label>
                                <select class="form-control" name="rol" id="rol">
                                    <option value="Administrador">Administrativo</option>
                                    <option value="Técnico">Técnico</option>
                                </select>
                            </div>

                            <div>
                                <br>
                                <button id="submit" type="submit" formmethod="post" formaction="insertarUser.php" class="btn btn-primary">Guardar</button>
                                <button type="submit" formmethod="post" formaction="tablasUser.php" class="btn btn-secondary">Volver al inicio</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
