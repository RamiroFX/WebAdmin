<?php require_once '../Connections/conex.php'; ?>
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
?>

<?php

$loginFormAction = $_SERVER['PHP_SELF'];

if (isset($_GET['accesscheck'])) {
    $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}
if ((isset($_POST['formid'])) && (isset($_POST['formid']) == 1)) {
    $UserEmail = $_POST['email'];
    $UserPassword = $_POST['password'];
    if (!isset($_SESSION)) {
        session_start();
    }


    $LoginRS_Query = sprintf("SELECT * FROM ADMIN_TABLE WHERE  email =%s AND password=%s", GetSQLValueString($UserEmail, "text"), GetSQLValueString($UserPassword, "text"));
    $LoginRS = mysqli_query($conex, $LoginRS_Query) or die(mysqli_error());
    $row_LoginRS = mysqli_fetch_assoc($LoginRS);
    $loginFoundUser = mysqli_num_rows($LoginRS);
    if ($loginFoundUser) {
        $loginStrGroup = "";

        if (PHP_VERSION >= 5.1) {
            session_regenerate_id(TRUE);
        } else {
            session_regenerate_id();
        }
        $_SESSION['MM_UsernameAdmin'] = $UserEmail;
        $_SESSION['MM_UserGroupAdmin'] = $loginStrGroup;
        $_SESSION['MM_idAdmin'] = $row_LoginRS['id_admin'];
    }
    if ($loginFoundUser == 0) {
        echo 0;
    }
    if ($loginFoundUser == 1) {
        echo 1;
    }
}
?>

