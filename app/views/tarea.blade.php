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
        // CONVERSION DE CODIGO DE PROVINCIA A NOMBRE
        $nombreProvincia = provCodANombre($con, $provincia);
        // FORMATEAR FECHA A DIA/MES/AÑO
        $fechaFormateada = date("d/m/Y", strtotime($fecha_creacion));
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
                        <p>Fecha de creación: {{$fechaFormateada}}</p>
                        <p>Operario: {{$operario}}</p>
                        <p>Fecha de realización: {{$fecha_realizacion}}</p>
                        <p>Anotaciones anteriores: {{$anotaciones_anteriores}}</p>
                        <p>Anotaciones posteriores: {{$anotaciones_posteriores}}</p>
                    </div>
                    <div>
                        <a href='editar?tarea_id={{$tarea_id}}' class='btn btn-primary'><i class='fas fa-edit'> Editar</i></a>
                        <a href='borrar?tarea_id={{$tarea_id}}' class='btn btn-danger'><i class='fas fa-trash-alt'> Eliminar</i></a>
                    </div>
                </div>

        <?php
    }
    ?>

</div>

</body>
@endsection