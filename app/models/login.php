<?php

/**
 * Función que comprueba las credenciales del usuario
 * 
 * @return array
 */
function validarUsuario($usuario, $pass)
{
    include_once MODEL_PATH . 'connection.php';
    $con = DB::getcon();

    $usuarioExiste = false;
    $bloqueado = false;
    $intentos = 0;

    if ($usuario != "" && $pass != "") {
        // COMPROBAR SI EL USUARIO EXISTE
        $sql_query = "select count(*) as numero_usuarios from usuarios where usuario='$usuario'";
        $result = $con->prepare($sql_query);
        $result->execute();
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $usuarioExiste = ($row['numero_usuarios'] == 0) ? false : true;
        // SI NO EXISTE, ERROR
        if (!$usuarioExiste) {
            $loginInfo = ['estado' => 'usuario_no_existe', 'usuario' => '', 'tipo' => ''];
            return $loginInfo;
        // SI EXISTE
        } else {
            // COMPROBAR BLOQUEO
            $sql_query = "select intentos_fallidos from usuarios where usuario='$usuario'";
            $result = $con->prepare($sql_query);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC);
            $intentos = $row['intentos_fallidos'];
            $bloqueado = ($intentos == 3) ? true : false;
            // SI ESTÁ BLOQUEADO, COMPROBAR SI HAN TRANSCURRIDO 10 MINUTOS
            if ($bloqueado) {
                $sql_query = "select fecha_bloqueo from usuarios where usuario='$usuario'";
                $result = $con->prepare($sql_query);
                $result->execute();
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $fechaBloqueo = $row['fecha_bloqueo'];
                // SI HAN TRANSCURRIDO 10 MINUTOS
                if (((time() - strtotime($fechaBloqueo)) / 60) > 10) {
                    // REINICIAR CONTADOR DE INTENTOS FALLIDOS
                    $sql_query = "update usuarios set intentos_fallidos = '0' where usuario='$usuario'";
                    $con->prepare($sql_query)->execute();
                    // DESBLOQUEAR
                    $bloqueado = false;
                    // COMPROBAR USUARIO Y CONTRASEÑA
                    $sql_query = "select count(*) as numero_usuarios from usuarios where usuario='$usuario' and pass='$pass'";
                    $result = $con->prepare($sql_query);
                    $result->execute();
                    $row = $result->fetch(PDO::FETCH_ASSOC);
                    $count1 = $row['numero_usuarios'];
                    // EN CASO DE QUE USUARIO Y CONTRASEÑA SEAN CORRECTOS
                    if ($count1 > 0) {
                        $sql_query = "select nombre, tipo from usuarios where usuario='$usuario'";
                        $result = $con->prepare($sql_query);
                        $result->execute();
                        $datosUsuario = $result->fetch(PDO::FETCH_ASSOC);
                        $loginInfo = ['estado' => 'correcto', 'usuario' => $datosUsuario['nombre'], 'tipo' => $datosUsuario['tipo']];
                        // REINICIAR CONTADOR DE INTENTOS FALLIDOS
                        $sql_query = "update usuarios set intentos_fallidos = '0' where usuario='$usuario'";
                        $con->prepare($sql_query)->execute();
                        return $loginInfo;
                    // EN CASO DE QUE USUARIO Y CONTRASEÑA NO SEAN CORRECTOS
                    } else {
                        // SUMAR 1 AL NUMERO DE INTENTOS FALLIDOS
                        $intentos_insertar = ++$intentos;
                        $sql_query = "update usuarios set intentos_fallidos = '$intentos_insertar' where usuario='$usuario'";
                        $con->prepare($sql_query)->execute();
                        $loginInfo = ['estado' => 'pass_incorrecta', 'usuario' => '', 'tipo' => ''];
                        return $loginInfo;
                        // SI EL NUMERO DE INTENTOS ES 3, GUARDAR LA FECHA Y HORA
                        if ($intentos_insertar == 3) {
                            $sql_query = "update usuarios set fecha_bloqueo = NOW() where usuario='$usuario'";
                            $con->prepare($sql_query)->execute();
                        }
                    }
                // SI NO HAN TRANSCURRIDO LOS 10 MINUTOS    
                } else {
                    $loginInfo = ['estado' => 'usuario_bloqueado', 'usuario' => '', 'tipo' => ''];
                    return $loginInfo;
                }
            // SI ESTÁ DESBLOQUEADO
            } else {
                // COMPROBAR USUARIO Y CONTRASEÑA
                $sql_query = "select count(*) as numero_usuarios from usuarios where usuario='$usuario' and pass='$pass'";
                $result = $con->prepare($sql_query);
                $result->execute();
                $row = $result->fetch(PDO::FETCH_ASSOC);
                $count1 = $row['numero_usuarios'];
                // EN CASO DE QUE USUARIO Y CONTRASEÑA SEAN CORRECTOS
                if ($count1 > 0) {
                    $sql_query = "select nombre, tipo from usuarios where usuario='$usuario'";
                    $result = $con->prepare($sql_query);
                    $result->execute();
                    $datosUsuario = $result->fetch(PDO::FETCH_ASSOC);
                    $loginInfo = ['estado' => 'correcto', 'usuario' => $datosUsuario['nombre'], 'tipo' => $datosUsuario['tipo']];
                    // REINICIAR CONTADOR DE INTENTOS FALLIDOS
                    $sql_query = "update usuarios set intentos_fallidos = '0' where usuario='$usuario'";
                    $con->prepare($sql_query)->execute();
                    return $loginInfo;
                // EN CASO DE QUE USUARIO Y CONTRASEÑA NO SEAN CORRECTOS
                } else {
                    // SUMAR 1 AL NUMERO DE INTENTOS FALLIDOS
                    $intentos_insertar = ++$intentos;
                    $sql_query = "update usuarios set intentos_fallidos = '$intentos_insertar' where usuario='$usuario'";
                    $con->prepare($sql_query)->execute();
                    $loginInfo = ['estado' => 'pass_incorrecta', 'usuario' => '', 'tipo' => ''];
                    return $loginInfo;
                    // SI EL NUMERO DE INTENTOS ES 3, GUARDAR LA FECHA Y HORA
                    if ($intentos_insertar == 3) {
                        $sql_query = "update usuarios set fecha_bloqueo = NOW() where usuario='$usuario'";
                        $con->prepare($sql_query)->execute();
                    }
                }
            }
        }
    } else {
        $loginInfo = ['estado' => 'formulario_incompleto', 'usuario' => '', 'tipo' => ''];
        return $loginInfo;
    }
}
