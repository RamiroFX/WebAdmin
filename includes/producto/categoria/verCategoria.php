<?php

define('root', $_SERVER['DOCUMENT_ROOT'] . '/WebAdmin/');
include(root . 'includes/validador.php');
include(root . 'connection/connect.php');
$ROL_USUARIO = $_SESSION['MS_USER_ROL_NAME'];

$tabla = "";
/*
 * SQL PRODUCT
 */
$SQL_PRODUCTO_CATEGORIA = "select * from producto_categoria order by id_producto_categoria asc";
$product_category_list = $conex->query($SQL_PRODUCTO_CATEGORIA)->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <!-- /.panel-heading -->
            <div class="panel-body">
                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-categorias">
                    <thead>
                        <tr>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                        </tr>
                    </thead>
                    <tbody>
                        <?PHP foreach ($product_category_list as $row => $link) { ?>
                            <tr class="odd gradeX">
                                <td> <?php echo $link['id_producto_categoria']; ?> </td>
                                <td> <?php echo $link['descripcion']; ?> </td>
                                <td class="center">
                                    <a href="javascript:llamarFormularioEditarCategoria(<?php echo $link['id_producto_categoria']; ?>);" title="Editar categoría" class="btn btn-warning"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:llamarFormularioEliminarCategoria(<?php echo $link['id_producto_categoria']; ?>);" title="Eliminar categoría" class="btn btn-danger"> <i class="fa fa-trash-o"></i> </a>
                                </td>
                            </tr><?php } ?>
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
    $('#dataTables-categorias').DataTable({
        responsive: true
    });
</script>