<?php

define('root', $_SERVER['DOCUMENT_ROOT'] . '/WebAdmin/');
include(root . 'includes/validador.php');
include(root . 'connection/connect.php');

if ((isset($_POST['M_PROD_ID'])) && ($_POST['modificar_producto'] == 1)) {
    $ID_PRODUCTO = $_POST['M_PROD_ID'];
    //VERIFICAR DESCRIPCION UNICA
    $DESCRIPCION = $_POST['M_PROD_DESCRIPCION'];
    $SQL_SELECT = 'SELECT id_producto FROM producto WHERE descripcion LIKE :descripcion';
    $STMT = $conex->prepare($SQL_SELECT);
    $STMT->execute([$DESCRIPCION]);
    $PRODUCTO = $STMT->fetch(PDO::FETCH_ASSOC);
    $prodDescEncontrado = $STMT->rowCount();
    $respuesta = new stdClass();
    if ($prodDescEncontrado == TRUE) {
        $ID_NUEVO = $PRODUCTO['id_producto'];
        $STMT->closeCursor();
        if ($ID_PRODUCTO != $ID_NUEVO) {
            $respuesta->codigo = 2;
            $respuesta->mensaje = '<div id="mensaje" class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                El nombre del producto ya se encuentra en uso, intente nuevamente. 
                            </div>';
            $json = json_encode($respuesta);
            echo($json);
            return;
        }
    }
    //VERIFICAR CODIGO UNICO
    $CODIGO = $_POST['M_PROD_CODIGO'];
    $SQL_SELECT = 'SELECT codigo FROM producto WHERE codigo LIKE :codigo';
    $STMT = $conex->prepare($SQL_SELECT);
    $STMT->execute([$CODIGO]);
    $PRODUCTO = $STMT->fetch(PDO::FETCH_ASSOC);
    $prodCodEncontrado = $STMT->rowCount();
    if ($prodCodEncontrado == TRUE) {
        $CODIGO_NUEVO = $PRODUCTO['codigo'];
        $STMT->closeCursor();
        if ($CODIGO != $CODIGO_NUEVO) {
            $respuesta->codigo = 2;
            $respuesta->mensaje = '<div id="mensaje" class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                El codigo del producto ya se encuentra en uso, intente nuevamente. 
                            </div>';
            $json = json_encode($respuesta);
            echo($json);
            return;
        }
    }
    $ID_MARCA = $_POST['M_PROD_ID_MARCA'];
    $ID_IMPUESTO = $_POST['M_PROD_ID_IMPUESTO'];
    $ID_CATEGORIA = $_POST['M_PROD_ID_CATEGORIA'];
    $PRECIO_COSTO = $_POST['M_PROD_PRECIO_COSTO'];
    $PRECIO_MINORISTA = $_POST['M_PROD_PRECIO_MINORISTA'];
    $PRECIO_MAYORISTA = $_POST['M_PROD_PRECIO_MAYORISTA'];
    $CANT_ACTUAL = $_POST['M_PROD_CANT_ACTUAL'];

    if (strlen($CODIGO) < 1) {
        $CODIGO = NULL;
    }
    $SQL_UPDATE = "UPDATE PRODUCTO SET
            DESCRIPCION = :DESCRIPCION, CODIGO = :CODIGO, 
            ID_MARCA = :ID_MARCA, ID_IMPUESTO = :ID_IMPUESTO, 
            ID_CATEGORIA = :ID_CATEGORIA, PRECIO_COSTO = :PRECIO_COSTO, 
            PRECIO_MINORISTA = :PRECIO_MINORISTA, PRECIO_MAYORISTA = :PRECIO_MAYORISTA, 
            CANT_ACTUAL = :CANT_ACTUAL WHERE ID_PRODUCTO = :ID_PRODUCTO";
    $resultado = $conex->prepare($SQL_UPDATE)->execute([$DESCRIPCION, $CODIGO, $ID_MARCA, $ID_IMPUESTO,
        $ID_CATEGORIA, $PRECIO_COSTO, $PRECIO_MINORISTA, $PRECIO_MAYORISTA,
        $CANT_ACTUAL, $ID_PRODUCTO]);

    if ($resultado == TRUE) {
        $respuesta->codigo = 1;
        $respuesta->mensaje = '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                El producto se modificó exitosamente. 
                            </div>';
        $json = json_encode($respuesta);
        echo($json);
    } else {
        $respuesta->codigo = 2;
        $respuesta->mensaje = '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Hubo un problema al modificar producto, intente nuevamente. 
                            </div>';
        $json = json_encode($respuesta);
        echo($json);
    }
} else {
    header('Location:' . root . 'index.php');
}
?>
