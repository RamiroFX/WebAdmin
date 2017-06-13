<?php require_once '../Connections/conex2.php'; ?>
<?php

if ((isset($_POST['modificar_producto'])) && ($_POST['modificar_producto'] == 1)) {

    $ID_PRODUCTO = $_POST['ID_PRODUCTO'];
    $DESCRIPCION = $_POST['DESCRIPCION'];
    $CODIGO = $_POST['CODIGO'];
    $ID_ESTADO = 2;
    $ID_MARCA = $_POST['ID_MARCA'];
    $ID_IMPUESTO = $_POST['ID_IMPUESTO'];
    $ID_CATEGORIA = $_POST['ID_CATEGORIA'];
    $PRECIO_COSTO = $_POST['PRECIO_COSTO'];
    $PRECIO_MINORISTA = $_POST['PRECIO_MINORISTA'];
    $PRECIO_MAYORISTA = $_POST['PRECIO_MAYORISTA'];
    $CANT_ACTUAL = $_POST['CANT_ACTUAL'];

    if (strlen($CODIGO) < 1) {
        $CODIGO = NULL;
    }
    $SQL_INSERT = "UPDATE PRODUCTO SET
            DESCRIPCION = :DESCRIPCION, CODIGO = :CODIGO, ID_ESTADO = :ID_ESTADO,
            ID_MARCA = :ID_MARCA, ID_IMPUESTO = :ID_IMPUESTO, 
            ID_CATEGORIA = :ID_CATEGORIA, PRECIO_COSTO = :PRECIO_COSTO, 
            PRECIO_MINORISTA = :PRECIO_MINORISTA, PRECIO_MAYORISTA = :PRECIO_MAYORISTA, 
            CANT_ACTUAL = :CANT_ACTUAL WHERE ID_PRODUCTO = :ID_PRODUCTO";
    $resultado = $conex->prepare($SQL_INSERT)->execute([$DESCRIPCION, $CODIGO, $ID_ESTADO, $ID_MARCA, $ID_IMPUESTO,
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
}
?>