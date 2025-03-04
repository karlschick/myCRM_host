

<!-- CODIGO HTML -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Atory - Admin</title>
    <!-- Estilos de los plugins -->
    <link rel="stylesheet" href="../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../assets/vendors/css/vendor.bundle.base.css">
    <!-- Fin de los estilos de los plugins -->
    <!-- Estilos del archivo actual -->
    <link rel="stylesheet" href="../assets/css/style.css">
    <!-- Fin de los estilos del archivo actual -->
    <link rel="shortcut icon" href="../assets/images/favicon.png">
</head>

<body>
    <?php
    include("conexion.php");

    $sql = "SELECT * FROM empresa WHERE id='1';";
    $query = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($query);

    ?>
    <!-- partial -->


    <div class="main-panel">
        <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">ACTUALIZAR EMPRESA</h4>
                        <p class="card-description"> Ingrese los datos siguientes datos</p>
                        <form class="forms-sample">
                            <div class="form-group">
                                <label for="rz">Razon social de la empresa</label>
                                <input type="text" class="form-control" name="rz" id="rz" placeholder="Razon social" value="<?php echo $row['rz']?>">
                            </div>

                            <div class="form-group">
                                <label for="nombEmpresa">Nombre de la empresa</label>
                                <input type="text" class="form-control" name="nombEmpresa" id="nombEmpresa" placeholder="Nombre empresa" value="<?php echo $row['nombEmpresa']?>">
                            </div>

                            <div class="form-group">
                                <label for="nit">NIT de la empresa</label>
                                <input type="text" class="form-control" name="nit" id="nit" placeholder="NIT" value="<?php echo $row['nit']?>">
                            </div>

                            <div class="form-group">
                                <label for="crc">Registro CRC</label>
                                <input type="text" class="form-control" name="crc" id="crc" placeholder="Registro CRC" value="<?php echo $row['crc']?>">
                            </div>

                            <div class="form-group">
                                <label for="nombrepleg">Nombre del representante legal</label>
                                <input type="text" class="form-control" name="nombrepleg" id="nombrepleg" placeholder="Representante Legal" value="<?php echo $row['nombrepleg']?>">
                            </div>

                            <div class="form-group">
                                <label for="docurepleg">Documento representante legal</label>
                                <input type="text" class="form-control" name="docurepleg" id="docurepleg" placeholder="docuemnto representante"value="<?php echo $row['docurepleg']?>">
                            </div>

                            <div class="form-group">
                                <label for="dirsede">Direccion sede</label>
                                <input type="text" class="form-control" name="dirsede" id="dirsede" placeholder="direccion"value="<?php echo $row['dirsede']?>">
                            </div>

                            <div class="form-group">
                                <label for="telsede">Ingrese telefono</label>
                                <input type="text" class="form-control" name="telsede" id="telsede" placeholder="telefono"value="<?php echo $row['telsede']?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="telsede2">Ingrese telefono dos</label>
                                <input type="text" class="form-control" name="telsede2" id="telsede2" placeholder="telefono 2"value="<?php echo $row['telsede2']?>">
                            </div>

                            <div class="form-group">
                                <label for="email">Ingrese correo electronico</label>
                                <input type="email" class="form-control" name="email" id="email" placeholder="Correo electronico"value="<?php echo $row['email']?>">
                            </div>

                            <div class="form-group">
                                <label for="paginaweb">Pagina Web</label>
                                <input type="text" class="form-control" name="paginaWeb" id="paginaWeb" placeholder="paginaWeb"value="<?php echo $row['paginaWeb']?>">
                            </div>

                            <div class="form-group">
                                <label for="fechaConstitucion">Fecha de Constitucion empresa</label>
                                <input type="date" class="form-control" name="fechaConstitucion" id="fechaConstitucion" placeholder="fechaConstitucion"value="<?php echo $row['fechaConstitucion']?>">
                            </div>
                            <?php 
                            $sql="SELECT * FROM bancario;";
                            $query=mysqli_query($con,$sql);
                            $row=mysqli_fetch_array($query);
                            if($rta = $con->query($sql)){
                                    while ($row = $rta->fetch_assoc()){
                                        $id_banco=$row['id_bancario'];
                                        $num_cuenta=$row['num_cuenta'];
                                        $nomb_banco=$row['nomb_banco'];
                                        $estadoCuenta=$row['estadoCuenta'];
                            ?>
                            <div class="form-group">
                                <h4 class="form-control"> Numero de cuenta: <?php echo "$num_cuenta"?> </h4>
                                <h4 class="form-control"> Nombre del banco: <?php echo "$nomb_banco"?> </h4>
                                <h4 class="form-control"> Estado de cuenta: <?php echo "$estadoCuenta"?> </h4>
                            </div>
                            <?php

                                    }

                            }
                            
                            ?>
                            <div>
                                <br>
                                <button id="submit" type="submit" formmethod="post" formaction="indatos.php" class="btn btn-primary">Guardar</button>
                                <button id="submit" type="submit" formmethod="post" formaction="../empresa/verempresa.php" class="btn btn-primary"> Volver al inicio </button>
                                <button id="submit" type="submit" formmethod="post" formaction="ingresarBancos.php" class="btn btn-primary"> ingresar a bancos </button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- ESTO ES LO QUE PODEMOS MODIFICAR -->
        </div>

    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="../assets/vendors/chart.js/Chart.min.js"></script>
    <script src="../assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="../assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="../assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../assets/js/off-canvas.js"></script>
    <script src="../assets/js/hoverable-collapse.js"></script>
    <script src="../assets/js/misc.js"></script>
    <script src="../assets/js/settings.js"></script>
    <script src="../assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="../assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
    <div class="jvectormap-tip"></div>
</body>

</html>