<?php
header("Content-Disposition: attatchment; filename= Visitas.xls");
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

?>
<?php
include("../conexion.php");

$sql = "SELECT * FROM visitas";

echo '<div class="table-responsive">
            <table class="table table-hover">
            <thead>
        <tr>
        <th> id Visita</th>
        <th> Documento Cliente</th>
        <th> Nombre Cliente</th>
        <th> Telefono Cliente</th>
        <th> Correo Cliente</th>
        <th> Direccion Cliente</th>
        <th> Documento Tecnico </th>
        <th> Nombre Tecnico </th>
        <th> Telefono Tecnico </th>
        <th> Correo Tecnico </th>
        <th> Motivo de visita </th>
        <th> Dia de la visita </th>
        <th> Estado de la visita </th>
        </tr>
            </thead>
    ';

if ($rta = $con->query($sql)) {
    while ($row = $rta->fetch_assoc()) {
        $id = $row['idVisita'];
        $docCliente = $row['documentoCliente'];
        $nomCliente = $row['nombreCliente'];
        $telCliente = $row['telefonoCliente'];
        $emailCliente = $row['emailCliente'];
        $dirCliente = $row['direccionCliente'];
        $docTecnico = $row['documentoTecnico'];
        $nomTec = $row['nombreTecnico'];
        $telTec = $row['telefonoTecnico'];
        $emailTec = $row['emailTecnico'];
        $motivo = $row['motivoVisita'];
        $diaVisita = $row['diaVisita'];
        $eVisita = $row['estadoVisita'];
?>
        <tr>
            <td> <?php echo "$id" ?></td>
            <td> <?php echo "$docCliente" ?></td>
            <td> <?php echo "$nomCliente" ?></td>
            <td> <?php echo "$telCliente" ?></td>
            <td> <?php echo "$emailCliente" ?></td>
            <td> <?php echo "$dirCliente" ?></td>
            <td> <?php echo "$docTecnico" ?></td>
            <td> <?php echo "$nomTec" ?></td>
            <td> <?php echo "$telTec" ?></td>
            <td> <?php echo "$emailTec" ?></td>
            <td> <?php echo "$motivo" ?></td>
            <td> <?php echo "$diaVisita" ?></td>
            <td> <?php echo "$eVisita" ?></td>

            
            </th>
        </tr>
<?php
    }
}

?>