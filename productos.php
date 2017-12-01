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
<body onload="cargarDatos()">

    <div id="wrapper">

        <!-- Navigation -->
        <?php include(root . 'includes/header.php'); ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Productos</h1>
                    <div id="info"></div>
                    <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_crearProducto">
                        Crear producto
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
    <div id="page-wrapper">
        <div class="row">
            <!-- INICIO SECCION MARCAS-->
            <section class = "panel col-md-6 panel-collapsed">
                <div class = "panel-heading ">
                    <div class="row">
                        <a href="#" class="panel-action panel-action" data-toggle = "modal" data-target = "#modal_crearMarca"><i class="fa fa-plus"></i></a>
                        <a href = "#" class = "panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class = "panel-title">Marcas</h2>
                </div>
                <div id="verMarca"></div>
                <?php
                include(root . 'includes/producto/marca/crearMarcaForm.php');
                include(root . 'includes/producto/marca/modificarMarcaForm.php');
                include(root . 'includes/producto/marca/eliminarMarcaForm.php');
                ?>
            </section>
            <!-- FIN SECCION MARCAS-->

            <!-- INICIO SECCION CATEGORIAS-->
            <section class = "panel col-md-6 panel-collapsed">
                <header class = "panel-heading ">
                    <div class = "panel-actions">
                        <a href="#" class="panel-action panel-action" data-toggle = "modal" data-target = "#modal_crearCategoria"><i class="fa fa-plus"></i></a>
                        <a href = "#" class = "panel-action panel-action-toggle" data-panel-toggle></a>
                    </div>
                    <h2 class = "panel-title">Categorías</h2>
                </header>
                <div class = "panel-body">
                    <div class = "table-responsive">
                        <table class = "table table-striped mb-none">
                            <tbody>
                            <div id="verCategoria"></div> 
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                include(root . 'includes/producto/categoria/crearCategoriaForm.php');
                include(root . 'includes/producto/categoria/modificarCategoriaForm.php');
                include(root . 'includes/producto/categoria/eliminarCategoriaForm.php');
                ?>
            </section>
            <!-- FIN SECCION CATEGORIAS-->
        </div>
    </div>
    <?php
    include(root . 'includes/producto/crearProductoModal.php');
    include(root . 'includes/producto/modificarProductoModal.php');
    include(root . 'includes/producto/eliminarProductoModal.php');
    include(root . 'includes/foot.php');
    ?>