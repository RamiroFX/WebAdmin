<?php
define('root', $_SERVER['DOCUMENT_ROOT'] . '/WebAdmin/');
include(root . 'includes/validador.php');
include(root . 'connection/connect.php');

$SQL_PRODUCTOS = "SELECT PROD.ID_PRODUCTO \"ID\", PROD.DESCRIPCION \"descripcion\", "
        . "PROD.CODIGO \"codigo\", "
        . "(SELECT MARC.DESCRIPCION FROM MARCA MARC WHERE MARC.ID_MARCA = PROD.ID_MARCA)\"marca\", "
        . "(SELECT IMPU.DESCRIPCION FROM IMPUESTO IMPU WHERE IMPU.ID_IMPUESTO = PROD.ID_IMPUESTO)\"impuesto\", "
        . "(SELECT PRCA.DESCRIPCION FROM PRODUCTO_CATEGORIA PRCA WHERE PRCA.ID_PRODUCTO_CATEGORIA = PROD.ID_CATEGORIA)\"categoria\", "
        . "PROD.PRECIO_COSTO \"precio_costo\", "
        . "PROD.PRECIO_MINORISTA \"precio_minorista\", "
        . "PROD.PRECIO_MAYORISTA \"precio_mayorista\", "
        . "(SELECT ESTA.DESCRIPCION FROM ESTADO ESTA WHERE ESTA.ID_ESTADO = PROD.ID_ESTADO)\"estado\", "
        . "PROD.CANT_ACTUAL \"stock\" "
        . "FROM PRODUCTO PROD ORDER BY PROD.DESCRIPCION";

$product_list = $conex->query($SQL_PRODUCTOS)->fetchAll(PDO::FETCH_ASSOC);
//$total_row_productos = $product_list->rowCount();
$total_row_productos = count($product_list);

$SQL_CATEGORIA = "SELECT * FROM PRODUCTO_CATEGORIA ORDER BY ID_PRODUCTO_CATEGORIA ASC";
$productos_CATEGORIA = $conex->query($SQL_CATEGORIA)->fetchAll(PDO::FETCH_ASSOC);

$SQL_MARCA = "SELECT * FROM MARCA ORDER BY ID_MARCA ASC";
$productos_MARCA = $conex->query($SQL_MARCA)->fetchAll(PDO::FETCH_ASSOC);

$SQL_IMPUESTO = "SELECT * FROM IMPUESTO ORDER BY ID_IMPUESTO ASC";
$productos_IMPUESTO = $conex->query($SQL_IMPUESTO)->fetchAll(PDO::FETCH_ASSOC);
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
                        <?PHP foreach ($product_list as $row => $link) { ?>
                            <tr class="odd gradeX">
                                <td> <?php echo $link['descripcion']; ?> </td>
                                <td> <?php echo $link['stock']; ?> </td>
                                <td>
                                    <form action="includes/producto/actualizarPrecio.php" method="post">
                                        <input name="precio" type="text" size="5" value="<?php echo $link['precio_minorista']; ?>" >
                                        <button type="submit"><i class="fa fa-refresh"></i></button>
                                        <input name="id_producto"type="hidden" value="<?php echo $link['ID']; ?>">
                                        <input name="actualiza"type="hidden" value="2">
                                    </form>
                                </td>
                                <td> <?php echo $link['categoria']; ?> </td>
                                <td class="center">
                                    <?php if ($link['estado'] == 'Activo') { ?>
                                        <form action="includes/producto/actualizarEstado.php" method="post">
                                            <button type="submit" class="btn btn-success"><?php echo $link['estado']; ?></button>
                                            <input name="id_producto" type="hidden" value="<?php echo $link['ID']; ?>">
                                            <input name="actualiza" type="hidden" value="1">
                                            <input name="id_producto_estado" type="hidden" value="2">
                                        </form>
                                    <?php } ?>
                                    <?php if ($link['estado'] == 'Inactivo') { ?>
                                        <form action="includes/producto/actualizarEstado.php" method="post">
                                            <button type="submit" class="btn btn-danger"><?php echo $link['estado']; ?></button>
                                            <input name="id_producto" type="hidden" value="<?php echo $link['ID']; ?>">
                                            <input name="actualiza" type="hidden" value="1">
                                            <input name="id_producto_estado" type="hidden" value="1">
                                        </form>
                                    <?php } ?></td>
                                <td class="center">
                                    <a href="javascript:llamarFormularioAgregarImagenProducto(<?php echo $link['ID']; ?>);" class="btn btn-info">
                                        <i class="fa fa-file-image-o"></i>
                                    </a>
                                    <a href="javascript:llamarFormularioModificarProducto(<?php echo $link['ID']; ?>);"class="btn btn-warning">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a href="javascript:llamarFormularioEliminarProducto(<?php echo $link['ID']; ?>);"class="btn btn-danger">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
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
<script>
    $('#dataTables-example').DataTable({
        responsive: true
    });
</script>