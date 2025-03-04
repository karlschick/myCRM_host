<?php
header("Content-Disposition: attatchment; filename= Usuarios.xls");
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

?>
<?php
            include("../conexion.php");

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
                            <th>Clave</th>
                            <th>Estado</th>
                            <th>Fecha creación</th>
                            <th>Última Actual</th>
                            <th>Rol</th>
                            
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
                        <td> <?php echo $clave ?></td>
                        <td> <?php echo $estado ?></td>
                        <td> <?php echo $creacion ?></td>
                        <td> <?php echo $act ?></td>
                        <td> <?php echo $rol ?></td>
                        
                    </tr>

                    <?php
                }
            }
            ?>