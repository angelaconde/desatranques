<?php

use Jenssegers\Blade\Blade;

include_once MODEL_PATH . 'login.php';

class Usuario
{
    protected $blade = null;

    public function __construct()
    {
        $this->blade = new Blade(VIEW_PATH, CACHE_PATH);
    }

    /**
     * Devuelve un objeto de tipo Usuario
     *
     * @return void
     */
    public static function getInstance()
    {
        return new self();
    }

    // LOGIN
    public function login()
    {
        try {
            $error = '';
            if ($_POST) {
                $usuario = $_POST['usuario'];
                $pass = $_POST['password'];
                $error = '';
                $validacion = validarUsuario($usuario, $pass);
                if ($validacion['estado'] == 'correcto'){
                    $_SESSION['usuario'] = $validacion['usuario'];
                    $_SESSION['tipo'] = $validacion['tipo'];
                    $_SESSION['fecha'] = date('Y-m-d H:i:s');
                    return Tareas::getInstance()->Inicio();
                } else if ($validacion['estado'] == 'formulario_incompleto'){
                    $error = 'Debe introducir usuario y contraseña.';
                    return $this->blade->render('login', ['error' => $error]);
                } else if ($validacion['estado'] == 'usuario_bloqueado'){
                    $error = 'Su usuario ha sido bloqueado. Por favor espere 10 minutos.';
                    return $this->blade->render('login', ['error' => $error]);
                } else if ($validacion['estado'] == 'pass_incorrecta'){
                    $error = 'Contraseña incorrecta.';
                    return $this->blade->render('login', ['error' => $error]);
                } else if ($validacion['estado'] == 'usuario_no_existe'){
                    $error = 'El usuario no existe.';
                    return $this->blade->render('login', ['error' => $error]);
                }
            } else {
                return $this->blade->render('login', ['error' => $error]);
            }
        } catch (Exception $ex) {
            return $this->blade->render('acceso_negado');
        }
    }

    // LOGOUT
    public function logout(){
        session_unset(); 
        session_destroy();
        header('Location: login');
        exit;
    }
}
