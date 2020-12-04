<?php

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
