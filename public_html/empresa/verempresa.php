

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
                        <h4 class="card-title">VER INFORMACIÓN DE LA EMPRESA</h4>
                        <form class="forms-sample">
                            <div class="form-group">
                            <label for="rz" style="font-weight: bold; font-size: 20px;">Razon social: <?php echo $row['rz'] ?></label>
                            </div>
                            <div class="form-group">
                                <label for="nombEmpresa" style="font-weight: bold; font-size: 16px;">Nombre de la empresa: <?php echo $row['nombEmpresa'] ?></label>
                            </div>
                            <div class="form-group">
                                <label for="nit" style="font-weight: bold; font-size: 16px;">NIT: <?php echo $row['nit'] ?></label>
                            </div>
                            <div class="form-group">
                                <label for="crc" style="font-weight: bold; font-size: 16px;">Registro CRC: <?php echo $row['crc'] ?></label>
                            </div>
                            <div class="form-group">
                                <label for="nombrepleg" style="font-weight: bold; font-size: 16px;">Nombre del representante legal: <?php echo $row['nombrepleg'] ?></label>
                            </div>
                            <div class="form-group">
                                <label for="docurepleg" style="font-weight: bold; font-size: 16px;">Nombre del representante legal: <?php echo $row['docurepleg'] ?></label>
                            </div>
                            <div class="form-group">
                                <label for="dirsede" style="font-weight: bold; font-size: 16px;">Direccion sede: <?php echo $row['dirsede'] ?></label>
                            </div>
                            <div class="form-group">
                                <label for="telsede" style="font-weight: bold; font-size: 16px;">Telefono: <?php echo $row['telsede'] ?></label>
                            </div>
                            <div class="form-group">
                                <label for="telsede2" style="font-weight: bold; font-size: 16px;">Telefono 2: <?php echo $row['telsede2'] ?></label>
                            </div>
                            <div class="form-group">
                                <label for="email" style="font-weight: bold; font-size: 16px;">Email: <?php echo $row['email'] ?></label>
                            </div>
                            <div class="form-group">
                                <label for="paginaWeb" style="font-weight: bold; font-size: 16px;">Pagina web: <?php echo $row['paginaWeb'] ?></label>
                            </div>
                            <div class="form-group">
                                <label for="fechaConstitucion" style="font-weight: bold; font-size: 16px;">Nombre del representante legal: <?php echo $row['fechaConstitucion'] ?></label>
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
                                <h4 class="form-text"> Numero de cuenta: <?php echo "$num_cuenta"?> </h4>
                                <h4 class="form-text"> Nombre del banco: <?php echo "$nomb_banco"?> </h4>
                                <h4 class="form-text"> Estado de cuenta: <?php echo "$estadoCuenta"?> </h4>
                            </div>
                            <?php

                                    }

                            }
                            
                            ?>
                            <div>
                                <br>
                                <button id="submit" type="submit" formmethod="post" formaction="../tablas.php" class="btn btn-danger"> Volver al inicio </button>
                                <button id="submit" type="submit" formmethod="post" formaction="ingresarBancos.php" class="btn btn-primary"> ingresar a bancos </button>
                                <button id="submit" type="submit" formmethod="post" formaction="actualizarEmpresa.php" class="btn btn-primary"> Actualizar información </button>

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