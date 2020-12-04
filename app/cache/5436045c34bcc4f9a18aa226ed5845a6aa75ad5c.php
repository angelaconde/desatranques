

<?php $__env->startSection('cuerpo'); ?>

<div class="container-fluid">

    <?php

    // CONEXION A LA BASE DE DATOS
    include MODEL_PATH . 'connection.php';
    $con = DB::getcon();

    // PROVINCIAS
    include MODEL_PATH . 'provincias.php';

    // AYUDAS DE FORMATO DE VISTAS
    include HELPERS_PATH . 'vistas.php';

    // PAGINACION
    $pagina = isset($_GET['page']) ? $_GET['page'] : 1;
    $tareasPorPagina = 5;
    $desde = ($tareasPorPagina * $pagina) - $tareasPorPagina;

    // OBTENER LAS SIGUIENTES 5 TAREAS Y SUS DATOS
    $query = "SELECT * FROM tareas ORDER BY fecha_creacion DESC LIMIT :desde, :tareasPorPagina";
    $stmt = $con->prepare($query);
    $stmt->bindParam(":desde", $desde, PDO::PARAM_INT);
    $stmt->bindParam(":tareasPorPagina", $tareasPorPagina, PDO::PARAM_INT);
    $stmt->execute();
    // NUMERO TOTAL DE RESULTADOS OBTENIDOS
    $num = $stmt->rowCount();


    // COMPROBACION DE QUE HAYA RESULTADOS
    if ($num > 0) {
    ?>
        <div class="page-header text-center">
            <h2>Lista de tareas de la <?php echo e($desde+1); ?> a la <?php echo e($desde+$num); ?></h2>
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

            while ($tarea = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // EXTRAE LA FILA PARA CONVERTIR $fila['campo'] EN $campo
                extract($tarea);
                // PROVINCIA A LA QUE CORRESPONDE EL CODIGO
                $nombreProvincia = provCodANombre($con, $provincia);
                // FECHA FORMATEADA
                $fechaFormateada = date("d/m/Y", strtotime($fecha_creacion));
                // FORMATEAR ESTADO
                $estado = formatearEstado($estado);
                // FILA EN LA TABLA
            ?>
                <tr>
                    <td><?php echo e($contacto); ?></td>
                    <td><?php echo e($telefono); ?></td>
                    <td><?php echo e($descripcion); ?></td>
                    <td><?php echo e($poblacion); ?></td>
                    <td><?php echo e($cp); ?></td>
                    <td><?php echo e($nombreProvincia); ?></td>
                    <td><?php echo e($estado); ?></td>
                    <td><?php echo e($fechaFormateada); ?></td>
                    <td><?php echo e($operario); ?></td>
                    <td><?php echo e($fecha_realizacion); ?></td>
                    <td>
                        <a href='tarea?tarea_id=<?php echo e($tarea_id); ?>' class='btn btn-info'><i class='fas fa-file-alt'></i></a>
                        <a href='editar?tarea_id=<?php echo e($tarea_id); ?>' class='btn btn-primary'><i class='fas fa-edit'></i></a>
                        <a href='borrar?tarea_id=<?php echo e($tarea_id); ?>' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a>
                    </td>
                </tr>

            <?php
            }
            ?>

        </table>
    <?php

        // PAGINACION
        // NUMERO TOTAL DE FILAS
        $query = "SELECT COUNT(*) as total_rows FROM tareas";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $totalFilas = $row['total_rows'];
        $paginaUrl = "lista?";
        include_once "views/paginacion.php";
    }

    // SI NO HAY RESULTADOS
    else {
        echo "<div class='alert alert-danger'>No hay ninguna tarea.</div>";
    }
    ?>

</div>

</body>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desatranques\app\views/lista.blade.php ENDPATH**/ ?>