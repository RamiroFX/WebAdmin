<?php require_once("../Connections/conex2.php"); ?>
<?php
$SQL = "SELECT PROD.ID_PRODUCTO \"ID\", PROD.DESCRIPCION \"descripcion\", "
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
$productos = $conex->prepare($SQL);
$productos->execute();
$row_productos = $productos->fetch(PDO::FETCH_ASSOC);
$total_row_productos = $productos->rowCount();


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
                        <?PHP do { ?>
                            <tr class="odd gradeX">
                                <td> <?php echo $row_productos['descripcion']; ?> </td>
                                <td> <?php echo $row_productos['stock']; ?> </td>
                                <td><form action="actualizarPrecio.php" method="post">
                                        <input name="precio" type="text" size="5" value="<?php echo $row_productos['precio_minorista']; ?>" >
                                        <button type="submit"><i class="fa fa-refresh"></i></button>
                                        <input name="id_producto"type="hidden" value="<?php echo $row_productos['ID']; ?>">
                                        <input name="actualiza"type="hidden" value="2">
                                    </form></td>
                                <td> <?php echo $row_productos['categoria']; ?> </td>
                                <td class="center">
                                    <?php if ($row_productos['estado'] == 'Activo') { ?>
                                        <form action="actualizarEstado.php" method="post">
                                            <button type="submit" class="btn btn-success"><?php echo $row_productos['estado']; ?></button>
                                            <input name="id_producto" type="hidden" value="<?php echo $row_productos['ID']; ?>">
                                            <input name="actualiza" type="hidden" value="1">
                                            <input name="id_producto_estado" type="hidden" value="2">
                                        </form>
                                    <?php } ?>
                                    <?php if ($row_productos['estado'] == 'Inactivo') { ?>
                                        <form action="actualizarEstado.php" method="post">
                                            <button type="submit" class="btn btn-danger"><?php echo $row_productos['estado']; ?></button>
                                            <input name="id_producto" type="hidden" value="<?php echo $row_productos['ID']; ?>">
                                            <input name="actualiza" type="hidden" value="1">
                                            <input name="id_producto_estado" type="hidden" value="1">
                                        </form>
                                    <?php } ?></td>
                                <td class="center">
                                    <button type="button" class="btn btn-info"><i class="fa fa-file-image-o"></i></button>
                                    <a data-toggle="modal" class="btn btn-warning" data-target ="#editarProducto<?php echo $row_productos['ID']; ?>">
                                        <i class="fa fa-pencil-square-o"></i>
                                    </a>
                                    <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                </td>
                            </tr>
                        <div class="modal fade" id="editarProducto<?php echo $row_productos['ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <form name="form_update_product<?php echo $row_productos['ID']; ?>" id="form_add_product<?php echo $row_productos['ID']; ?>">
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
                                                        <input class="form-control" name="DESCRIPCION" id="DESCRIPCION" value="<?php echo $row_productos['descripcion']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Código</label>
                                                        <input class="form-control" name="CODIGO" id="CODIGO" value="<?php echo $row_productos['codigo']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Impuesto</label>
                                                        <select class="form-control" name="ID_IMPUESTO" id="ID_IMPUESTO" >
                                                            <option value="">Seleccione un impuesto</option>
                                                            <?PHP
                                                            foreach ($productos_IMPUESTO as $value) {
                                                                if ($row_productos['impuesto'] == $value['descripcion']) {
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
                                                        <input class="form-control" name="PRECIO_COSTO" id="PRECIO_COSTO" value="<?php echo $row_productos['precio_costo']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Stock</label>
                                                        <input class="form-control" name="CANT_ACTUAL" id="CANT_ACTUAL" value="<?php echo $row_productos['stock']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Precio de venta</label>
                                                        <input class="form-control" name="PRECIO_MINORISTA" id="PRECIO_MINORISTA" value="<?php echo $row_productos['precio_minorista']; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Precio mayorista</label>
                                                        <input class="form-control" name="PRECIO_MAYORISTA" id="PRECIO_MAYORISTA" value="<?php echo $row_productos['precio_mayorista']; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label>Categorías</label>
                                                        <select class="form-control" name="ID_CATEGORIA" id="ID_CATEGORIA" >
                                                            <option value="">Seleccione una categoria</option>
                                                            <?PHP
                                                            foreach ($productos_CATEGORIA as $value) {
                                                                if ($row_productos['categoria'] == $value['descripcion']) {
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
                                                        <select class="form-control" id="ID_MARCA" name="ID_MARCA">
                                                            <option value="">Seleccione una marca</option>
                                                            <?PHP
                                                            foreach ($productos_MARCA as $value) {
                                                                if ($row_productos['marca'] == $value['descripcion']) {
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
                                            <button type="button" onclick="actualizarProducto(<?php echo $row_productos['ID']; ?>)" class="btn btn-primary" id="agregar">Modificar</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                    <?php } while ($row_productos = $productos->fetch(PDO::FETCH_ASSOC)); ?>
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