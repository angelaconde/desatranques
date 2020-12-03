@extends('_template')

@section('cuerpo')

<?php
include_once MODEL_PATH . 'confirmar_borrado.php';
?>

<div class='alert alert-danger'>La tarea ha sido eliminada.</div>

@endsection