<?php

define('root', $_SERVER['DOCUMENT_ROOT'] . '/WebAdmin/');
include(root . 'includes/validador.php');
include(root . 'connection/connect.php');

if ((isset($_POST['E_PROD_ID'])) && ($_POST['eliminar_producto'] == 1)) {

    $ID_PRODUCTO = $_POST['E_PROD_ID'];
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