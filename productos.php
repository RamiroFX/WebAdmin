<?php require_once("Connections/conex2.php"); ?>
<?php
if (!isset($_SESSION)) {
    session_start();
}
$MM_authorizedUsers = "";
$MM_doNotCheckAccess = "true";

function isAuthorized($strUsers, $strGroups, $userName, $userGroup) {
    $isValid = FALSE;

    if (!empty($userName)) {
        $arrUsers = explode(",", $strUsers);
        $arrGroups = explode(",", $strGroups);
        if (in_array($userName, $arrUsers)) {
            $isValid = TRUE;
        }
        if (in_array($userGroup, $arrGroups)) {
            $isValid = TRUE;
        }
        if (($strUsers == "") && TRUE) {
            $isValid = TRUE;
        }
    }
    return $isValid;
}

$MM_restrictGoTo = "error.php?error=1";
if (!((isset($_SESSION['MM_idAdmin'])) &&
        (isAuthorized("", $MM_authorizedUsers, $_SESSION['MM_idAdmin'], $_SESSION['MM_idAdmin'])))) {
    header("Location: " . $MM_restrictGoTo);
    exit();
}
?>
<?php
$SQL = "SELECT * FROM PRODUCTO ORDER BY DESCRIPCION ASC";
$productos = $conex->prepare($SQL);
$productos->execute();
$row_productos = $productos->fetch(PDO::FETCH_ASSOC);
$total_row_productos = $productos->rowCount();

$SQL_CATEGORIA = "SELECT * FROM PRODUCTO_CATEGORIA ORDER BY ID_PRODUCTO_CATEGORIA ASC";
$productos_CATEGORIA = $conex->prepare($SQL_CATEGORIA);
$productos_CATEGORIA->execute();
$row_CATEGORIA = $productos_CATEGORIA->fetch(PDO::FETCH_ASSOC);
$total_row_CATEGORIA = $productos_CATEGORIA->rowCount();

$SQL_MARCA = "SELECT * FROM MARCA ORDER BY ID_MARCA ASC";
$productos_MARCA = $conex->prepare($SQL_MARCA);
$productos_MARCA->execute();
$row_MARCA = $productos_MARCA->fetch(PDO::FETCH_ASSOC);
$total_row_MARCA = $productos_MARCA->rowCount();

$SQL_IMPUESTO = "SELECT * FROM IMPUESTO ORDER BY ID_IMPUESTO ASC";
$productos_IMPUESTO = $conex->prepare($SQL_IMPUESTO);
$productos_IMPUESTO->execute();
$row_IMPUESTO = $productos_IMPUESTO->fetch(PDO::FETCH_ASSOC);
$total_row_IMPUESTO = $productos_IMPUESTO->rowCount();
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Sistema de Administración</title>

        <!-- Bootstrap Core CSS -->
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

        <!-- DataTables CSS -->
        <link href="vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

        <!-- DataTables Responsive CSS -->
        <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="dist/css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body onload="verProducto()">

        <div id="wrapper">

            <!-- Navigation -->
            <?php include("includes/header.php"); ?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Productos</h1>
                        <div id="info"></div>
                        <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#agregarProducto">
                            Agregar producto
                        </button>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div id="verProductos"></div>

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->
        <div class="modal fade" id="agregarProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form name="form_add_product" id="form_add_product">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Agregar producto</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>Nombre de producto</label>
                                        <input class="form-control" name="DESCRIPCION" id="DESCRIPCION">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Código</label>
                                        <input class="form-control" name="CODIGO" id="CODIGO">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Impuesto</label>
                                        <select class="form-control" name="ID_IMPUESTO" id="ID_IMPUESTO" >
                                            <option value="">Seleccione un impuesto</option>
                                            <?PHP do { ?>
                                                <option value="<?PHP echo $row_IMPUESTO['id_impuesto']; ?>"><?PHP echo $row_IMPUESTO['descripcion'] . '%'; ?></option>
                                            <?PHP } while ($row_IMPUESTO = $productos_IMPUESTO->fetch(PDO::FETCH_ASSOC)); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Precio de costo</label>
                                        <input class="form-control" name="PRECIO_COSTO" id="PRECIO_COSTO">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Stock</label>
                                        <input class="form-control" name="CANT_ACTUAL" id="CANT_ACTUAL">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Precio de venta</label>
                                        <input class="form-control" name="PRECIO_MINORISTA" id="PRECIO_MINORISTA">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Precio mayorista</label>
                                        <input class="form-control" name="PRECIO_MAYORISTA" id="PRECIO_MAYORISTA">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Categorías</label>
                                        <select class="form-control" name="ID_CATEGORIA" id="ID_CATEGORIA" >
                                            <option value="">Seleccione una categoria</option>
                                            <?PHP do { ?>
                                                <option value="<?PHP echo $row_CATEGORIA['id_producto_categoria']; ?>"><?PHP echo $row_CATEGORIA['descripcion']; ?></option>
                                            <?PHP } while ($row_CATEGORIA = $productos_CATEGORIA->fetch(PDO::FETCH_ASSOC)); ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label>Marcas</label>
                                        <select class="form-control" id="ID_MARCA" name="ID_MARCA">
                                            <option value="">Seleccione una marca</option>
                                            <?PHP do { ?>
                                                <option value="<?PHP echo $row_MARCA['id_marca']; ?>"><?PHP echo $row_MARCA['descripcion']; ?></option>
                                            <?PHP } while ($row_MARCA = $productos_MARCA->fetch(PDO::FETCH_ASSOC)); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary" id="agregar">Guardar</button>
                        </div>
                    </div>
                </form>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- jQuery -->
        <script src="vendor/jquery/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="vendor/metisMenu/metisMenu.min.js"></script>

        <!-- DataTables JavaScript -->
        <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
        <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="dist/js/sb-admin-2.js"></script>

        <script src="validate/jquery.validate.js"></script>

        <script src="js/scripts.js"></script>


    </body>

</html>
