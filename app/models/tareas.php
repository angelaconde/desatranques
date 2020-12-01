<?php

class Tareas_Model {
    
    // Valores iniciales
    private $tareasIniciales=array(
        1=>array('id'=>1, 'nombre'=>'tarea1', 'prioridad'=>1),
        2=>array('id'=>2, 'nombre'=>'tarea2', 'prioridad'=>1),
        4=>array('id'=>4, 'nombre'=>'tarea4', 'prioridad'=>1),
        5=>array('id'=>5, 'nombre'=>'tarea5', 'prioridad'=>1),
        10=>array('id'=>10, 'nombre'=>'tarea10', 'prioridad'=>1),
    );
    
    const SESS_TAREAS='tareas';

    public function __construct() 
    {
       if (! isset($_SESSION['tareas']))
       {
           $_SESSION[self::SESS_TAREAS]=$this->tareasIniciales;
       }
    }

    /**
     * Devuelve las tareas existentes.
     * Simulamos lectura de base de datos, aunque leemos de sessión
     * @return array
     */
    public function GetTareas()
    {
        return $_SESSION[self::SESS_TAREAS];
    }



    /**
     * Devuelve los datos de una tarea
     * @param type $id
     * @return boolean
     */
    public function GetTarea($id)
    {
        if (! isset($_SESSION[self::SESS_TAREAS][$id]))
        {
            return FALSE;
        }
        else
        {
            return $_SESSION[self::SESS_TAREAS][$id];
        }
    }

    /**
     * Actualiza los datos almacenados de una tarea
     * @param int $id
     * @param array $tarea
     */
    public function Update($id, $tarea)
    {
        $tarea['id']=$id;
        $_SESSION[self::SESS_TAREAS][$id]=$tarea;
    }
    
    /**
     * Añade una nueva tarea a la lista
     * @param array $tarea
     */
    public function Add($tarea)
    {
        $id=$this->NextId();
        $tarea['id']=$id;
        $_SESSION[self::SESS_TAREAS][$id]=$tarea;
    }

    /**
     * Borra la tarea seleccionada
     * @param int $id
     */
    public function Del($id)
    {
        if (array_key_exists($id, $_SESSION[self::SESS_TAREAS])) {
            // Quitamos el elemento del array
            unset($_SESSION[self::SESS_TAREAS][$id]);
        }
        else {
            // Utilizamos el mecanimo de excepciones para notificar error.
            // En un programa real los mecanismos de notificación deberían ser homogeneos
            throw new Exception("Intento de borrar tarea inexistente Id: $id");
        }
    }
    
    /**
     * Devuelve el ide de la próxima tarea a insertar
     * @return int
     */
    protected function NextId()
    {
        // último indice incluido en el array
        $idx=array_key_last($_SESSION[self::SESS_TAREAS]);
        return $idx+1;
    }
    
}