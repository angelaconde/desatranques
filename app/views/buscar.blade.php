@extends('_template')

@section('cuerpo')

<?php
include_once MODEL_PATH . 'operarios.php';

$listaOperarios = getOperarios();
?>

<div class="container col mx-auto">
    <div class="container text-center">
        <h3>Buscar tarea</h3>
    </div>
    <div class="container col-8">
        <form method="GET" class="form justify-content-center">
            <div class="form-group row justify-content-center">
                <label class="col-2 col-form-label" for="estado">Estado</label> 
                <div class="col-6">
                    <select id="estado" name="estado" class="custom-select">
                        <option value="%">Cualquiera</option>
                        <option value="P">Pendiente</option>
                        <option value="R">Realizada</option>
                        <option value="C">Cancelada</option>
                    </select>
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <label class="col-2 col-form-label" for="operario">Operario</label>
                <div class="col-6"> 
                    <select id="operario" name="operario" class="custom-select">
                        <option value='%' selected>Cualquiera</option>
                        @foreach ($listaOperarios as $operario)
                            <option value='{{$operario['nombre']}}'>{{$operario['nombre']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>  
            <div class="form-group row justify-content-center">
                <label class="col-2 col-form-label" for="cp">Código Postal</label> 
                <div class="col-6">
                    <input id="cp" name="cp" type="text" class="form-control" maxlength="5" value="">
                </div>
            </div>  
            <div class="form-group row justify-content-center text-center">
                <div class="col-8">
                    <button name="submit" type="submit" class="btn btn-primary">Buscar</button>
                </div>
            </div>
        </form>
    </div>    
</div>
@endsection