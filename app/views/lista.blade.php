@extends('_template')

@section('cuerpo')

<div class="container-fluid">

    <?php

    include_once MODEL_PATH . 'tareas.php';
    include_once MODEL_PATH . 'provincias.php';
    include_once HELPERS_PATH . 'vistas.php';

    // PAGINACION
    $pagina = isset($_GET['page']) ? $_GET['page'] : 1;
    $tareasPorPagina = 5;
    $desde = ($tareasPorPagina * $pagina) - $tareasPorPagina;

    $totalFilas = getTareasTotal();
    $stmt = getTareasSiguientes($desde, $tareasPorPagina);
    $num = getTareasNumero($stmt);

    // COMPROBACION DE QUE HAYA RESULTADOS
    if ($num > 0) {
    ?>

    <div class="page-header text-center">
        <h3>Lista de tareas de la {{ $desde+1 }} a la {{ $desde+$num }} de un total de {{ $totalFilas }}</h3>
    </div>
    <table class='table table-hover table-bordered'>
        <tr>
            <th>Contacto</th>
            <th>Teléfono</th>
            <th>Descripción</th>
            <th>Población</th>
            <th>CP</th>
            <th>Provincia</th>
            <th>Estado</th>
            <th>Fecha de creación</th>
            <th>Operario</th>
            <th>Fecha de realización</th>
        </tr>

        <?php

        while ($tarea = $stmt->fetch(PDO::FETCH_ASSOC)) {
            extract($tarea);
            $nombreProvincia = provCodANombre($provincia);
            $fechaFormateada = date("d/m/Y", strtotime($fecha_creacion));
            $estado = formatearEstado($estado);
            // FILA EN LA TABLA
    ?>
        <tr>
            <td>{{ $contacto }}</td>
            <td>{{ $telefono }}</td>
            <td>{{ $descripcion }}</td>
            <td>{{ $poblacion }}</td>
            <td>{{ $cp }}</td>
            <td>{{ $nombreProvincia }}</td>
            <td>{{ $estado }}</td>
            <td>{{ $fechaFormateada }}</td>
            <td>{{ $operario }}</td>
            <td>{{ $fecha_realizacion }}</td>
            <td>
                <a href='tarea?tarea_id={{ $tarea_id }}' class='btn btn-primary'><i class='fas fa-file-alt'></i></a>
                <a href='completar?tarea_id={{ $tarea_id }}' class='btn btn-success'><i
                        class="fas fa-check-square"></i></a>
                <a href='editar?tarea_id={{ $tarea_id }}' class='btn btn-info'><i class="fas fa-pen-square"></i></a>
                <a href='borrar?tarea_id={{ $tarea_id }}' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a>
            </td>
        </tr>
        <?php
        }
    ?>
    </table>
    <?php

        // PAGINACION
        $paginaUrl = "lista?";
        include_once "views/paginacion.blade.php";
    } else {
        echo "<div class='alert alert-danger'>No hay ninguna tarea.</div>";
    }
    ?>

</div>

@endsection