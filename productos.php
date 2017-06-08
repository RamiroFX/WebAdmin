<?php require_once 'Connections/conex.php'; ?>
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
    /* $MM_qsChar = "?";
      $MM_referrer = $_SERVER['PHP_SELF'];
      if (strpos($MM_restrictGoTo, "?")) {
      $MM_qsChar = "&";
      }
      if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) {
      $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
      }
      $MM_restrictGoTo = $MM_restrictGoTo . $$MM_qsChar . "accesscheck=" . urldecode($MM_referrer); */
    header("Location: " . $MM_restrictGoTo);
    exit();
}
?>
<?php
if (!function_exists("GetSQLValueString")) {

    function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") {

        if (PHP_VERSION < 6) {
            $theValue = get_magic_quotes_gpc() ? stripcslashes($theValue) : $theValue;
        }
        global $conex;
        $theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($conex, $theValue) : mysqli_escape_string($conex, $theValue);
        switch ($theType) {
            case "text":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "long":
            case "int":
                $theValue = ($theValue != "") ? intval($theValue) : "NULL";
                break;
            case "double":
                $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
                break;
            case "date":
                $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
                break;
            case "defined":
                $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
                break;
        }
        return $theValue;
    }

}
$SQL = "SELECT * FROM PRODUCTO ORDER BY DESCRIPCION ASC";
$productos = mysqli_query($conex, $SQL) or die(mysqli_error($conex));
$row_productos = mysqli_fetch_assoc($productos);
$total_row_productos = mysqli_num_rows($productos);
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

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <?php include("includes/header.php"); ?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Productos</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Listado de productos
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Stock</th>
                                            <th>Categoría</th>
                                            <th>Estado</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?PHP do { ?>
                                            <tr class="odd gradeX">
                                                <td> <?php echo $row_productos['descripcion']; ?> </td>
                                                <td> <?php echo $row_productos['cant_actual']; ?> </td>
                                                <td> <?php echo $row_productos['categoria']; ?> </td>
                                                <td class="center">
                                                    <?php if ($row_productos['id_estado_producto'] == 1) { ?>
                                                        <form action="actualizarEstado.php" method="post">
                                                            <button type="submit" class="btn btn-success"><?php obtenerEstado($row_productos['id_estado_producto']); ?></td></button>
                                                            <input name="id_producto" type="hidden" value="<?php echo $row_productos['id_producto']; ?>">
                                                            <input name="actualiza" type="hidden" value="1">
                                                            <input name="id_estado_producto" type="hidden" value="2">
                                                        </form>
                                                    <?php } ?>
                                                    <?php if ($row_productos['id_estado_producto'] == 2) { ?>
                                                        <form action="actualizarEstado.php" method="post">
                                                            <button type="submit" class="btn btn-danger"><?php obtenerEstado($row_productos['id_estado_producto']); ?></td></button>
                                                            <input name="id_producto" type="hidden" value="<?php echo $row_productos['id_producto']; ?>">
                                                            <input name="actualiza" type="hidden" value="1">
                                                            <input name="id_estado_producto" type="hidden" value="1">
                                                        </form>
                                        <?php } ?>
                                        <td class="center">
                                            <button type="button" class="btn btn-info"><i class="fa fa-file-image-o"></i></button>
                                            <button type="button" class="btn btn-warning"><i class="fa fa-pencil-square-o"></i></button>
                                            <button type="button" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
                                        </td>
                                        </tr>
                                    <?php } while ($row_productos = mysqli_fetch_assoc($productos)); ?>
                                    </tbody>
                                </table>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-12 -->
                </div>

            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

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

        <!-- Page-Level Demo Scripts - Tables - Use for reference -->
        <script>
            $(document).ready(function () {
                $('#dataTables-example').DataTable({
                    responsive: true
                });
            });
        </script>

    </body>

</html>
