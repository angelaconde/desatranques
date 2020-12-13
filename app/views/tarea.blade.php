@extends('_template')

@section('cuerpo')

<div class="container-fluid pb-3">

    <?php

    include MODEL_PATH . 'provincias.php';
    include HELPERS_PATH . 'vistas.php';

    $stmt = getTareaByID($tarea_id);

    while ($tarea = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($tarea);
        $nombreProvincia = provCodANombre($provincia);
        $fechaFormateada = date("d/m/Y", strtotime($fecha_creacion));
        $estado = formatearEstado($estado);
        ?>
    <div class="col container text-center p-3">
        <div>
            <h3 class="font-weight-light"> DATOS DE CLIENTE </h3>
            <p>Nombre: {{ $contacto }}</p>
            <p>Teléfono: {{ $telefono }} | Email: {{ $email }}</p>
        </div>
        <div>
            <h3 class="font-weight-light"> DATOS DE TAREA </h3>
            <p>Descripción: {{ $descripcion }}</p>
            <p>Dirección: {{ $direccion }}</p>
            <p>Población: {{ $poblacion }} | CP: {{ $cp }} | Provincia: {{ $nombreProvincia }}</p>
            <p>Estado: {{ $estado }}</p>
            <p>Fecha de creación: {{ $fechaFormateada }}</p>
            <p>Operario: {{ $operario }}</p>
            <p>Fecha de realización: {{ $fecha_realizacion }}</p>
            <p>Anotaciones anteriores: {{ $anotaciones_anteriores }}</p>
            <p>Anotaciones posteriores: {{ $anotaciones_posteriores }}</p>
        </div>
        <div>
            <a href='completar?tarea_id={{ $tarea_id }}' class='btn btn-success'><i class="fas fa-check-square"></i>
                Completar</a>
            <a href='editar?tarea_id={{ $tarea_id }}' class='btn btn-primary'><i class='fas fa-pen-square'></i>
                Editar</a>
            <a href='borrar?tarea_id={{ $tarea_id }}' class='btn btn-danger'><i class='fas fa-trash-alt'></i>
                Eliminar</a>

            <button type="button" class='btn btn-secondary' onclick="history.back();"><i class="fas fa-undo-alt"></i>
                Volver</button>
        </div>
    </div>

    <?php
    }
    ?>

</div>

@endsection