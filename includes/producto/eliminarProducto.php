<?php require_once '../Connections/conex2.php'; ?>
<?php

if ((isset($_POST['eliminar_producto'])) && ($_POST['eliminar_producto'] == 3)) {

    $ID_PRODUCTO = $_POST['ID_PRODUCTO'];
    $SQL_DELETE = "DELETE FROM PRODUCTO WHERE ID_PRODUCTO = :ID_PRODUCTO";
    $resultado = $conex->prepare($SQL_DELETE)->execute([$ID_PRODUCTO]);

    if ($resultado == TRUE) {
        echo'<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                El producto se eliminó exitosamente. 
                            </div>';
    } else {
        echo '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Hubo un problema al eliminar producto, intente nuevamente. 
                            </div>';
    }
}
?>