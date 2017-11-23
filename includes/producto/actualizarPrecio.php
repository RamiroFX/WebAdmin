<?php require_once 'Connections/conex2.php'; ?>
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

if ((isset($_POST['actualiza'])) && ($_POST['actualiza'] == "2")) {
    $id_producto = $_POST['id_producto'];
    $precio = $_POST['precio'];
    $SQL = "UPDATE  PRODUCTO SET precio_minorista = :precio WHERE ID_PRODUCTO = :id_producto";
    $conex->prepare($SQL)->execute([$precio, $id_producto]);

    $updateToGo = "productos.php";
    header(sprintf("Location: %s", $updateToGo));
}
?>