<?php require_once("../Connections/conex2.php"); ?>
<?php

$carpeta = "../imagenes/productos";
$imagenes = count($_FILES['imagenes']['name']);

for ($index = 0; $index < $imagenes; $index++) {
    $producto = $_GET['idProducto'];
    $nombreArchivo = $_FILES['imagenes']['name'][$index];
    $nombreTemporal = $_FILES['imagenes']['tmp_name'][$index];
    $nombreArchivo = date("dmyHis") . substr(md5(uniqid(rand())), 0, 20);

    $imagen = trim($nombreArchivo);
    $extension = "jpg";

    $nombreArchivo = $imagen . "." . $extension;
    
    $SQL_INSERT="INSERT INTO producto_imagenes(id_producto, imagen)VALUES (:id_producto, :imagen)";
    $resultado = $conex->prepare($SQL_INSERT)->execute([$producto, $nombreArchivo]);
}
?>
