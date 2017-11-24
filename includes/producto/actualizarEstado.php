<?php

define('root', $_SERVER['DOCUMENT_ROOT'] . '/WebAdmin/');
include(root . 'includes/validador.php');
include(root . 'connection/connect.php');

if ((isset($_POST['actualiza'])) && ($_POST['actualiza'] == "1")) {
    $id_producto = $_POST['id_producto'];
    $id_estado = $_POST['id_producto_estado'];
    $SQL = "UPDATE  PRODUCTO SET ID_ESTADO = :id_estado WHERE ID_PRODUCTO = :id_producto";
    $conex->prepare($SQL)->execute([$id_estado, $id_producto]);

    $updateToGo = "productos.php";
    header(sprintf("Location: %s", $updateToGo));
}
?>