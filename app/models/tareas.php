<?php

// CONEXION A LA BASE DE DATOS
include_once MODEL_PATH . 'connection.php';

// OBTENER LAS SIGUIENTES 5 TAREAS Y SUS DATOS
function getTareasSiguientes($desde, $tareasPorPagina)
{
    $con = DB::getcon();
    $query = "SELECT * FROM tareas ORDER BY fecha_creacion DESC LIMIT :desde, :tareasPorPagina";
    $stmt = $con->prepare($query);
    $stmt->bindParam(":desde", $desde, PDO::PARAM_INT);
    $stmt->bindParam(":tareasPorPagina", $tareasPorPagina, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}

function getTareasNumero($stmt)
{
    // NUMERO TOTAL DE RESULTADOS OBTENIDOS
    $num = $stmt->rowCount();
    return $num;
}

function getTareas($stmt)
{
    $tarea = $stmt->fetch(PDO::FETCH_ASSOC);
    return $tarea;
}

function getTareasTotal()
{
    // NUMERO TOTAL DE FILAS
    $con = DB::getcon();
    $query = "SELECT COUNT(*) as total_rows FROM tareas";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalFilas = $row['total_rows'];
    return $totalFilas;
}

function getTareaByID($tarea_id)
{
    $con = DB::getcon();
    $query = "SELECT * FROM tareas WHERE tarea_id = " . $tarea_id;
    $stmt = $con->prepare($query);
    $stmt->execute();
    return $stmt;
}

function borrarTarea($tarea_id)
{
    $con = DB::getcon();
    // $tarea_id = $_GET['tarea_id'];
    $consulta = "DELETE FROM tareas WHERE tarea_id = :tarea_id";
    $sql = $con->prepare($consulta);
    $sql->bindParam(':tarea_id', $tarea_id, PDO::PARAM_INT);
    $sql->execute();
}

// class Tareas_Modelo
// {

    // // Valores iniciales
    // private $tareasIniciales = array(
    //     1 => array('id' => 1, 'nombre' => 'tarea1', 'prioridad' => 1),
    //     2 => array('id' => 2, 'nombre' => 'tarea2', 'prioridad' => 1),
    //     4 => array('id' => 4, 'nombre' => 'tarea4', 'prioridad' => 1),
    //     5 => array('id' => 5, 'nombre' => 'tarea5', 'prioridad' => 1),
    //     10 => array('id' => 10, 'nombre' => 'tarea10', 'prioridad' => 1),
    // );

    // const SESS_TAREAS = 'tareas';

    // public function __construct()
    // {
    //     if (!isset($_SESSION['tareas'])) {
    //         $_SESSION[self::SESS_TAREAS] = $this->tareasIniciales;
    //     }
    // }

    // /**
    //  * Devuelve las tareas existentes.
    //  * Simulamos lectura de base de datos, aunque leemos de sessión
    //  * @return array
    //  */
    // public function GetTareas()
    // {
    //     return $_SESSION[self::SESS_TAREAS];
    // }



    // /**
    //  * Devuelve los datos de una tarea
    //  * @param type $id
    //  * @return boolean
    //  */
    // public function GetTarea($id)
    // {
    //     if (!isset($_SESSION[self::SESS_TAREAS][$id])) {
    //         return FALSE;
    //     } else {
    //         return $_SESSION[self::SESS_TAREAS][$id];
    //     }
    // }

    // /**
    //  * Actualiza los datos almacenados de una tarea
    //  * @param int $id
    //  * @param array $tarea
    //  */
    // public function Update($id, $tarea)
    // {
    //     $tarea['id'] = $id;
    //     $_SESSION[self::SESS_TAREAS][$id] = $tarea;
    // }



    // /**
    //  * Borra la tarea seleccionada
    //  * @param int $id
    //  */
    // public function Del($id)
    // {
    //     if (array_key_exists($id, $_SESSION[self::SESS_TAREAS])) {
    //         // Quitamos el elemento del array
    //         unset($_SESSION[self::SESS_TAREAS][$id]);
    //     } else {
    //         // Utilizamos el mecanimo de excepciones para notificar error.
    //         // En un programa real los mecanismos de notificación deberían ser homogeneos
    //         throw new Exception("Intento de borrar tarea inexistente Id: $id");
    //     }
    // }
   
// }
