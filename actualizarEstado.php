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
if ((isset($_POST['actualiza'])) && ($_POST['actualiza'] == "1")) {
    $id_producto = $_POST['id_producto'];
    $id_estado = $_POST['id_estado_producto'];
    $SQL = sprintf("UPDATE  PRODUCTO SET ID_ESTADO_PRODUCTO = %s WHERE ID_PRODUCTO = %s", 
            GetSQLValueString($id_estado, "int"), GetSQLValueString($id_producto, "int"));

    $result = mysqli_query($conex, $SQL) or die(mysqli_error($conex));

    $updateToGo = "productos.php";
    header(sprintf("Location: %s", $updateToGo));
}
?>