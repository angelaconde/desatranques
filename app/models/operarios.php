<?php

/**
 * Modelo de operarios
 * 
 * @author Angela Conde
 */

/**
 * Función para obtener la lista de nombres de operarios de la base de datos
 * 
 * @return array
 */
function getOperarios()
{
    $con = DB::getcon();
    $sql = 'SELECT nombre FROM usuarios WHERE tipo = "operario"';
    foreach ($con->query($sql) as $operario) {
        $listaOperarios[] = $operario;
    }
    return $listaOperarios;
}
