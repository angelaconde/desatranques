<?php

// CONEXION A LA BASE DE DATOS
include_once(MODEL_PATH . 'connection.php');
include_once(HELPERS_PATH . 'validaciones.php');
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

$errores = [];
$correcto = true;

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
        anotaciones_anteriores=:anteriores";

        // PREPARACION DE LA QUERY
        $stmt = $con->prepare($query);

        // FILTRADO
        if (empty($_POST['descripcion'])) {
            $errores['descripcion'] = 'Debe incluir una descripción.';
            $correcto = FALSE;
        }
        if (empty($_POST['contacto'])) {
            $errores['contacto'] = 'Debe incluir un contacto.';
            $correcto = FALSE;
        }
        if (empty($_POST['telefono']) || !validarTelefono($_POST['telefono'])) {
            $errores['telefono'] = 'Compruebe que el teléfono sea correcto.';
            $correcto = FALSE;
        }
        if (!empty($_POST['cp']) && !validarCP($_POST['cp'])) {
            $errores['cp'] = 'Compruebe que el Código Postal sea correcto.';
            $correcto = FALSE;
        }
        if (empty($_POST['email']) || !validarEmail($_POST['email'])) {
            $errores['email'] = 'Compruebe que el email sea correcto.';
            $correcto = FALSE;
        }
        if (!validarSelects($_POST['provincia'])) {
            $errores['provincia'] = 'Debe seleccionar una provincia.';
            $correcto = FALSE;
        }
        if (!validarSelects($_POST['operario'])) {
            $errores['operario'] = 'Debe seleccionar un operario.';
            $correcto = FALSE;
        }
        if (empty($_POST['fecha'])) {
            $errores['fecha'] = 'Debe añadir una fecha.';
            $correcto = FALSE;
        } else if (!validarFecha($_POST['fecha'])) {
            $errores['fecha'] = 'Compruebe que la fecha sea correcta.';
            $correcto = FALSE;
        }
        if ($correcto) {
            // LIMPIEZA DE LOS DATOS DEL FORMULARIO
            $contacto = htmlspecialchars(strip_tags($_POST['contacto']));
            $telefono = htmlspecialchars(strip_tags($_POST['telefono']));
            $descripcion = htmlspecialchars(strip_tags($_POST['descripcion']));
            $email = htmlspecialchars(strip_tags($_POST['email']));
            $direccion = htmlspecialchars(strip_tags($_POST['direccion']));
            $poblacion = htmlspecialchars(strip_tags($_POST['poblacion']));
            $cp = htmlspecialchars(strip_tags($_POST['cp']));
            if (isset($_POST['provincia'])) {
                $provincia = htmlspecialchars(strip_tags($_POST['provincia']));
            }
            if (isset($_POST['estado'])) {
                $estado = htmlspecialchars(strip_tags($_POST['estado']));
            }
            if (isset($_POST['operario'])) {
                $operario = htmlspecialchars(strip_tags($_POST['operario']));
            }
            $fecha = htmlspecialchars(strip_tags($_POST['fecha']));
            $anteriores = htmlspecialchars(strip_tags($_POST['anteriores']));
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
            // EJECUCION DE LA CONSULTA
            if ($stmt->execute()) {
                // LIMPIEZA DEL FORMULARIO
                $_POST = [];
                echo "<div class='alert alert-success'>Tarea añadida.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error al añadir tarea.</div>";
            }
        }
    }
    // MOSTRAR SI HAY ERROR
    catch (PDOException $exception) {
        die('ERROR: ' . $exception->getMessage());
    }
}
