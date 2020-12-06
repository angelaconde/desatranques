<?php

include_once MODEL_PATH . 'connection.php';

$con = DB::getcon();

$id = $_GET['tarea_id'];

if ($_POST) {
    try {

        // QUERY DE ACTUALIZAR
        $query = "UPDATE tareas SET 
        estado=:estado,
        anotaciones_posteriores=:posteriores
        WHERE tarea_id=:id";

        // PREPARACION DE LA QUERY
        $stmt = $con->prepare($query);

        // LIMPIEZA DE LOS DATOS DEL FORMULARIO
        if (isset($_POST['estado'])) {
            $estado = htmlspecialchars(strip_tags($_POST['estado']));
        }
        $posteriores = htmlspecialchars(strip_tags($_POST['posteriores']));

        // BINDEADO DE PARAMETROS
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':posteriores', $posteriores);
        $stmt->bindParam(':id', $id);
        // EJECUCION DE LA CONSULTA
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Tarea actualizada.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al actualizar tarea.</div>";
        }
    }
    // MOSTRAR SI HAY ERROR
    catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }
}
