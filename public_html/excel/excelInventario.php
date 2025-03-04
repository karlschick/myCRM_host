<?php
header("Content-Disposition: attatchment; filename= Inventario.xls");
header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");

?>
<?php
            include("../conexion.php");

            $sql = "SELECT * FROM producto WHERE estadoProducto='Activo';";

        echo '<div class="table-responsive">
            <table class="table table-hover">
            <thead>
        <tr>
        <th> Id Producto </th>
        <th> Nombre Producto</th>
        <th> Serial del producto</th>
        <th> Descripcion del producto</th>
        <th> Cantidad en bodega </th>
        <th> Estado </th>
    </tr>
    </thead>
    ';

        if ($rta = $con->query($sql)) {
          while ($row = $rta->fetch_assoc()) {
            $id = $row['idProducto'];
            $nombrep = $row['nombreProducto'];
            $serial = $row['serialProducto'];
            $desp = $row['descripcionProducto'];
            $cantidad = $row['cantidad'];
            $estado=$row['estadoProducto'];
        ?>
            <tr>
              <td> <?php echo "$id" ?></td>
              <td> <?php echo "$nombrep" ?></td>
              <td> <?php echo "$serial" ?></td>
              <td> <?php echo "$desp" ?></td>
              <td> <?php echo "$cantidad" ?></td>
              <td> <?php echo "$estado" ?></td>
              <th>
               
            </tr>
        <?php
          }
        }

        ?>