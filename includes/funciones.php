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

function obtenerNombreUsuario($param) {
    global $conex;

    $SQL = "SELECT * FROM ADMIN_TABLE WHERE ID_ADMIN =  %s";
    $consultaFuncion = sprintf($SQL, $param);
    $consulta = mysqli_query($conex, $consultaFuncion) or die(mysqli_errno($conex));
    $row = mysqli_fetch_assoc($consulta);
    //$totalRow = mysqli_num_rows($consulta);
    $resultado = $row['user_name'] . "<br>";
    mysqli_free_result($consulta);
    return $resultado;
}

function obtenerEstado($id) {
    if ($id == 1) {
        echo 'Activo';
    }
    if ($id == 2) {
        echo 'Inactivo';
    }
}
?>