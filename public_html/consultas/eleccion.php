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
                        <div class="card-body px-2 py-3">
                            <div class="content-wrapper">
                                <div class="page-header">
                                    <!-- Centramos y organizamos el título -->
                                    <div class="mx-auto text-center" style="width: fit-content;">
                                        <img class="logo mb-2" src="../assets/images/empresa/logoEmpresa.png"
                                            alt="logo" style="max-width: 40%; height: auto;" class="img-responsive" />
                                        <h1 class="card-title mb-4 text-center" style="font-size: 32px; font-weight: 700;">
                                            CONSULTAS COMUNES
                                        </h1>
                                    </div>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-20 grid-margin stretch-card">
                                        <div class="card">
                                            <!-- CONTENIDO -->
                                            <div class="card-body text-center">
                                                <p style="font-size: 18px;">Estimado cliente, seleccione qué quiere consultar</p>
                                                <div class="form-group"></div>

                                                <!-- BOTONES -->
                                                <div class="row justify-content-center">
                                                    <div class="col-md-3 col-sm-6 mb-3">
                                                        <div class="d-flex flex-column align-items-center border p-3">
                                                            <a href="../facturacion/consultarfC.php"
                                                                class="btn btn-lg btn-info w-100 d-flex align-items-center justify-content-center gap-2 btn-animated">
                                                                <i class="bi bi-receipt-cutoff fs-4"></i>
                                                                Consulta Factura
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-sm-6 mb-3">
                                                        <div class="d-flex flex-column align-items-center border p-3">
                                                            <a href="../consultas/consultavisitasCli.php"
                                                                class="btn btn-lg btn-primary w-100 d-flex align-items-center justify-content-center gap-2 btn-animated">
                                                                <i class="bi bi-calendar-check fs-4"></i>
                                                                Consulta Visitas
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3 col-sm-6 mb-3">
                                                    <div class="d-flex flex-column align-items-center border p-3 w-100">
                                                        <a href="../index.php"
                                                        class="btn btn-lg btn-danger w-100 d-flex align-items-center justify-content-center gap-2 btn-animated text-nowrap">
                                                            <i class="bi bi-house-door fs-4"></i>
                                                            Regresar al inicio
                                                        </a>
                                                    </div>
                                                    </div>

                                                </div>
                                                <!-- FIN BOTONES -->
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ESTILOS PERSONALIZADOS -->
    <style>
        /* Todos los botones iguales */
        .btn {
            height: 65px;
            font-size: 18px;
            font-weight: 600;
            transition: all 0.3s ease;
            border-radius: 10px;
        }

        /* Íconos medianos */
        .btn i {
            font-size: 22px;
        }

        /* Animación hover */
        .btn-animated:hover {
            transform: scale(1.05);
            opacity: 0.9;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
        }

        /* Fade suave al cargar */
        .card {
            animation: fadeIn 0.9s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(8px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Bootstrap Icons (si no las tienes ya) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

</body>
</html>
