@extends('_template')

@section('cuerpo')

<div class="container-fluid">

    <?php

        include_once MODEL_PATH . 'tareas.php';
        include_once MODEL_PATH . 'provincias.php';
        include_once HELPERS_PATH . 'vistas.php';

    ?>

        <div class="page-header text-center">
            <h3>Resultados</h3>
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
            while ($tarea = $resultado->fetch(PDO::FETCH_ASSOC)) {
                extract($tarea);
                $nombreProvincia = provCodANombre($provincia);
                $fechaFormateada = date("d/m/Y", strtotime($fecha_creacion));
                $estado = formatearEstado($estado);
                // FILA EN LA TABLA
            ?>
                <tr>
                    <td>{{$contacto}}</td>
                    <td>{{$telefono}}</td>
                    <td>{{$descripcion}}</td>
                    <td>{{$poblacion}}</td>
                    <td>{{$cp}}</td>
                    <td>{{$nombreProvincia}}</td>
                    <td>{{$estado}}</td>
                    <td>{{$fechaFormateada}}</td>
                    <td>{{$operario}}</td>
                    <td>{{$fecha_realizacion}}</td>
                    <td>
                        <a href='tarea?tarea_id={{$tarea_id}}' class='btn btn-primary'><i class='fas fa-file-alt'></i></a>
                        <a href='completar?tarea_id={{$tarea_id}}' class='btn btn-success'><i class="fas fa-check-square"></i></a>
                        <a href='editar?tarea_id={{$tarea_id}}' class='btn btn-info'><i class="fas fa-pen-square"></i></a>
                        <a href='borrar?tarea_id={{$tarea_id}}' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a>
                    </td>
                </tr>
        <?php
            }
        ?>
        </table>

</div>

@endsection