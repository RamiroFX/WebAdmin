<?php

define('root', $_SERVER['DOCUMENT_ROOT'] . '/WebAdmin/');
include(root . 'includes/validador.php');
include(root . 'connection/connect.php');

if ((isset($_POST['C_MARCA_NOMBRE'])) && ($_POST['crear_marca'] == 1)) {

    $NOMBRE = $_POST['C_MARCA_NOMBRE'];
    $SQL_SELECT = 'SELECT descripcion FROM marca WHERE descripcion LIKE :nombre';
    $STMT= $conex->prepare($SQL_SELECT);
    $STMT->execute([$NOMBRE]);
    $STMT->fetch(PDO::FETCH_ASSOC);
    $marcaEncontrada = $STMT->rowCount();
    if ($marcaEncontrada == TRUE) {
        echo '<div id="mensaje" class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                El nombre de la marca ya se encuentra en uso, intente nuevamente. 
                            </div>';
        return;
    }
    if (strlen($NOMBRE) < 1) {
        return;
    }
    $SQL_INSERT = "insert into 
            marca(
            descripcion)
            values 
            (:nombre)";
    $resultado = $conex->prepare($SQL_INSERT)->execute([$NOMBRE]);

    if ($resultado == TRUE) {
        echo'<div id="mensaje" class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                La marca se inserto exitosamente. 
                            </div>';
    } else {
        echo '<div id="mensaje" class="alert alert-danger alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                Hubo un problema al crear la marca, intente nuevamente. 
                            </div>';
    }
} else {
    header('Location:' . root . 'index.php');
}
?>