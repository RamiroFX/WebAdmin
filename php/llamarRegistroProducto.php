<?php

define('root', $_SERVER['DOCUMENT_ROOT'] . '/WebAdmin/');
include(root . 'includes/validador.php');
include(root . 'connection/connect.php');

$id = $_POST['id'];
//OBTENEMOS LOS VALORES DEL PRODUCTO

$sql = "SELECT id_producto, descripcion, codigo, id_estado, id_marca, id_impuesto, 
            id_categoria, precio_costo, precio_minorista, precio_mayorista, 
            cant_actual
        FROM producto where id_producto = :id";
$stmt = $conex->prepare($sql);
$stmt->execute([$id]);
$product_value = $stmt->fetch(PDO::FETCH_UNIQUE);

$datos = array(
    0 => $product_value["id_producto"],
    1 => $product_value['descripcion'],
    2 => $product_value['codigo'],
    3 => $product_value['id_estado'],
    4 => $product_value['id_marca'],
    5 => $product_value['id_impuesto'],
    6 => $product_value['id_categoria'],
    7 => $product_value['precio_costo'],
    8 => $product_value['precio_minorista'],
    9 => $product_value['precio_mayorista'],
    10 => $product_value['cant_actual']
);
echo json_encode($datos);
?>