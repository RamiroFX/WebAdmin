<?php
define('root', $_SERVER['DOCUMENT_ROOT'] . '/WebAdmin/');
include(root . 'includes/validador.php');
include(root . 'connection/connect.php');
include(root . 'includes/head.php');

$SQL_CATEGORIA = "SELECT * FROM PRODUCTO_CATEGORIA ORDER BY ID_PRODUCTO_CATEGORIA ASC";
$productos_CATEGORIA = $conex->query($SQL_CATEGORIA)->fetchAll(PDO::FETCH_ASSOC);

$SQL_MARCA = "SELECT * FROM MARCA ORDER BY ID_MARCA ASC";
$productos_MARCA = $conex->query($SQL_MARCA)->fetchAll(PDO::FETCH_ASSOC);

$SQL_IMPUESTO = "SELECT * FROM IMPUESTO ORDER BY ID_IMPUESTO ASC";
$productos_IMPUESTO = $conex->query($SQL_IMPUESTO)->fetchAll(PDO::FETCH_ASSOC);
?>
<body onload="verProducto()">

    <div id="wrapper">

        <!-- Navigation -->
        <?php include(root . 'includes/header.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Productos</h1>
                    <div id="info"></div>
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_agregarProducto">
                        Agregar producto
                    </button>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="col-lg-12">
                <div id="barra_progreso" class="row progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar"
                         aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
                        Cargando...
                    </div>
                </div> 
            </div> 
            <div id="verProductos"></div>

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
    include(root . 'includes/producto/agregarProductoModal.php');
    include(root . 'includes/producto/modificarProductoModal.php');
    include(root . 'includes/producto/eliminarProductoModal.php');
    include(root . 'includes/foot.php');
    ?>