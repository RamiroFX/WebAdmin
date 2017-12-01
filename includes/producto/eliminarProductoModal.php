<!--Modal eliminar producto-->
<div class="modal fade" id="modal_eliminarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form name="form_eliminarProducto" id="form_eliminarProducto">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Eliminar producto</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            ¿Seguro que desea eliminar el producto?:
                        </div>
                        <input readonly class="form-control" name="E_PROD_DESCRIPCION" id="E_PROD_DESCRIPCION">
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" value="1" name="eliminar_producto" id="eliminar_producto"/>
                    <input type="hidden" value="" name="E_PROD_ID" id="E_PROD_ID"/>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-danger" id="btn_eliminarProducto">Eliminar</button>
                </div>
            </div>
        </form>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>