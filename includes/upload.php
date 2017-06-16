<?php require_once("../Connections/conex2.php");
require_once '../includes/class.imgsizer.php';
?>

<?php

$carpeta = "../imagenes/productos";
$imagenes = count($_FILES['imagenes']['name']);

for ($index = 0; $index < $imagenes; $index++) {
    $idProducto = $_GET['idProducto'];
    $nombreArchivo = $_FILES['imagenes']['name'][$index];
    $nombreTemporal = $_FILES['imagenes']['tmp_name'][$index];
    $nombreArchivo = date("dmyHis") . substr(md5(uniqid(rand())), 0, 20);

    $imagen = trim($nombreArchivo);
    $extension = "jpg";

    $nombreArchivo = $imagen . "." . $extension;
    $ruta = $carpeta . $nombreArchivo;

    $SQL_INSERT = "INSERT INTO producto_imagenes(id_producto, imagen)VALUES (:id_producto, :imagen)";
    $resultado = $conex->prepare($SQL_INSERT)->execute([$idProducto, $nombreArchivo]);

    move_uploaded_file($nombreTemporal, $ruta);
    $imgSizer = new imgSizer();
    $imgSizer->type = "width";
    $imgSizer->max = 160;
    $imgSizer->quality = 8;
    $imgSizer->square = true;
    $imgSizer->prefix = "miniatura_";
    $imgSizer->folder = "_min";
    $imgSizer->image = "/webadmin/imagenes/productos/" . $nombreArchivo;
    $imgSizer->resize();

    $infoImagenesSubidas[$index] = array("height" => "120px");
    $imagenesSubidas[$index] = '<img src=\'/webadmin/imagenes/productos/_min/miniatura_' . $nombreArchivo . ' height=\'120px\' class=\'file-preview-image\'>';
}
$arr = array("file_id" => 0, "overwriteInitial" => true, "initialPreviewConfig" => $infoImagenesSubidas,
    "initialPreview" => $imagenesSubidas);

json_encode($arr);
?>
