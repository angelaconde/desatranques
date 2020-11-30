<?php 
require '../vendor/autoload.php';
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Lista de tareas</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</head>

<body>
    <div class="container-fluid">

        <div class="page-header">
            <h1>Lista de tareas</h1>
        </div>

        <?php

        // CONEXION A LA BASE DE DATOS
        include 'models/connection.php';
        $con = DB::getcon();

        // PROVINCIAS
        include 'models/provincias.php';

        // PAGINACION
        $pagina = isset($_GET['page']) ? $_GET['page'] : 1;
        $tareasPorPagina = 5;
        $desde = ($tareasPorPagina * $pagina) - $tareasPorPagina;

        // OBTENER LAS SIGUIENTES 5 TAREAS Y SUS DATOS
        $query = "SELECT * FROM tareas ORDER BY fecha_creacion DESC LIMIT :desde, :tareasPorPagina";
        $stmt = $con->prepare($query);
        $stmt->bindParam(":desde", $desde, PDO::PARAM_INT);
        $stmt->bindParam(":tareasPorPagina", $tareasPorPagina, PDO::PARAM_INT);
        $stmt->execute();
        // NUMERO TOTAL DE RESULTADOS OBTENIDOS
        $num = $stmt->rowCount();

        // ENLACE A CREAR TAREA
        echo "<a href='models/crear.php' class='btn btn-primary m-b-1em'>Añadir nueva tarea</a>";

        // COMPROBACION DE QUE HAYA RESULTADOS
        if ($num > 0) {

            echo "<table class='table table-hover table-responsive table-bordered'>";
            echo "<tr>";
            echo "<th>Contacto</th>";
            echo "<th>Teléfono</th>";
            echo "<th>Email</th>";
            echo "<th>Descripción</th>";
            echo "<th>Dirección</th>";
            echo "<th>Población</th>";
            echo "<th>CP</th>";
            echo "<th>Provincia</th>";
            echo "<th>Estado</th>";
            echo "<th>Fecha de creación</th>";
            echo "<th>Operario</th>";
            echo "<th>Fecha de realización</th>";
            echo "<th>Anotaciones anteriores</th>";
            echo "<th>Anotaciones posteriores</th>";
            echo "</tr>";

            while ($tarea = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // EXTRAE LA FILA PARA CONVERTIR $fila['campo'] EN $campo
                extract($tarea);
                // FILA EN LA TABLA
                echo "<tr>";
                echo "<td>{$contacto}</td>";
                echo "<td>{$telefono}</td>";
                echo "<td>{$email}</td>";
                echo "<td>{$descripcion}</td>";
                echo "<td>{$direccion}</td>";
                echo "<td>{$poblacion}</td>";
                echo "<td>{$cp}</td>";
                // PROVINCIA A LA QUE CORRESPONDE EL CODIGO
                // $sqlProv = 'SELECT nombre FROM provincias WHERE cod = ?';
                // $stmtProv = $con->prepare($sqlProv);
                // $stmtProv->execute([$provincia]);
                // $nombreProvincia = $stmtProv->fetchColumn();
                $nombreProvincia = provCodANombre($con, $provincia);
                echo "<td>{$nombreProvincia}</td>";
                // FIN DE PROVINCIA
                echo "<td>{$estado}</td>";
                echo "<td>{$fecha_creacion}</td>";
                echo "<td>{$operario}</td>";
                echo "<td>{$fecha_realizacion}</td>";
                echo "<td>{$anotaciones_anteriores}</td>";
                echo "<td>{$anotaciones_posteriores}</td>";
                echo "<td>";
                // VER TAREA 
                echo "<a href='models/tarea.php?id={$tarea_id}' class='btn btn-info'><i class='fas fa-file-alt'></i></a>";
                // EDITAR TAREA
                echo "<a href='models/editar.php?id={$tarea_id}' class='btn btn-primary'><i class='fas fa-edit'></i></a>";
                // ELIMINAR TAREA
                echo "<a href='#' onclick='borrar_tarea({$tarea_id});'  class='btn btn-danger'><i class='fas fa-trash-alt'></i></a>";
                echo "</td>";
                echo "</tr>";
            }

            echo "</table>";
            // PAGINACION
            // NUMERO TOTAL DE FILAS
            $query = "SELECT COUNT(*) as total_rows FROM tareas";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $totalFilas = $row['total_rows'];
            $paginaUrl = "index.php?";
            include_once "views/paginacion.php";
        }

        // SI NO HAY RESULTADOS
        else {
            echo "<div class='alert alert-danger'>No hay ninguna tarea.</div>";
        }
        ?>

    </div>


    <!-- BOOTSTRAP -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>