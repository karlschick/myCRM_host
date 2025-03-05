    <!-- actualizado -->

    <?php
// Seguridad de sesiones (prueba 1)
session_start();
error_reporting(0);

// Verifica si el usuario tiene una sesión activa
$varsesion = $_SESSION['usuario'];
if (empty($varsesion)) {
    header("Location: ../index.php");
    die(); // No es necesario usar exit después de die()
}

// Incluye el encabezado de la página
include '../../includes/header.php';
?>

<body>
    <!-- Incluye el menú de navegación -->
    <?php include '../../includes/menu.php'; ?>

    <div class="main-panel">
        <div class="content-wrapper"> <!-- ESTO ES LO QUE TENEMOS QUE MODIFICAR -->

            <h1 style="font-size: 32px;">GESTIÓN INVENTARIO</h1>
            <div class="col-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">

                        <p class="card-description"> Ingrese los datos del nuevo producto </p>
                        <form class="forms-sample">

                            <div class="form-group">
                                <label for="nombrep">Ingrese nombre del producto</label>
                                <input type="text" class="form-control" name="nombrep" id="nombrep" placeholder="Nombre del Producto">
                            </div>

                            <!--valor de nombres y apellidos-->
                            <div class="form-group">
                                <label for="serial">Serial Del producto</label>
                                <input type="text" class="form-control" name="serial" id="serial" placeholder="Ingrese serial del producto">
                            </div>


                            <!--valor de numero de telefono-->
                            <div class="form-group">
                                <label for="desp">Descripción del producto</label>
                                <input type="text" class="form-control" name="desp" id="desp" placeholder="Ingrese descripción del producto">
                            </div>

                            <!--valor de email-->
                            <div class="form-group">
                                <label for="cantidad">Cantidad ue se tiene</label>
                                <input type="number" class="form-control" name="cantidad" id="cantidad" placeholder="Cantidad que se tiene">
                            </div>

                            <div>
                                <br>
                                <button id="submit" type="submit" formmethod="post" formaction="inp.php" class="btn btn-primary">Guardar</button>
                                <button id="submit" type="submit" formmethod="post" formaction="tablasinventario.php" class="btn btn-primary"> Volver al inicio </button>

                            </div>
                        </form>


                    </div>
                </div>


            </div>

        </div>
        <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Atory Solution 2023</span>
                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> <a href=" " target="_blank"></a> </span>
            </div>
        </footer>

    </div>



    </div>

</body>

</html>