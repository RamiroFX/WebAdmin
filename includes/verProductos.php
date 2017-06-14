<?php require_once("../Connections/conex2.php"); ?>
<?php
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
                                <td><form action="actualizarPrecio.php" method="post">
                                        <input name="precio" type="text" size="5" value="<?php echo $link['precio_minorista']; ?>" >
                                        <button type="submit"><i class="fa fa-refresh"></i></button>
                                        <input name="id_producto"type="hidden" value="<?php echo $link['ID']; ?>">
                                        <input name="actualiza"type="hidden" value="2">
                                    </form></td>
                                <td> <?php echo $link['categoria']; ?> </td>
                                <td class="center">
                                    <?php if ($link['estado'] == 'Activo') { ?>
                                        <form action="actualizarEstado.php" method="post">
                                            <button type="submit" class="btn btn-success"><?php echo $link['estado']; ?></button>
                                            <input name="id_producto" type="hidden" value="<?php echo $link['ID']; ?>">
                                            <input name="actualiza" type="hidden" value="1">
                                            <input name="id_producto_estado" type="hidden" value="2">
                                        </form>
                                    <?php } ?>
                                    <?php if ($link['estado'] == 'Inactivo') { ?>
                                        <form action="actualizarEstado.php" method="post">
                                            <button type="submit" class="btn btn-danger"><?php echo $link['estado']; ?></button>
                                            <input name="id_producto" type="hidden" value="<?php echo $link['ID']; ?>">
                                            <input name="actualiza" type="hidden" value="1">
                                            <input name="id_producto_estado" type="hidden" value="1">
                                        </form>
                                    <?php } ?></td>
                                <td class="center">
                                    <button type="button" class="btn btn-info"><i class="fa fa-file-image-o"></i></button>
                                    <a data-toggle="modal" class="btn btn-warning" data-target ="#editarProducto<?php echo $link['ID']; ?>">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <a data-toggle="modal" class="btn btn-danger" data-target ="#eliminarProducto<?php echo $link['ID']; ?>">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            </tr>
                            <!--Modal eliminar producto-->
                        <div class="modal fade" id="eliminarProducto<?php echo $link['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form name="form_delete_product<?php echo $link['ID']; ?>" id="form_delete_product<?php echo $link['ID']; ?>">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Eliminar producto</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    Seguro que desea eliminar el producto:<strong><?php echo $link['descripcion']; ?></strong> ?
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="button" onclick="eliminarProducto('<?php echo $link['ID']; ?>')" class="btn btn-danger" id="botonEliminar">Eliminar</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        <!--Modal editar producto-->
                        <div class="modal fade" id="editarProducto<?php echo $link['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form name="form_update_product<?php echo $link['ID']; ?>" id="form_update_product<?php echo $link['ID']; ?>">
                                    <div class="modal-content">
                                        <div class="modal-header bg-primary">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Modificar producto</h4>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Nombre de producto</label>
                                                        <input class="form-control" name="DESCRIPCION<?php echo $link['ID']; ?>" id="DESCRIPCION<?php echo $link['ID']; ?>" value="<?php echo $link['descripcion']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Código</label>
                                                        <input class="form-control" name="CODIGO<?php echo $link['ID']; ?>" id="CODIGO<?php echo $link['ID']; ?>" value="<?php echo $link['codigo']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Impuesto</label>
                                                        <select class="form-control" name="ID_IMPUESTO<?php echo $link['ID']; ?>" id="ID_IMPUESTO<?php echo $link['ID']; ?>" >
                                                            <option value="">Seleccione un impuesto</option>
                                                            <?PHP
                                                            foreach ($productos_IMPUESTO as $value) {
                                                                if ($link['impuesto'] == $value['descripcion']) {
                                                                    echo ('<option value="' . $value['id_impuesto'] . '" selected >' . $value['descripcion'] . '%' . '</option>');
                                                                } else {
                                                                    echo ('<option value="' . $value['id_impuesto'] . '" >' . $value['descripcion'] . '%' . '</option>');
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Precio de costo</label>
                                                        <input class="form-control" name="PRECIO_COSTO<?php echo $link['ID']; ?>" id="PRECIO_COSTO<?php echo $link['ID']; ?>" value="<?php echo $link['precio_costo']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Stock</label>
                                                        <input class="form-control" name="CANT_ACTUAL<?php echo $link['ID']; ?>" id="CANT_ACTUAL<?php echo $link['ID']; ?>" value="<?php echo $link['stock']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Precio de venta</label>
                                                        <input class="form-control" name="PRECIO_MINORISTA<?php echo $link['ID']; ?>" id="PRECIO_MINORISTA<?php echo $link['ID']; ?>" value="<?php echo $link['precio_minorista']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Precio mayorista</label>
                                                        <input class="form-control" name="PRECIO_MAYORISTA<?php echo $link['ID']; ?>" id="PRECIO_MAYORISTA<?php echo $link['ID']; ?>" value="<?php echo $link['precio_mayorista']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Categorías</label>
                                                        <select class="form-control" name="ID_CATEGORIA<?php echo $link['ID']; ?>" id="ID_CATEGORIA<?php echo $link['ID']; ?>" >
                                                            <option value="">Seleccione una categoria</option>
                                                            <?PHP
                                                            foreach ($productos_CATEGORIA as $value) {
                                                                if ($link['categoria'] == $value['descripcion']) {
                                                                    echo ('<option value="' . $value['id_producto_categoria'] . '" selected >' . $value['descripcion'] . '</option>');
                                                                } else {
                                                                    echo ('<option value="' . $value['id_producto_categoria'] . '" >' . $value['descripcion'] . '</option>');
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Marcas</label>
                                                        <select class="form-control" id="ID_MARCA<?php echo $link['ID']; ?>" name="ID_MARCA<?php echo $link['ID']; ?>">
                                                            <option value="">Seleccione una marca</option>
                                                            <?PHP
                                                            foreach ($productos_MARCA as $value) {
                                                                if ($link['marca'] == $value['descripcion']) {
                                                                    echo ('<option value="' . $value['id_marca'] . '" selected >' . $value['descripcion'] . '</option>');
                                                                } else {
                                                                    echo ('<option value="' . $value['id_marca'] . '" >' . $value['descripcion'] . '</option>');
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            <button type="button" onclick="actualizarProducto('<?php echo $link['ID']; ?>')" class="btn btn-primary" id="botonModificar">Modificar</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
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
<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script>
                                            $(document).ready(function() {
                                                $('#dataTables-example').DataTable({
                                                    responsive: true
                                                });
                                            });
</script>