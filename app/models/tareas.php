<?php

include_once MODEL_PATH . 'connection.php';

/**
 * Extrae las 5 tareas siguientes de la base de datos
 * 
 * @return mixed
 */
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

/**
 * Cuenta el número de resultados
 * 
 * @return int
 */
function getTareasNumero($stmt)
{
    $num = $stmt->rowCount();
    return $num;
}

/**
 * Extrae tarea
 * 
 * @return mixed
 */
function getTareas($stmt)
{
    $tarea = $stmt->fetch(PDO::FETCH_ASSOC);
    return $tarea;
}

/** 
 * Cuenta el número total de tareas
 * 
 * @return int
 */
function getTareasTotal()
{
    $con = DB::getcon();
    $query = "SELECT COUNT(*) as total_rows FROM tareas";
    $stmt = $con->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $totalFilas = $row['total_rows'];
    return $totalFilas;
}

/**
 * Extrae una tarea por su ID
 * 
 * @return mixed
 */
function getTareaByID($tarea_id)
{
    $con = DB::getcon();
    $query = "SELECT * FROM tareas WHERE tarea_id = " . $tarea_id;
    $stmt = $con->prepare($query);
    $stmt->execute();
    return $stmt;
}

/**
 * Borra una tarea por su ID
 * 
 * @return void
 */
function borrarTarea($tarea_id)
{
    $con = DB::getcon();
    // $tarea_id = $_GET['tarea_id'];
    $consulta = "DELETE FROM tareas WHERE tarea_id = :tarea_id";
    $sql = $con->prepare($consulta);
    $sql->bindParam(':tarea_id', $tarea_id, PDO::PARAM_INT);
    $sql->execute();
}
