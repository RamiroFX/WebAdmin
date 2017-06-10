<?php

function obtenerNombreUsuario($idAdmin) {
    global $conex;

    $SQL = "SELECT * FROM FUNCIONARIO WHERE ID_FUNCIONARIO =  :idAdmin";
    $stmt = $conex->prepare($SQL);
    $stmt->execute([$idAdmin]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $resultado = $row['alias'] . "<br>";
    $stmt->closeCursor();
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