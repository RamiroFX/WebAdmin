<?php

define('root', $_SERVER['DOCUMENT_ROOT'] . '/WebAdmin/');
include(root . 'includes/validador.php');
include(root . 'connection/connect.php');


if ((isset($_POST['crear_producto'])) && ($_POST['crear_producto'] == 1)) {

    //VERIFICAR DESCRIPCION UNICA
    $DESCRIPCION = $_POST['C_DESCRIPCION'];
    $SQL_SELECT = 'SELECT descripcion FROM producto WHERE descripcion LIKE :descripcion';
    $STMT = $conex->prepare($SQL_SELECT);
    $STMT->execute([$DESCRIPCION]);
    $STMT->fetch(PDO::FETCH_ASSOC);
    $prodDescEncontrado = $STMT->rowCount();
    $STMT->closeCursor();
    if ($prodDescEncontrado == TRUE) {
        echo '<div id="mensaje" class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                El nombre del producto ya se encuentra en uso, intente nuevamente. 
                            </div>';
        return;
    }
    //VERIFICAR CODIGO UNICO
    $CODIGO = $_POST['C_CODIGO'];
    $SQL_SELECT = 'SELECT codigo FROM producto WHERE codigo LIKE :codigo';
    $STMT = $conex->prepare($SQL_SELECT);
    $STMT->execute([$CODIGO]);
    $STMT->fetch(PDO::FETCH_ASSOC);
    $prodCodEncontrado = $STMT->rowCount();
    $STMT->closeCursor();
    if ($prodCodEncontrado == TRUE) {
        echo '<div id="mensaje" class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                El codigo del producto ya se encuentra en uso, intente nuevamente. 
                            </div>';
        return;
    }
    $ID_ESTADO = 1;//ACTIVO
    $ID_MARCA = $_POST['C_ID_MARCA'];
    $ID_IMPUESTO = $_POST['C_ID_IMPUESTO'];
    $ID_CATEGORIA = $_POST['C_ID_CATEGORIA'];
    $PRECIO_COSTO = $_POST['C_PRECIO_COSTO'];
    $PRECIO_MINORISTA = $_POST['C_PRECIO_MINORISTA'];
    $PRECIO_MAYORISTA = $_POST['C_PRECIO_MAYORISTA'];
    $CANT_ACTUAL = $_POST['C_CANT_ACTUAL'];

    if (strlen($CODIGO) < 1) {
        $CODIGO = NULL;
    }
    $SQL_INSERT = "INSERT INTO 
            PRODUCTO(
            DESCRIPCION, CODIGO, ID_ESTADO, ID_MARCA, ID_IMPUESTO, 
            ID_CATEGORIA, PRECIO_COSTO, PRECIO_MINORISTA, PRECIO_MAYORISTA, 
            CANT_ACTUAL)
            VALUES 
            (:DESCRIPCION, :CODIGO, :ID_ESTADO, :ID_MARCA, :ID_IMPUESTO, 
            :ID_CATEGORIA, :PRECIO_COSTO, :PRECIO_MINORISTA, :PRECIO_MAYORISTA, 
            :CANT_ACTUAL)";
    $resultado = $conex->prepare($SQL_INSERT);
    $resultado->execute([$DESCRIPCION, $CODIGO, $ID_ESTADO, $ID_MARCA, $ID_IMPUESTO,
        $ID_CATEGORIA, $PRECIO_COSTO, $PRECIO_MINORISTA, $PRECIO_MAYORISTA,
        $CANT_ACTUAL]);
    $resultado->closeCursor();
    if ($resultado == TRUE) {
        echo'<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                El producto se inserto exitosamente. 
                            </div>';
    } else {
        echo '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Hubo un problema al crear producto, intente nuevamente. 
                            </div>';
    }
}
?>
