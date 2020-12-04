@extends('_template')

@section('cuerpo')

<div class="container-fluid pb-3">

    <?php

    // CONEXION A LA BASE DE DATOS
    include MODEL_PATH . 'connection.php';
    $con = DB::getcon();

    // PROVINCIAS
    include MODEL_PATH . 'provincias.php';

    // HEMOS RECIBIDO LA TAREA DESDE EL CONTROLADOR CON EL NOMBRE $tarea_id

    // OBTENER TAREA POR ID
    $query = "SELECT * FROM tareas WHERE tarea_id = " . $tarea_id;
    $stmt = $con->prepare($query);
    $stmt->execute(); 

    while ($tarea = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($tarea);
        $nombreProvincia = provCodANombre($con, $provincia);
        // FORMATEAR ESTADO
        switch ($estado) {
            case 'P':
                $estado = 'Pendiente';
                break;
            case 'R':
                $estado = 'Realizada';
                break;
            case 'C':
                $estado = 'Cancelada';
                break;
        }
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

</body>
@endsection