<?php

/**
 * Valida números de teléfono
 * 
 * @return boolean
 */
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

/**
 * Valida email
 * 
 * @return boolean
 */
function validarEmail($email)
{
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

/**
 * Valida código postal
 * 
 * @return boolean
 */
function validarCP($cp)
{
    $patron = '/^[0-9]{5}$/';

    if (preg_match($patron, $cp)) {
        return TRUE;
    } else {
        return FALSE;
    }
}

/**
 * Valida formato de fecha
 * 
 * @return boolean
 */
function validarFormatoFecha($fecha)
{
    $DIA = 0;
    $MES = 1;
    $YEAR = 2;
    $array_fecha = explode("/", $fecha);

    if (count($array_fecha) != 3) {
        return FALSE;
    } else {
        $dia = $array_fecha[$DIA];
        $mes = $array_fecha[$MES];
        $year = $array_fecha[$YEAR];
        return checkdate($mes, $dia, $year);
    }
}

/**
 * Valida que la fecha sea posterior a la actual
 * 
 * @return boolean
 */
function validarFecha($fecha)
{
    if (validarFormatoFecha($fecha)) {
        if (strtotime($fecha) > strtotime(date('d-m-Y'))) {
            return TRUE;
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

/**
 * Valida que se haya seleccionado una opción del select
 * 
 * @return boolean
 */
function validarSelects($option)
{
    if ($option == "") {
        return FALSE;
    } else {
        return TRUE;
    }
}

/**
 * Comprueba que se haya recibido un valor para el campo
 * y en caso negativo lo crea vacío
 * 
 * @return string
 */
function valorPost($nombreCampo, $valorPorDefecto = '')
{
    if (isset($_POST[$nombreCampo]))
        return $_POST[$nombreCampo];
    else
        return $valorPorDefecto;
}

/**
 * Muestra errores
 * 
 * @return void
 */
function verError($campo, $errores)
{
    if (isset($errores[$campo])) {
        echo '<div class="alert alert-danger">';
        echo $errores[$campo];
        echo '</div>';
    }
}
