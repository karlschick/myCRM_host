<?php
// Incluye el encabezado de la página
include '../../includes/header.php';
?>

<style>
  /* Ajusta la altura de las tarjetas para que se adapten al contenido */
  .card {
    height: auto !important;
  }

  /* Opcional: evita espacios excesivos verticales */
  .content-wrapper.full-page-wrapper {
    align-items: flex-start !important;
    padding-top: 40px;
    padding-bottom: 40px;
  }

  /* Centra el contenido sin estirar demasiado el fondo */
  .login-bg {
    min-height: 100vh;
  }
</style>

<body>
  <!-- Contenedor principal que maneja el scroll -->
  <div class="container-scroller">

    <!-- Contenedor de cuerpo de página completo -->
    <div class="container-fluid page-body-wrapper full-page-wrapper">

      <!-- Row que ocupa todo el ancho -->
      <div class="row w-100 m-0">

        <!-- Contenedor principal de contenido de la página -->
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">

          <!-- Tarjeta centrada -->
          <div class="card col-lg-10 mx-auto">
            <div class="card-body px-2 py-2">

              <!-- AGREGAMOS main-panel y content-wrapper internos para consistencia -->
              <div class="main-panel">
                <div class="content-wrapper">
                  <div class="text-center mb-4">
                    <h4 class="card-title">PETICIONES, QUEJAS, RECLAMOS Y SUGERENCIA  (PQR) </h4>
                  </div>
                  <div class="row justify-content-center">

                    <!-- ===========================================
                         Tarjeta del formulario de contacto
                         =========================================== -->
                    <div class="col-lg-10">
                      <div class="card">
                        <div class="card-body px-5 py-5">

                          <!-- Título centrado -->
                          <div class="text-center mb-4">
                            <p class="card-description">Ingrese sus datos para ponernos en contacto</p>
                          </div>

                          <!-- Formulario de contacto -->
                          <form class="forms-sample" action="enviarpqr.php" method="post">
                            <div class="container-fluid">

                              <!-- Tipo de documento -->
                              <div class="row mb-3">
                                <label for="td" class="col-md-4 col-form-label text-md-end">Tipo de documento:</label>
                                <div class="col-md-8">
                                  <select class="form-control" name="td" id="td" required>
                                    <option value="C.C">C.C</option>
                                    <option value="C.E">C.E</option>
                                    <option value="R.C">R.C</option>
                                    <option value="T.I">T.I</option>
                                  </select>
                                </div>
                              </div>

                              <!-- Número de documento -->
                              <div class="row mb-3">
                                <label for="id" class="col-md-4 col-form-label text-md-end">Documento:</label>
                                <div class="col-md-8">
                                  <input type="text" class="form-control" name="id" id="id" placeholder="Número de documento" required>
                                </div>
                              </div>

                              <!-- Nombre -->
                              <div class="row mb-3">
                                <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre:</label>
                                <div class="col-md-8">
                                  <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese nombre" required>
                                </div>
                              </div>

                              <!-- Teléfono -->
                              <div class="row mb-3">
                                <label for="tel" class="col-md-4 col-form-label text-md-end">Teléfono:</label>
                                <div class="col-md-8">
                                  <input type="text" class="form-control" name="tel" id="tel" placeholder="Número de teléfono" required>
                                </div>
                              </div>

                              <!-- Correo electrónico -->
                              <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">Correo:</label>
                                <div class="col-md-8">
                                  <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico" required>
                                </div>
                              </div>

                              <!-- Tipo de solicitud -->
                              <div class="row mb-3">
                                <label for="soli" class="col-md-4 col-form-label text-md-end">Tipo de solicitud:</label>
                                <div class="col-md-8">
                                  <select class="form-control" name="soli" id="soli">
                                    <option value="Solicitud">Solicitud</option>
                                    <option value="Peticion">Petición</option>
                                    <option value="Reclamo">Reclamo</option>
                                    <option value="Sugerencia">Sugerencia</option>
                                  </select>
                                </div>
                              </div>

                              <!-- Motivo de la solicitud -->
                              <div class="row mb-3">
                                <label for="dc" class="col-md-4 col-form-label text-md-end">Motivo:</label>
                                <div class="col-md-8">
                                  <textarea class="form-control" name="dc" id="dc" rows="4" placeholder="Describa su solicitud aquí..." required></textarea>
                                </div>
                              </div>

                              <!-- Botones -->
                              <div class="row mt-4 text-center">
                                <div class="col">
                                  <button id="submit" type="submit" class="btn btn-primary btn-lg">Enviar</button>
                                  <a href="../index.php" class="btn btn-secondary btn-lg">Volver al inicio</a>
                                </div>
                              </div>

                            </div> <!-- container-fluid -->
                          </form>

                        </div> <!-- card-body -->
                      </div> <!-- card -->
                    </div> <!-- col-lg-10 -->

                  </div> <!-- row justify-content-center -->
                </div> <!-- content-wrapper -->
              </div> <!-- main-panel -->

            </div> <!-- card-body px-2 py-3 -->
          </div> <!-- card col-lg-10 mx-auto -->

        </div> <!-- content-wrapper full-page-wrapper d-flex align-items-center auth login-bg -->

      </div> <!-- row w-100 m-0 -->
    </div> <!-- container-fluid page-body-wrapper full-page-wrapper -->
  </div> <!-- container-scroller -->
</body>
</html>
