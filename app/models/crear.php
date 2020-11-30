<?php

// CONEXION A LA BASE DE DATOS
include 'connection.php';
$con = DB::getcon();

// LISTA DE PROVINCIAS PARA RELLENAR EL SELECT DEL FORMULARIO
$sqlProv = 'SELECT * FROM provincias';
foreach ($con->query($sqlProv) as $provincia) {
    $listaProvincias[] = $provincia;
}

// LISTA DE OPERARIOS PARA RELLENAR EL SELECT DEL FORMULARIO
$sqlOpe = 'SELECT nombre FROM usuarios WHERE tipo = "operario"';
foreach ($con->query($sqlOpe) as $operario) {
    $listaOperarios[] = $operario;
}

if ($_POST) {

    try {
        // QUERY DE INSERTAR
        $query = "INSERT INTO tareas SET 
        contacto=:contacto, 
        telefono=:telefono, 
        descripcion=:descripcion, 
        email=:email,
        direccion=:direccion,
        poblacion=:poblacion,
        cp=:cp,
        provincia=:provincia,
        estado=:estado,
        operario=:operario,
        fecha_realizacion=:fecha,
        anotaciones_anteriores=:anteriores,
        anotaciones_posteriores=:posteriores";

        // PREPARACION DE LA QUERY
        $stmt = $con->prepare($query);

        // LIMPIEZA DE LOS DATOS DEL FORMULARIO
        $contacto = htmlspecialchars(strip_tags($_POST['contacto']));
        $telefono = htmlspecialchars(strip_tags($_POST['telefono']));
        $descripcion = htmlspecialchars(strip_tags($_POST['descripcion']));
        $email = htmlspecialchars(strip_tags($_POST['email']));
        $direccion = htmlspecialchars(strip_tags($_POST['direccion']));
        $poblacion = htmlspecialchars(strip_tags($_POST['poblacion']));
        $cp = htmlspecialchars(strip_tags($_POST['cp']));
        $provincia = htmlspecialchars(strip_tags($_POST['provincia']));
        $estado = htmlspecialchars(strip_tags($_POST['estado']));
        $operario = htmlspecialchars(strip_tags($_POST['operario']));
        $fecha = htmlspecialchars(strip_tags($_POST['fecha']));
        $anteriores = htmlspecialchars(strip_tags($_POST['anteriores']));
        $posteriores = htmlspecialchars(strip_tags($_POST['posteriores']));

        // TODO: Filtrado
        //
        //
        //
        //

        // BINDEADO DE PARAMETROS
        $stmt->bindParam(':contacto', $contacto);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':direccion', $direccion);
        $stmt->bindParam(':poblacion', $poblacion);
        $stmt->bindParam(':cp', $cp);
        $stmt->bindParam(':provincia', $provincia);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':operario', $operario);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':anteriores', $anteriores);
        $stmt->bindParam(':posteriores', $posteriores);

        // EJECUCION DE LA CONSULTA
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Tarea añadida.</div>";
        } else {
            echo "<div class='alert alert-danger'>Error al añadir tarea.</div>";
        }
    }

    // MOSTRAR SI HAY ERROR
    catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Crear nueva tarea</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid col-8">

        <div class="page-header">
            <h1>Añadir nueva tarea</h1>
        </div>

        <!-- FORMULARIO DE AÑADIR TAREA -->
        <form method="post">
            <div class="form-group">
                <label for="contacto" class="col-form-label">Persona de contacto</label>
                <input id="contacto" name="contacto" type="text" class="form-control">
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="telefono" class="col-form-label">Teléfono</label>
                    <input id="telefono" name="telefono" type="text" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="email" class="col-form-label">Email</label>
                    <input id="email" name="email" type="text" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <label for="descripcion" class="col-form-label">Descripción de la tarea</label>
                <textarea id="descripcion" name="descripcion" rows="3" class="form-control"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="direccion" class="col-form-label">Dirección</label>
                    <input id="direccion" name="direccion" type="text" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="poblacion" class="col-form-label">Población</label>
                    <input id="poblacion" name="poblacion" type="text" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="cp" class="col-form-label">CP</label>
                    <input id="cp" name="cp" type="text" class="form-control">
                </div>
                <div class="form-group col-md-6">
                    <label for="provincia" class="col-form-label">Provincia</label>
                    <select id="provincia" name="provincia" class="custom-select">
                        <option selected disabled>Selecciona una Provincia</option>
                        <?php
                        foreach ($listaProvincias as $provincia) {
                            echo '<option  value=' . $provincia['cod'] . '>' . $provincia['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="form-row">
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
                            <input name="estado" id="estado_1" type="radio" class="custom-control-input" value="R">
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
                <div class="form-group col-md-5">
                    <label for="operario" class="col-form-label">Operario</label>
                    <select id="operario" name="operario" class="custom-select">
                        <option selected disabled>Selecciona un operario</option>
                        <?php
                        foreach ($listaOperarios as $operario) {
                            echo '<option  value=' . $operario['nombre'] . '>' . $operario['nombre'] . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-5">
                    <label for="fecha" class="col-form-label">Fecha de realización</label>
                    <input id="fecha" name="fecha" type="text" class="form-control">
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="anteriores" class="col-form-label">Anotaciones anteriores</label>
                    <textarea id="anteriores" name="anteriores" cols="40" rows="5" class="form-control"></textarea>
                </div>
                <div class="form-group col-md-6">
                    <label for="posteriores" class="col-form-label">Anotaciones posteriores</label>
                    <textarea id="posteriores" name="posteriores" cols="40" rows="5" class="form-control"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <input type='submit' value='Guardar tarea' class='btn btn-primary'>
                    <a href='../index.php' class='btn btn-danger'>Cancelar</a>
                </div>
            </div>
        </form>
    </div>


    <!-- BOOTSTRAP -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html>