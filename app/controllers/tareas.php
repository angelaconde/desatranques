<?php

use Jenssegers\Blade\Blade;

include(HELPERS_PATH . 'validaciones.php');
include(MODEL_PATH . 'tareas.php');

class Tareas
{
    protected $blade = null;

    /**
     * Constructor de la clase Tareas
     * 
     * @return Blade
     */
    public function __construct()
    {
        $this->blade = new Blade(VIEW_PATH, CACHE_PATH);
    }

    /**
     * Devuelve una instancia de la clase Tareas
     *
     * @return Tareas
     */
    public static function getInstance()
    {
        return new self();
    }

    /**
     * Muestra la página de inicio
     * 
     * @return void
     */
    public function Inicio()
    {
        return $this->blade->render('inicio', ['usuario' => $_SESSION['usuario']]);
    }

    /**
     * Muestra la lista de tareas
     * 
     * @return void
     */
    public function Listar()
    {
        if (isset($_SESSION['usuario'])) {
            return $this->blade->render('lista');
        } else {
            header('Location: login');
            exit;
        }
    }

    /**
     * Muestra añadir tarea
     * 
     * @return void
     */
    public function Add()
    {
        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['tipo'] != 'administrativo') {
                return $this->blade->render('acceso_negado');
            } else {
                return $this->blade->render('crear');
            }
        } else {
            header('Location: login');
            exit;
        }
    }

    /**
     * Muestra borrar tarea
     * 
     * @return void
     */
    public function Del()
    {
        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['tipo'] != 'administrativo') {
                return $this->blade->render('acceso_negado');
            } else {
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
        } else {
            header('Location: login');
            exit;
        }
    }

    /**
     * Muestra confirmar borrado de tarea
     * 
     * @return void
     */
    public function confDel()
    {
        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['tipo'] != 'administrativo') {
                return $this->blade->render('acceso_negado');
            } else {
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
        } else {
            header('Location: login');
            exit;
        }
    }

    /**
     * Muestra tarea
     * 
     * @return void
     */
    public function verTarea()
    {
        if (isset($_SESSION['usuario'])) {
            try {
                if (isset($_GET['tarea_id'])) {
                    $tarea_id = $_GET['tarea_id'];
                    $stmt = getTareaByID($tarea_id);
                    $tarea = $stmt->fetch(PDO::FETCH_ASSOC);
                    // SI EXISTE
                    if ($tarea) {
                        return $this->blade->render('tarea', ['tarea_id' => $tarea_id]);
                    } else {
                        return $this->blade->render('tarea_error');
                    }
                } else {
                    return $this->blade->render('tarea_error');
                }
            } catch (Exception $ex) {
                return $this->blade->render('tarea_error');
            }
        } else {
            header('Location: login');
            exit;
        }
    }

    /**
     * Muestra editar tarea
     * 
     * @return void
     */
    public function editarTarea()
    {
        if (isset($_SESSION['usuario'])) {
            if ($_SESSION['tipo'] != 'administrativo') {
                return $this->blade->render('acceso_negado');
            } else {
                try {
                    if (isset($_GET['tarea_id'])) {
                        $tarea_id = $_GET['tarea_id'];
                        $stmt = getTareaByID($tarea_id);
                        $tarea = $stmt->fetch(PDO::FETCH_ASSOC);
                        if ($tarea) {
                            return $this->blade->render('editar', ['tarea_id' => $tarea_id]);
                        } else {
                            return $this->blade->render('tarea_error');
                        }
                    } else {
                        return $this->blade->render('tarea_error');
                    }
                } catch (Exception $ex) {
                    return $this->blade->render('tarea_error');
                }
            }
        } else {
            header('Location: login');
            exit;
        }
    }

    /**
     * Muestra completar tarea
     * 
     * @return void
     */
    public function completarTarea()
    {
        if (isset($_SESSION['usuario'])) {
            try {
                if (isset($_GET['tarea_id'])) {
                    $tarea_id = $_GET['tarea_id'];
                    $stmt = getTareaByID($tarea_id);
                    $tarea = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($tarea) {
                        return $this->blade->render('completar', ['tarea_id' => $tarea_id]);
                    } else {
                        return $this->blade->render('tarea_error');
                    }
                } else {
                    return $this->blade->render('tarea_error');
                }
            } catch (Exception $ex) {
                return $this->blade->render('tarea_error');
            }
        } else {
            header('Location: login');
            exit;
        }
    }
}
