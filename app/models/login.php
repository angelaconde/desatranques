<?php

function validarUsuario($usuario, $pass)
{
    // CONEXION A LA BASE DE DATOS
    include MODEL_PATH . 'connection.php';
    $con = DB::getcon();

    $usuarioExiste = false;
    $bloqueado = false;
    $intentos = 0;

    if ($usuario != "" && $pass != "") {
        // COMPROBAR SI EL USUARIO EXISTE
        $sql_query2 = "select count(*) as numero_usuarios from usuarios where usuario='$usuario'";
        $result2 = $con->prepare($sql_query2);
        $result2->execute();
        $row2 = $result2->fetch(PDO::FETCH_ASSOC);
        $usuarioExiste = ($row2['numero_usuarios'] == 0) ? false : true;
        // SI NO EXISTE, ERROR
        if (!$usuarioExiste) {
            $loginInfo = ['estado' => 'usuario_no_existe', 'usuario' => '', 'tipo' => ''];
            return $loginInfo;
            // SI EXISTE
        } else {
            // COMPROBAR BLOQUEO
            $sql_query3 = "select intentos_fallidos from usuarios where usuario='$usuario'";
            $result3 = $con->prepare($sql_query3);
            $result3->execute();
            $row3 = $result3->fetch(PDO::FETCH_ASSOC);
            $intentos = $row3['intentos_fallidos'];
            $bloqueado = ($intentos == 3) ? true : false;
            // SI ESTÁ BLOQUEADO, COMPROBAR SI HAN TRANSCURRIDO 10 MINUTOS
            if ($bloqueado) {
                $sql_query4 = "select fecha_bloqueo from usuarios where usuario='$usuario'";
                $result4 = $con->prepare($sql_query4);
                $result4->execute();
                $row4 = $result4->fetch(PDO::FETCH_ASSOC);
                $fechaBloqueo = $row4['fecha_bloqueo'];
                // SI HAN TRANSCURRIDO 10 MINUTOS
                if (((time() - strtotime($fechaBloqueo)) / 60) > 10) {
                    // REINICIAR CONTADOR DE INTENTOS FALLIDOS
                    $sql_query5 = "update usuarios set intentos_fallidos = '0' where usuario='$usuario'";
                    $con->prepare($sql_query5)->execute();
                    // DESBLOQUEAR
                    $bloqueado = false;
                    // COMPROBAR USUARIO Y CONTRASEÑA
                    $sql_query1 = "select count(*) as numero_usuarios from usuarios where usuario='$usuario' and pass='$pass'";
                    $result1 = $con->prepare($sql_query1);
                    $result1->execute();
                    $row1 = $result1->fetch(PDO::FETCH_ASSOC);
                    $count1 = $row1['numero_usuarios'];
                    // EN CASO DE QUE USUARIO Y CONTRASEÑA SEAN CORRECTOS
                    if ($count1 > 0) {
                        // session_start();
                        // GUARDAR NOMBRE Y TIPO EN LA SESION
                        $sql_query8 = "select nombre, tipo from usuarios where usuario='$usuario'";
                        $result8 = $con->prepare($sql_query8);
                        $result8->execute();
                        $datosUsuario = $result8->fetch(PDO::FETCH_ASSOC);
                        $loginInfo = ['estado' => 'correcto', 'usuario' => $datosUsuario['nombre'], 'tipo' => $datosUsuario['tipo']];
                        // $_SESSION['usuario'] = $datosUsuario['usuario'];
                        // $_SESSION['tipo'] = $datosUsuario['tipo'];
                        // REINICIAR CONTADOR DE INTENTOS FALLIDOS
                        $sql_query6 = "update usuarios set intentos_fallidos = '0' where usuario='$usuario'";
                        $con->prepare($sql_query6)->execute();
                        return $loginInfo;
                        // EN CASO DE QUE USUARIO Y CONTRASEÑA NO SEAN CORRECTOS
                    } else {
                        // SUMAR 1 AL NUMERO DE INTENTOS FALLIDOS
                        $intentos_insertar = ++$intentos;
                        $sql_query6 = "update usuarios set intentos_fallidos = '$intentos_insertar' where usuario='$usuario'";
                        $con->prepare($sql_query6)->execute();
                        $loginInfo = ['estado' => 'pass_incorrecta', 'usuario' => '', 'tipo' => ''];
                        return $loginInfo;
                        // SI EL NUMERO DE INTENTOS ES 3, GUARDAR LA FECHA Y HORA
                        if ($intentos_insertar == 3) {
                            $sql_query7 = "update usuarios set fecha_bloqueo = NOW() where usuario='$usuario'";
                            $con->prepare($sql_query7)->execute();
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
                $sql_query1 = "select count(*) as numero_usuarios from usuarios where usuario='$usuario' and pass='$pass'";
                $result1 = $con->prepare($sql_query1);
                $result1->execute();
                $row1 = $result1->fetch(PDO::FETCH_ASSOC);
                $count1 = $row1['numero_usuarios'];
                // EN CASO DE QUE USUARIO Y CONTRASEÑA SEAN CORRECTOS
                if ($count1 > 0) {
                    // session_start();
                    // GUARDAR NOMBRE Y TIPO EN LA SESION
                    $sql_query8 = "select nombre, tipo from usuarios where usuario='$usuario'";
                    $result8 = $con->prepare($sql_query8);
                    $result8->execute();
                    $datosUsuario = $result8->fetch(PDO::FETCH_ASSOC);
                    $loginInfo = ['estado' => 'correcto', 'usuario' => $datosUsuario['nombre'], 'tipo' => $datosUsuario['tipo']];
                    // $_SESSION['usuario'] = $datosUsuario['usuario'];
                    // $_SESSION['tipo'] = $datosUsuario['tipo'];
                    // REINICIAR CONTADOR DE INTENTOS FALLIDOS
                    $sql_query6 = "update usuarios set intentos_fallidos = '0' where usuario='$usuario'";
                    $con->prepare($sql_query6)->execute();
                    return $loginInfo;
                    // EN CASO DE QUE USUARIO Y CONTRASEÑA NO SEAN CORRECTOS
                } else {
                    // SUMAR 1 AL NUMERO DE INTENTOS FALLIDOS
                    $intentos_insertar = ++$intentos;
                    $sql_query6 = "update usuarios set intentos_fallidos = '$intentos_insertar' where usuario='$usuario'";
                    $con->prepare($sql_query6)->execute();
                    $loginInfo = ['estado' => 'pass_incorrecta', 'usuario' => '', 'tipo' => ''];
                    return $loginInfo;
                    // SI EL NUMERO DE INTENTOS ES 3, GUARDAR LA FECHA Y HORA
                    if ($intentos_insertar == 3) {
                        $sql_query7 = "update usuarios set fecha_bloqueo = NOW() where usuario='$usuario'";
                        $con->prepare($sql_query7)->execute();
                    }
                }
            }
        }
    } else {
        $loginInfo = ['estado' => 'formulario_incompleto', 'usuario' => '', 'tipo' => ''];
        return $loginInfo;
    }
}
