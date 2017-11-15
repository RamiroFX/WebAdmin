<?php require_once '../Connections/conex2.php'; ?>
<?php

if ((isset($_POST['M_PROD_ID'])) && ($_POST['modificar_producto'] == 1)) {

    $ID_PRODUCTO = $_POST['M_PROD_ID'];
    $DESCRIPCION = $_POST['M_PROD_DESCRIPCION'];
    $CODIGO = $_POST['M_PROD_CODIGO'];
    $ID_ESTADO = $_POST['M_PROD_ID_ESTADO'];
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
            DESCRIPCION = :DESCRIPCION, CODIGO = :CODIGO, ID_ESTADO = :ID_ESTADO,
            ID_MARCA = :ID_MARCA, ID_IMPUESTO = :ID_IMPUESTO, 
            ID_CATEGORIA = :ID_CATEGORIA, PRECIO_COSTO = :PRECIO_COSTO, 
            PRECIO_MINORISTA = :PRECIO_MINORISTA, PRECIO_MAYORISTA = :PRECIO_MAYORISTA, 
            CANT_ACTUAL = :CANT_ACTUAL WHERE ID_PRODUCTO = :ID_PRODUCTO";
    $resultado = $conex->prepare($SQL_UPDATE)->execute([$DESCRIPCION, $CODIGO, $ID_ESTADO, $ID_MARCA, $ID_IMPUESTO,
        $ID_CATEGORIA, $PRECIO_COSTO, $PRECIO_MINORISTA, $PRECIO_MAYORISTA,
        $CANT_ACTUAL,$ID_PRODUCTO]);

    if ($resultado == TRUE) {
        echo'<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                El producto se modificó exitosamente. 
                            </div>';
    } else {
        echo '<div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Hubo un problema al modificar producto, intente nuevamente. 
                            </div>';
    }
} else {
    header('Location:' . root . 'home.php');
}
?>