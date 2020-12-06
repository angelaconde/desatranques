<?php
/**
 * Función para obtener la lista de operarios de la base de datos
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