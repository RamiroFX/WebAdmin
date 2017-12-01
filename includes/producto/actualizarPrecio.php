<?php

define('root', $_SERVER['DOCUMENT_ROOT'] . '/WebAdmin/');
include(root . 'includes/validador.php');
include(root . 'connection/connect.php');

if ((isset($_POST['actualiza'])) && ($_POST['actualiza'] == "2")) {
    $id_producto = $_POST['id_producto'];
    $precio = $_POST['precio'];
    $SQL = "UPDATE  PRODUCTO SET precio_minorista = :precio WHERE ID_PRODUCTO = :id_producto";
    $conex->prepare($SQL)->execute([$precio, $id_producto]);

    $updateToGo = "../../productos.php";
    header(sprintf("Location: %s", $updateToGo));
}
?>