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
$idProducto = filter_input(INPUT_GET, 'idProducto', FILTER_SANITIZE_NUMBER_INT);
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
        <link href="dist/css/fileinput.min.css" rel="stylesheet" type="text/css">

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
                        <h1 class="page-header">Agregar imágenes</h1>
                        <div class="form-group">
                            <form enctype="multipart/form-data">
                                <input id="archivos" name="imagenes[]" type="file" multiple=true class="file-loading">
                            </form>
                        </div>
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

        <script src="dist/js/fileinput.min.js"></script>
        <script>
            $('#archivos').fileinput({                
                uploadUrl: "includes/upload.php?idProducto=<?php echo $idProducto ?>",
                uploadAsync: false,
                language: "es",
                uploadMin: 1,
                uploadMax: 3,
                showRemove: false,
                showUpload: false,
                allowedFileExtensions: ["jpg"],
<?php
$SQL_IMAGENES = "SELECT * FROM PRODUCTO_IMAGENES WHERE ID_PRODUCTO_IMAGENES = ?";
$stmt = $conex->prepare($SQL_IMAGENES);
$stmt->execute([$idProducto]);
$stmt->fetchAll(PDO::FETCH_ASSOC);
if ($stmt) {
    foreach ($stmt as $value) {
        require_once 'includes/class.imgsizer.php';
        $imgSizer = new imgSizer();
        $imgSizer->type = "width";
        $imgSizer->max = 160;
        $imgSizer->quality = 8;
        $imgSizer->square = true;
        $imgSizer->prefix = "miniatura_";
        $imgSizer->folder = "_min";
        $imgSizer->image = "/webadmin/imagenes/productos/" . $value['imagen'];
        $imgSizer->resize();
        echo"<img src=\'/webadmin/imagenes/productos/_min/miniatura_" . $value['imagen'] . ' height=\'120px\' class=\'file-preview-image\'>';
    }
}
?>
                initialPreviewConfig: [
<?php
foreach ($stmt as $value) {
    $infoImagenes = $value['imagen'];
    $idImagen = $value['id_producto_imagenes'];
    echo"{caption: \"" . $infoImagenes . ". height:\"120px\", url: \"includes/borrar.php\", key: " . $idImagen . "\"}";
}
?>
                ]
            }).on("filebatchselected", function(event, files) {
                $("#archivos").fileinput("upload");
            });
        </script>

    </body>

</html>
