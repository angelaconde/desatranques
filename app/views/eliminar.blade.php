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
        $estado = formatearEstado($estado);
        ?>
            <div class="col container text-center p-3">
                <div>
                    <h3 class="font-weight-light"> DATOS DE CLIENTE </h3>
                    <p>Nombre: {{$contacto}}</p>
                    <p>Teléfono: {{$telefono}} | Email: {{$email}}</p>
                </div>
                <div>
                    <h3 class="font-weight-light"> DATOS DE TAREA </h3>
                    <p>Descripción: {{$descripcion}}</p>
                    <p>Dirección: {{$direccion}}</p>
                    <p>Población: {{$poblacion}} | CP: {{$cp}} | Provincia: {{$nombreProvincia}}</p>
                    <p>Estado: {{$estado}}</p>
                    <p>Operario: {{$operario}}</p>
                    <p>Fecha de realización: {{$fecha_realizacion}}</p>
                    <p>Anotaciones anteriores: {{$anotaciones_anteriores}}</p>
                    <p>Anotaciones posteriores: {{$anotaciones_posteriores}}</p>
                </div>
                <div>
                    <a href='confirmar_borrado?tarea_id={{$tarea_id}}' class='btn btn-danger'><i class='fas fa-trash-alt'></i> Confirmar borrado</a>
                    <button type="button" class='btn btn-secondary' onclick="history.back();"><i class="fas fa-undo-alt"></i> Cancelar</button>
                </div>
            </div>

        <?php
    }
    ?>

</div>

@endsection