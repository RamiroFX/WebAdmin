<?php

define('root', $_SERVER['DOCUMENT_ROOT'] . '/WebAdmin/');
include(root . 'includes/validador.php');
include(root . 'connection/connect.php');


$id = $_POST['id'];
//OBTENEMOS LOS VALORES DE LA MARCA
$sql = "SELECT id_producto_categoria, descripcion FROM producto_categoria WHERE id_producto_categoria = $id";
$marca_value = $conex->query($sql)->fetch(PDO::FETCH_UNIQUE);
$datos = array(
    0 => $marca_value["id_producto_categoria"],
    1 => $marca_value['descripcion']
);
echo json_encode($datos);
?>