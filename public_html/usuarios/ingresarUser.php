<?php
session_start();
error_reporting(0);

if (empty($_SESSION['usuario'])) {
    header("Location: ../index.php");
    die();
}

include '../../includes/header.php';
?>
<body>
<?php include '../../includes/menu.php'; ?>

<div class="main-panel">
    <div class="content-wrapper">
       <div class="page-header">
            <h1 style="font-size: 32px;">
                CREACION DE USUARIO
            </h1>
       </div>    

            <div class="card">
                             <p class="card-description text-center">Complete los datos del nuevo usuario</p>
                <div class="card-body">
                    <form class="forms-sample" enctype="multipart/form-data" method="POST" action="insertarUser.php">

                        <!-- FOTO -->
                        <div class="text-center mb-4">
                            <img id="preview" src="../../public_html/assets/images/faces-clipart/pic-1.png" alt="Foto usuario" class="rounded-circle" width="120" height="120">
                            <div class="form-group mt-2">
                                <input type="file" class="form-control" name="foto" id="foto" accept="image/*"
                                    onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
                                <small class="text-muted">Formatos permitidos: JPG, PNG, GIF. Máximo 2MB.</small>
                            </div>
                        </div>

                        <hr>

                        <!-- INFORMACIÓN PERSONAL -->
                        <h4 class="text-center mb-3 text-secondary">Información Personal</h4>
                        <div class="form-group">
                            <label for="td">Tipo de documento</label>
                            <select class="form-control" name="td" id="td">
                                <option value="C.C">C.C</option>
                                <option value="C.E">C.E</option>
                                <option value="R.C">R.C</option>
                                <option value="T.I">T.I</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id">Número de documento</label>
                            <input type="text" class="form-control" name="id" id="id" placeholder="Número de documento">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombres y apellidos</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre completo">
                        </div>
                        <div class="form-group">
                            <label for="fechaNacimiento">Fecha de nacimiento</label>
                            <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento">
                        </div>
                        <div class="form-group">
                            <label for="estadoCivil">Estado civil</label>
                            <select class="form-control" name="estadoCivil" id="estadoCivil">
                                <option value="Soltero">Soltero</option>
                                <option value="Casado">Casado</option>
                                <option value="Unión libre">Unión libre</option>
                                <option value="Divorciado">Divorciado</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="numeroHijos">Número de hijos</label>
                            <input type="number" class="form-control" name="numeroHijos" id="numeroHijos" min="0">
                        </div>

                        <hr>

                        <!-- CONTACTO -->
                        <h4 class="text-center mb-3 text-secondary">Contacto</h4>
                        <div class="form-group">
                            <label for="tel">Teléfono principal</label>
                            <input type="text" class="form-control" name="tel" id="tel">
                        </div>
                        <div class="form-group">
                            <label for="telefonoUsuario_dos">Teléfono alternativo</label>
                            <input type="text" class="form-control" name="telefonoUsuario_dos" id="telefonoUsuario_dos">
                        </div>
                        <div class="form-group">
                            <label for="correoUsuario">Correo electrónico</label>
                            <input type="email" class="form-control" name="email" id="correoUsuario">
                        </div>
                        <div class="form-group">
                            <label for="direccionUsuario">Dirección</label>
                            <input type="text" class="form-control" name="direccionUsuario" id="direccionUsuario">
                        </div>
                        <div class="form-group">
                            <label for="ciudadUsuario">Ciudad</label>
                            <input type="text" class="form-control" name="ciudadUsuario" id="ciudadUsuario">
                        </div>
                        <div class="form-group">
                            <label for="departamentoUsuario">Departamento</label>
                            <input type="text" class="form-control" name="departamentoUsuario" id="departamentoUsuario">
                        </div>
                        <div class="form-group">
                            <label for="paisUsuario">País</label>
                            <input type="text" class="form-control" name="paisUsuario" id="paisUsuario" value="Colombia">
                        </div>

                        <hr>

                        <!-- INFORMACIÓN LABORAL -->
                        <h4 class="text-center mb-3 text-secondary">Información Laboral</h4>
                        <div class="form-group">
                            <label for="cargo">Cargo</label>
                            <input type="text" class="form-control" name="cargo" id="cargo">
                        </div>
                        <div class="form-group">
                            <label for="area">Área</label>
                            <input type="text" class="form-control" name="area" id="area">
                        </div>
                        <div class="form-group">
                            <label for="fechaIngreso">Fecha de ingreso</label>
                            <input type="date" class="form-control" name="fechaIngreso" id="fechaIngreso">
                        </div>
                        <div class="form-group">
                            <label for="tipoContrato">Tipo de contrato</label>
                            <select class="form-control" name="tipoContrato" id="tipoContrato">
                                <option value="Fijo">Fijo</option>
                                <option value="Indefinido">Indefinido</option>
                                <option value="Temporal">Temporal</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="salarioBase">Salario base</label>
                            <input type="number" class="form-control" name="salarioBase" id="salarioBase">
                        </div>
                        <div class="form-group">
                            <label for="eps">EPS</label>
                            <input type="text" class="form-control" name="eps" id="eps" value="Sanitas">
                        </div>
                        <div class="form-group">
                            <label for="arl">ARL</label>
                            <input type="text" class="form-control" name="arl" id="arl">
                        </div>
                        <div class="form-group">
                            <label for="fondoPension">Fondo de pensión</label>
                            <input type="text" class="form-control" name="fondoPension" id="fondoPension">
                        </div>

                        <hr>

                        <!-- USUARIO Y ACCESO -->
                        <h4 class="text-center mb-3 text-secondary">Datos de Acceso</h4>

                        <div class="form-group">
                            <label for="user_usuario">Usuario de acceso (login)</label>
                            <input type="text" class="form-control" name="user_usuario" id="user_usuario" placeholder="Ej: jlopez o juan.perez">
                        </div>

                        <div class="form-group">
                            <label for="rol">Rol del usuario</label>
                            <select class="form-control" name="rol" id="rol">
                                <option value="Administrador">Administrativo</option>
                                <option value="Técnico">Técnico</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="clave">Contraseña</label>
                            <input type="password" class="form-control" name="clave" id="clave" placeholder="********">
                        </div>
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select class="form-control" name="estado" id="estado">
                                <option value="Activo">Activo</option>
                                <option value="Inactivo">Inactivo</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="creacion">Fecha de creación</label>
                            <input type="date" class="form-control" name="creacion" id="creacion">
                        </div>
                        <div class="form-group">
                            <label for="act">Última actualización</label>
                            <input type="date" class="form-control" name="act" id="act">
                        </div>
                        <hr>
                            <a href="tablasUser.php" class="btn btn-secondary">← Volver a la lista</a>
                            <button type="submit" class="btn btn-primary me-2">Guardar usuario</button>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
