<?php
//seguridad de sesiones paginacion (prueba 1)
session_start();
error_reporting(0);
$varsesion = $_SESSION['usuario'];
if ($varsesion == null || $varsesion = '') {
    header("location:../index.html");
    die();
    exit;
}

// Incluye el encabezado de la página
include '../../includes/header.php';
?>
<body>
    <?php
    require_once __DIR__ . '/../../config/db.php';

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
                                <button id="submit" type="submit" formmethod="post" formaction="../dashboard/principal.php" class="btn btn-danger"> Volver al inicio </button>
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

</body>

</html>