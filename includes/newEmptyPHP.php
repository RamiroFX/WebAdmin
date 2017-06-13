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
                    <button type="button" onclick="actualizarProducto(<?php echo $link['ID']; ?>)" class="btn btn-primary" id="agregar">Modificar</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>