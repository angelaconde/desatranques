<?php

// CONEXION A LA BASE DE DATOS
// include_once(MODEL_PATH . 'connection.php');
// $con = DB::getcon();

$tarea_id = $_GET['tarea_id'];
borrarTarea($tarea_id);

// $consulta = "DELETE FROM tareas WHERE tarea_id = :tarea_id";
// $sql = $con->prepare($consulta);
// $sql->bindParam(':tarea_id', $tarea_id, PDO::PARAM_INT);
// $sql->execute();