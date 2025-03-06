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
              <div class="text-center">
                <h4 class="card-title">ESCRÍBENOS</h4>
                <p class="card-description">Ingrese sus datos</p>
              </div>

              <form class="forms-sample" action="enviarpqr.php" method="post">
                <div class="container-fluid">

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

                  <div class="row mb-3">
                    <label for="id" class="col-md-4 col-form-label text-md-end">Documento:</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="id" id="id" placeholder="Número de documento" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="nombre" class="col-md-4 col-form-label text-md-end">Nombre:</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese nombre" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="tel" class="col-md-4 col-form-label text-md-end">Teléfono:</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" name="tel" id="tel" placeholder="Número de teléfono" required>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="email" class="col-md-4 col-form-label text-md-end">Correo:</label>
                    <div class="col-md-8">
                      <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico" required>
                    </div>
                  </div>

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

                  <div class="row mb-3">
                    <label for="dc" class="col-md-4 col-form-label text-md-end">Motivo:</label>
                    <div class="col-md-8">
                      <textarea class="form-control" name="dc" id="dc" rows="4" placeholder="Describa su solicitud aquí..." required></textarea>
                    </div>
                  </div>

                  <div class="row mt-4 text-center">
                    <div class="col">
                      <button id="submit" type="submit" class="btn btn-primary btn-lg">Enviar</button>
                      <a href="../index.html" class="btn btn-secondary btn-lg">Volver al inicio</a>
                    </div>
                  </div>

                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
