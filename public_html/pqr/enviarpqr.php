    <!-- actualizado -->

    <?php
// Incluye el encabezado de la página
include '../../includes/header.php';
?>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
          <div class="card col-lg-10 mx-auto">
            <div class="card-body px-5 py-5">
              <div class="content-wrapper">
                <div class="page-header">
                  <div class="mx-auto text-center" style="width: fit-content;">
                    <h1 class="card-title text-left mb-3" style="font-size: 32px;">SOLICITUD ENVIADA CORRECTAMENTE</h1>
                  </div>
                </div>

                <div class="row justify-content-center">
                  <div class="col-10 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        <?php 
                        require_once __DIR__ . '/../../config/db.php';

                        // Recibir datos del formulario y sanitizarlos
                        $td = mysqli_real_escape_string($con, $_POST["td"]);
                        $id = mysqli_real_escape_string($con, $_POST["id"]);
                        $nombre = mysqli_real_escape_string($con, $_POST["nombre"]);
                        $tel = mysqli_real_escape_string($con, $_POST["tel"]);
                        $email = mysqli_real_escape_string($con, $_POST["email"]);
                        $soli = mysqli_real_escape_string($con, $_POST["soli"]);
                        $dc = mysqli_real_escape_string($con, $_POST["dc"]);

                        // Consulta SQL
                        $sql = "INSERT INTO pqr2 (tipoDocumento, nDocumento, nombresCliente, telefonoCliente, emailCliente, tPqr, desPqr)
                                VALUES ('$td','$id','$nombre','$tel','$email','$soli','$dc')";

                        if ($con->query($sql) === TRUE) {
                            $mensaje = "Solicitud enviada satisfactoriamente.";
                        } else {
                            $mensaje = "Error al guardar los datos: " . $con->error;
                        }

                        // Cerrar conexión
                        $con->close();
                        ?>

                        <h3 class="text-center"><?php echo $mensaje; ?></h3>
                        <h4 class="mt-4">Muchas gracias por escribirnos, <strong><?php echo htmlspecialchars($nombre); ?></strong>.</h4>
                        <p class="mt-3">Su solicitud tipo <strong><?php echo htmlspecialchars($soli); ?></strong> fue enviada satisfactoriamente.</p>
                        <p>Nuestro equipo se contactará con usted a <strong><?php echo htmlspecialchars($tel); ?></strong> o <strong><?php echo htmlspecialchars($email); ?></strong>.</p>
                        <p>Tenga un feliz día.</p>

                        <div class="form-button text-center mt-5">
                          <a href="../index.php" class="btn btn-primary btn-lg">Volver al inicio</a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> <!-- Fin row justify-content-center -->
              </div> <!-- Fin content-wrapper -->
            </div> <!-- Fin card-body -->
          </div> <!-- Fin card -->
        </div> <!-- Fin content-wrapper full-page-wrapper -->
      </div> <!-- Fin row w-100 -->
    </div> <!-- Fin container-fluid -->
  </div> <!-- Fin container-scroller -->
</body>
</html>
