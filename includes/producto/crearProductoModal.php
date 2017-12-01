<!--Modal crear producto-->
<div class="modal fade" id="modal_crearProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form name="form_crearProducto" id="form_crearProducto" >
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Crear producto</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Nombre de producto</label>
                                        <input class="form-control" name="C_DESCRIPCION" id="C_DESCRIPCION">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <input class="form-control" name="C_CODIGO" id="C_CODIGO">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Impuesto</label>
                                        <select class="form-control" name="C_ID_IMPUESTO" id="C_ID_IMPUESTO" >
                                            <option value="">Seleccione un impuesto</option>
                                            <?PHP
                                            foreach ($productos_IMPUESTO as $value) {
                                                echo ('<option value="' . $value['id_impuesto'] . '" >' . $value['descripcion'] . '%' . '</option>');
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
                                        <input class="form-control" name="C_PRECIO_COSTO" id="C_PRECIO_COSTO">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Stock</label>
                                        <input class="form-control" name="C_CANT_ACTUAL" id="C_CANT_ACTUAL">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Precio de venta</label>
                                        <input class="form-control" name="C_PRECIO_MINORISTA" id="C_PRECIO_MINORISTA">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Precio mayorista</label>
                                        <input class="form-control" name="C_PRECIO_MAYORISTA" id="C_PRECIO_MAYORISTA">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Categorías</label>
                                        <select class="form-control" name="C_ID_CATEGORIA" id="C_ID_CATEGORIA" >
                                            <option value="">Seleccione una categoria</option>
                                            <?PHP
                                            foreach ($productos_CATEGORIA as $value) {
                                                echo ('<option value="' . $value['id_producto_categoria'] . '" >' . $value['descripcion'] . '</option>');
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Marcas</label>
                                        <select class="form-control" id="C_ID_MARCA" name="C_ID_MARCA">
                                            <option value="">Seleccione una marca</option>
                                            <?PHP
                                            foreach ($productos_MARCA as $value) {
                                                echo ('<option value="' . $value['id_marca'] . '" >' . $value['descripcion'] . '</option>');
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" value="1" name="crear_producto"/>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="btn_crearProducto">Guardar</button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>