<?php

define('root', $_SERVER['DOCUMENT_ROOT'] . '/WebAdmin/');
include(root . 'includes/validador.php');
include(root . 'connection/connect.php');

if ((isset($_POST['E_PROD_ID'])) && ($_POST['eliminar_producto'] == 1)) {

    $ID_PRODUCTO = $_POST['E_PROD_ID'];
    //CONTROLAR PRODUCTOS EN PEDIDOS
    $SQL_SELECT = 'SELECT pede.id_producto FROM pedido_detalle pede, producto prod '
            . 'WHERE pede.id_producto = prod.id_producto '
            . 'AND prod.id_producto = :id_producto';
    $STMT = $conex->prepare($SQL_SELECT);
    $STMT->execute([$ID_PRODUCTO]);
    $PRODUCTO = $STMT->fetch(PDO::FETCH_ASSOC);
    $productoEncontrado = $STMT->rowCount();
    $STMT->closeCursor();
    $objeto = new stdClass();
    if ($productoEncontrado == TRUE) {
        $objeto->codigo = 2;
        $objeto->mensaje = '<div id="mensaje" class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Existen pedidos que se encuentran utilizando ese producto, no es posible eliminar. 
                        </div>';
        $json = json_encode($objeto);
        echo($json);
        return;
    }
    //CONTROLAR PRODUCTOS EN VENTAS
    $SQL_SELECT = 'SELECT fade.id_producto FROM factura_detalle fade, producto prod '
            . 'WHERE fade.id_producto = prod.id_producto '
            . 'AND prod.id_producto = :id_producto';
    $STMT = $conex->prepare($SQL_SELECT);
    $STMT->execute([$ID_PRODUCTO]);
    $PRODUCTO = $STMT->fetch(PDO::FETCH_ASSOC);
    $productoEncontrado = $STMT->rowCount();
    $STMT->closeCursor();
    if ($productoEncontrado == TRUE) {
        $objeto->codigo = 2;
        $objeto->mensaje = '<div id="mensaje" class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Existen ventas que han facturado ese producto, no es posible eliminar. 
                        </div>';
        $json = json_encode($objeto);
        echo($json);
        return;
    }
    //CONTROLAR PRODUCTOS EN COMPRAS
    $SQL_SELECT = 'SELECT egde.id_producto FROM egreso_detalle egde, producto prod '
            . 'WHERE egde.id_producto = prod.id_producto '
            . 'AND prod.id_producto = :id_producto';
    $STMT = $conex->prepare($SQL_SELECT);
    $STMT->execute([$ID_PRODUCTO]);
    $PRODUCTO = $STMT->fetch(PDO::FETCH_ASSOC);
    $productoEncontrado = $STMT->rowCount();
    $STMT->closeCursor();
    if ($productoEncontrado == TRUE) {
        $objeto->codigo = 2;
        $objeto->mensaje = '<div id="mensaje" class="alert alert-danger alert-dismissable">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            Existen compras que han facturado ese producto, no es posible eliminar. 
                        </div>';
        $json = json_encode($objeto);
        echo($json);
        return;
    }
    $SQL_DELETE = "delete from producto where id_producto = :id_producto";
    $resultado = $conex->prepare($SQL_DELETE);
    $resultado->execute([$ID_PRODUCTO]);
    if ($resultado == TRUE) {
        $objeto->codigo = 1;
        $objeto->mensaje = '<div id="mensaje" class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                El producto se eliminó exitosamente. 
                            </div>';
    } else {
        $objeto->codigo = 2;
        $objeto->mensaje = '<div id="mensaje" class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Hubo un problema al eliminar el producto, intente nuevamente. 
                            </div>';
    }
    $resultado->closeCursor();
    $json = json_encode($objeto);
    echo($json);
} else {
    header('Location:' . root . 'index.php');
}
?>