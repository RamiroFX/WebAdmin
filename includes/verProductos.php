<?php require_once("../Connections/conex.php");  ?>
<?php
if (!function_exists("GetSQLValueString")) {

    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {

        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripcslashes($theValue) : $theValue;
        }
        global $conex;
        $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conex, $theValue) : mysqli_escape_string($conex, $theValue);
        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }

}
$SQL = "SELECT * FROM PRODUCTO ORDER BY DESCRIPCION ASC";
$productos = mysqli_query($conex, $SQL) or die(mysqli_error($conex));
$row_productos = mysqli_fetch_assoc($productos);
$total_row_productos = mysqli_num_rows($productos);

$SQL_CATEGORIA = "SELECT * FROM PRODUCTO_CATEGORIA ORDER BY ID_PRODUCTO_CATEGORIA ASC";
$productos_CATEGORIA = mysqli_query($conex, $SQL_CATEGORIA) or die(mysqli_error($conex));
$row_CATEGORIA = mysqli_fetch_assoc($productos_CATEGORIA);
$total_row_CATEGORIA = mysqli_num_rows($productos_CATEGORIA);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                Listado de productos
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Stock</th>
                            <th>Precio</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?PHP do { ?>
                            <tr class="odd gradeX">
                                <td> <?php echo $row_productos['descripcion']; ?> </td>
                                <td> <?php echo $row_productos['cant_actual']; ?> </td>
                                <td><form action="actualizarPrecio.php" method="post">
                                        <input name="precio" type="text" size="5" value="<?php echo $row_productos['precio_minorista']; ?>" >
                                        <button type="submit"><i class="fa fa-refresh"></i></button>
                                        <input name="id_producto"type="hidden" value="<?php echo $row_productos['id_producto']; ?>">
                                        <input name="actualiza"type="hidden" value="2">
                                    </form></td>
                                <td> <?php echo $row_productos['categoria']; ?> </td>
                                <td class="center">
                                    <?php if ($row_productos['id_producto_estado'] == 1) { ?>
                                        <form action="actualizarEstado.php" method="post">
                                            <button type="submit" class="btn btn-success"><?php obtenerEstado($row_productos['id_producto_estado']); ?></button>
                                            <input name="id_producto" type="hidden" value="<?php echo $row_productos['id_producto']; ?>">
                                            <input name="actualiza" type="hidden" value="1">
                                            <input name="id_producto_estado" type="hidden" value="2">
                                        </form>
                                    <?php } ?>
                                    <?php if ($row_productos['id_producto_estado'] == 2) { ?>
                                        <form action="actualizarEstado.php" method="post">
                                            <button type="submit" class="btn btn-danger"><?php obtenerEstado($row_productos['id_producto_estado']); ?></button>
                                            <input name="id_producto" type="hidden" value="<?php echo $row_productos['id_producto']; ?>">
                                            <input name="actualiza" type="hidden" value="1">
                                            <input name="id_producto_estado" type="hidden" value="1">
                                        </form>
                                    <?php } ?></td>
                                <td class="center">
                                    <button type="button" class="btn btn-info"><i class="fa fa-file-image-o"></i></button>
                                    <button type="button" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></button>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                        <?php } while ($row_productos = mysqli_fetch_assoc($productos)); ?>
                    </tbody>
                </table>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
</div>
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
    $(document).ready(function () {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
</script>