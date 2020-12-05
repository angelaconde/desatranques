<?php

// CONEXION A LA BASE DE DATOS
include_once MODEL_PATH . 'connection.php';

function getProvincias()
{
    $con = DB::getcon();
    $sql = 'SELECT cod, nombre FROM provincias';
    $stmtProv = $con->prepare($sql);
    $stmtProv->execute();
    $provincias[] = $stmtProv->fetch(PDO::FETCH_ASSOC);
    return $provincias;
}

function provCodANombre($cod)
{
    $con = DB::getcon();
    $sql = 'SELECT nombre FROM provincias where cod = ?';
    $stmtProv = $con->prepare($sql);
    $stmtProv->execute([$cod]);
    $nombreProvincia = $stmtProv->fetchColumn();
    return $nombreProvincia;
}
