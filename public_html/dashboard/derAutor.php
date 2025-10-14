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


    <!-- Contenedor principal -->
    <div class="main-panel">
        <div class="content-wrapper">

            <div class="row">
            <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h2 class="card-title text-center">Derechos de Autor de Skubox 2025</h2>
                            <p>Atory System es una marca registrada y está protegida bajo las leyes de propiedad intelectual y derechos de autor. 
                                Todo el contenido, incluyendo logotipos, nombres comerciales, imágenes, código fuente y documentación, es propiedad exclusiva de Atory System.</p>
                            
                            <h3>Protección Legal</h3>
                            <p>El uso no autorizado de cualquier elemento perteneciente a Atory System, ya sea total o parcialmente, sin el consentimiento expreso de la empresa, 
                                puede dar lugar a acciones legales conforme a la legislación vigente.</p>
                            
                            <h3>Uso Permitido</h3>
                            <ul>
                                <li>Uso de la marca bajo licencia otorgada por Atory System.</li>
                                <li>Distribución del software y documentación según los términos de uso establecidos.</li>
                                <li>Referencias a Atory System con fines informativos o educativos, respetando la integridad de la marca.</li>
                            </ul>
                            
                            <h3>Prohibiciones</h3>
                            <ul>
                                <li>Reproducción, distribución o modificación sin autorización.</li>
                                <li>Uso de la marca con fines comerciales sin licencia.</li>
                                <li>Intento de registrar cualquier elemento de Atory System como propio.</li>
                            </ul>
                            
                            <h3>Contacto Legal</h3>
                            <p>Si tienes dudas sobre el uso de la marca o necesitas obtener una licencia, puedes ponerte en contacto con nuestro equipo legal en <a href="mailto:legal@atory.com">skubox.it@gmail.com</a>.</p>
                        </div>
                    </div>
                    
                </div>

            </div>

        </div> 
            <footer class="footer">
                <div class="d-sm-flex justify-content-center justify-content-sm-between">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Derechos de autor © skubox 2025</span>
                    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                        <a href="derAutor.php" target="_blank">skubox.com</a>
                    </span>
                </div>
            </footer>
    </div> <!-- Fin de main-panel -->


</body>
</html>