<?php

use Jenssegers\Blade\Blade;

include(HELPERS_PATH . 'validaciones.php');
include(MODEL_PATH . 'tareas.php');

class Tareas
{
    protected $model = null;
    protected $errores = null;
    protected $blade = null;

    public function __construct()
    {
        // $this->model = new Tareas_Modelo();
        $this->blade = new Blade(VIEW_PATH, CACHE_PATH);
    }

    /**
     * Devuelve un objeto de tipo Tareas
     *
     * @return void
     */
    public static function getInstance()
    {
        return new self();
    }

    /**
     * Muestra la página de Inicio
     */
    public function Inicio()
    {
        return $this->blade->render('inicio', ['usuario' => $_SESSION['usuario']]);
    }


    /**
     * Muestra la lista de tareas
     */
    public function Listar()
    {
        return $this->blade->render('lista');
    }

    /**
     * Permite modificar una tarea seleccionada
     *
     * @return void
     */
    public function Edit()
    {
        if (!isset($_GET['tarea_id'])) {
            return $this->blade->render('editar_error');
        } else {
            $id = $_GET['tarea_id'];
            return $this->blade->render('editar');
        }
    }

    /**
     * Añade una nueva tarea
     * @return type
     */
    public function Add()
    {
        return $this->blade->render('crear');
    }

    // BORRAR TAREA
    public function Del()
    {
        try {
            if (isset($_GET['tarea_id'])) {
                $tarea_id = $_GET['tarea_id'];
                return $this->blade->render('eliminar', ['tarea_id' => $tarea_id]);
            } else {
                return $this->blade->render('eliminar_error');
            }
        } catch (Exception $ex) {
            return $this->blade->render('eliminar_error');
        }
    }

    // CONFIRMAR BORRAR
    public function confDel()
    {
        try {
            if (isset($_GET['tarea_id'])) {
                $tarea_id = $_GET['tarea_id'];
                return $this->blade->render('confirmar_borrado', ['tarea_id' => $tarea_id]);
            } else {
                return $this->blade->render('eliminar_error');
            }
        } catch (Exception $ex) {
            return $this->blade->render('eliminar_error');
        }
    }

    // VER DATOS DE UNA TAREA
    public function verTarea()
    {
        try {
            if (isset($_GET['tarea_id'])) {
                $tarea_id = $_GET['tarea_id'];
                return $this->blade->render('tarea', ['tarea_id' => $tarea_id]);
            } else {
                return $this->blade->render('tarea_error');
            }
        } catch (Exception $ex) {
            return $this->blade->render('tarea_error');
        }
    }

}
