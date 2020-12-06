<?php

include_once MODEL_PATH . 'connection.php';

/**
 * Función para obtener la lista de provincias de la base de datos
 * 
 * @return array
 */
function getProvincias()
{
    $con = DB::getcon();
    $sql = 'SELECT * FROM provincias';
    foreach ($con->query($sql) as $provincia) {
        $listaProvincias[] = $provincia;
    }
    return $listaProvincias;
}

/** 
 * Función para convertir el código de provincia a nombre
 * 
 * @return string
 */
function provCodANombre($cod)
{
    $con = DB::getcon();
    $sql = 'SELECT nombre FROM provincias where cod = ?';
    $stmtProv = $con->prepare($sql);
    $stmtProv->execute([$cod]);
    $nombreProvincia = $stmtProv->fetchColumn();
    return $nombreProvincia;
}
