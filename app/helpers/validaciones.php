<?php

function validarTelefono($telefono)
{
    $telefono = str_replace(' ', '', $telefono);
    $telefono = str_replace('-', '', $telefono);

    $expresion = '/^[9|8|6|7][0-9]{8}$/';

    if (preg_match($expresion, $telefono)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

function validarEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL))
        return TRUE;
    else
        return FALSE;
}

function validarCP($cp)
{
    $patron = '/^[0-9]{5}$/'; 

    if (preg_match($patron, $cp))
        return TRUE;
    else
        return FALSE;
}

function validarFormatoFecha($fecha)
{
    $DIA = 0;
    $MES = 1;
    $YEAR = 2;

    $array_fecha = explode("/", $fecha);

    if (count($array_fecha) != 3)
        return FALSE;

    else {
        $dia = $array_fecha[$DIA];
        $mes = $array_fecha[$MES];
        $year = $array_fecha[$YEAR];

        return checkdate($mes, $dia, $year);
    }
}

function validarFecha($fecha)
{
    if (validarFormatoFecha($fecha)) {
        if (strtotime($fecha) > strtotime(date('d-m-Y')))
            return TRUE;
        else
            return FALSE;
    } else
        return FALSE;
}

function validarSelects($option)
{
    if($option == "" ){
        return FALSE;
    } else {
        return TRUE;
    }
}

function valorPost($nombreCampo, $valorPorDefecto = '')
{
    if (isset($_POST[$nombreCampo]))
        return $_POST[$nombreCampo];
    else
        return $valorPorDefecto;
}

function verError($campo, $errores)
{
    if (isset($errores[$campo])) {
        echo '<div class="alert alert-danger">';
        echo $errores[$campo];
        echo '</div>';
    }
}
