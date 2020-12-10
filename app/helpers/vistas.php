<?php

/**
 * Funciones para mejorar las vistas
 * 
 * @author Angela Conde
 */

/**
 * Convierte el estado de sigla a palabra completa
 * 
 * @param string $estado
 * @return string
 */
function formatearEstado($estado)
{
    switch ($estado) {
        case 'P':
            $estado = 'Pendiente';
            break;
        case 'R':
            $estado = 'Realizada';
            break;
        case 'C':
            $estado = 'Cancelada';
            break;
    }
    return $estado;
}
