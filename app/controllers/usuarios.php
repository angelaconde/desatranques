<?php

/**
 * Controlador de Usuarios
 * 
 * @author Angela Conde
 */

use Jenssegers\Blade\Blade;

include_once MODEL_PATH . 'login.php';

/**
 * Clase Usuario
 */
class Usuario
{
    protected $blade = null;

    /**
     * Constructor de la clase Usuario
     * 
     * @return Blade
     */
    public function __construct()
    {
        $this->blade = new Blade(VIEW_PATH, CACHE_PATH);
    }

    /**
     * Devuelve un objeto de tipo Usuario
     *
     * @return Usuario
     */
    public static function getInstance()
    {
        return new self();
    }

    /**
     * Función para iniciar sesión
     * 
     * @return void
     */
    public function login()
    {
        try {
            $error = '';
            if ($_POST) {
                $usuario = $_POST['usuario'];
                $pass = $_POST['password'];
                $error = '';
                $validacion = validarUsuario($usuario, $pass);
                if ($validacion['estado'] == 'correcto') {
                    $_SESSION['usuario'] = $validacion['usuario'];
                    $_SESSION['tipo'] = $validacion['tipo'];
                    $_SESSION['fecha'] = date('Y-m-d H:i:s');
                    return Tareas::getInstance()->Inicio();
                } else if ($validacion['estado'] == 'formulario_incompleto') {
                    $error = 'Debe introducir usuario y contraseña.';
                    return $this->blade->render('login', ['error' => $error]);
                } else if ($validacion['estado'] == 'usuario_bloqueado') {
                    $error = 'Su usuario ha sido bloqueado. Por favor espere 10 minutos.';
                    return $this->blade->render('login', ['error' => $error]);
                } else if ($validacion['estado'] == 'pass_incorrecta') {
                    $error = 'Contraseña incorrecta.';
                    return $this->blade->render('login', ['error' => $error]);
                } else if ($validacion['estado'] == 'usuario_no_existe') {
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

    /**
     * Función para finalizar sesión
     * 
     * @return void
     */
    public function logout()
    {
        session_unset();
        session_destroy();
        header('Location: login');
        exit;
    }
}
