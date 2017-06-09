<?php

function obtenerNombreUsuario($idAdmin) {
    global $conex;

    $SQL = "SELECT * FROM ADMIN_TABLE WHERE ID_ADMIN =  :idAdmin";
    $consultaFuncion = sprintf($SQL, $param);
    $consulta = mysqli_query($conex, $consultaFuncion) or die(mysqli_errno($conex));
    $row = mysqli_fetch_assoc($consulta);
    //$totalRow = mysqli_num_rows($consulta);
    $resultado = $row['user_name'] . "<br>";
    mysqli_free_result($consulta);


    $stmt = $conex->prepare($SQL);
    $stmt->execute([$idAdmin]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $resultado = $row['user_name'] . "<br>";
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