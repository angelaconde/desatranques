<?php

function getProvincias($con)
{
    $sql = 'SELECT cod, nombre FROM provincias';
    $stmtProv = $con->prepare($sql);
    $stmtProv->execute();
    $provincias[] = $stmtProv->fetch(PDO::FETCH_ASSOC);
    return $provincias;
}

function provCodANombre($con, $cod)
{
    $sql = 'SELECT nombre FROM provincias where cod = ?';
    $stmtProv = $con->prepare($sql);
    $stmtProv->execute([$cod]);
    $nombreProvincia = $stmtProv->fetchColumn();
    return $nombreProvincia;
}
