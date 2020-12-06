@extends('_template')

@section('cuerpo')

<?php
include_once MODEL_PATH . 'completar.php';
include MODEL_PATH . 'provincias.php';
include HELPERS_PATH . 'vistas.php';

$stmt = getTareaByID($tarea_id);
$tarea = $stmt->fetch(PDO::FETCH_ASSOC);
extract($tarea);

$nombreProvincia = provCodANombre($provincia);
$fechaFormateada = date("d/m/Y", strtotime($fecha_creacion));
$estado = formatearEstado($estado);
?>

<div class="col container text-center p-3">
    <div>
        <h3 class="font-weight-light"> DATOS DE CLIENTE </h3>
        <p>Nombre: {{$contacto}} | Teléfono: {{$telefono}} | Email: {{$email}}</p>
    </div>
    <div>
        <h3 class="font-weight-light"> DATOS DE TAREA </h3>
        <p>Descripción: {{$descripcion}}</p>
        <p>Dirección: {{$direccion}}</p>
        <p>Población: {{$poblacion}} | CP: {{$cp}} | Provincia: {{$nombreProvincia}}</p>
        <p>Fecha de creación: {{$fechaFormateada}}</p>
        <p>Operario: {{$operario}} | Fecha de realización: {{$fecha_realizacion}}</p>
        <p>Anotaciones anteriores: {{$anotaciones_anteriores}}</p>
    </div>
</div>

<div class="container mx-auto">
    <h3 class="font-weight-light text-center"> DATOS A ACTUALIZAR </h3>
    <form method="post">
        <div class="form-row justify-content-center text-center">
            <div class="form-group col-md-2">
                <label class="col-form-label">Estado</label>
                <div class="custom-controls-stacked">
                    <div class="custom-control custom-radio">
                        <input name="estado" id="estado_0" type="radio" class="custom-control-input" value="P">
                        <label for="estado_0" class="custom-control-label">Pendiente</label>
                    </div>
                </div>
                <div class="custom-controls-stacked">
                    <div class="custom-control custom-radio">
                        <input name="estado" id="estado_1" type="radio" class="custom-control-input" value="R" checked="checked">
                        <label for="estado_1" class="custom-control-label">Realizada</label>
                    </div>
                </div>
                <div class="custom-controls-stacked">
                    <div class="custom-control custom-radio">
                        <input name="estado" id="estado_2" type="radio" class="custom-control-input" value="C">
                        <label for="estado_2" class="custom-control-label">Cancelada</label>
                    </div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="posteriores" class="col-form-label">Anotaciones posteriores</label>
                <textarea id="posteriores" name="posteriores" rows="5" class="form-control"><?= $anotaciones_posteriores ?></textarea>
            </div>
        </div>
    </div>
        <div class="form-row">
            <div class="col text-center p-3">
                <input type='submit' value='Completar tarea' class='btn btn-primary'>
                <a href='{{BASE_URL}}lista' class='btn btn-danger'>Cancelar</a>
            </div>
        </div>
    </form>
</div>

@endsection