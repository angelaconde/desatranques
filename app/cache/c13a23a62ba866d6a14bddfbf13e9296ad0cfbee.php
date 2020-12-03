

<?php $__env->startSection('cuerpo'); ?>

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
        ?>
                <div class="col container text-center p-3">
                    <div>
                        <h3 class="font-weight-light"> DATOS DE CLIENTE </h3>
                        <p>Nombre: <?php echo e($contacto); ?></p>
                        <p>Teléfono: <?php echo e($telefono); ?> | Email: <?php echo e($email); ?></p>
                    </div>
                    <div>
                        <h3 class="font-weight-light"> DATOS DE TAREA </h3>
                        <p>Descripción: <?php echo e($descripcion); ?></p>
                        <p>Dirección: <?php echo e($direccion); ?></p>
                        <p>Población: <?php echo e($poblacion); ?> | CP: <?php echo e($cp); ?> | Provincia: <?php echo e($nombreProvincia); ?></p>
                        <p>Estado: <?php echo e($estado); ?></p>
                        <p>Operario: <?php echo e($operario); ?></p>
                        <p>Fecha de realización: <?php echo e($fecha_realizacion); ?></p>
                        <p>Anotaciones anteriores: <?php echo e($anotaciones_anteriores); ?></p>
                        <p>Anotaciones posteriores: <?php echo e($anotaciones_posteriores); ?></p>
                    </div>
                    <div>
                        <a href='confirmar_borrado?tarea_id=<?php echo e($tarea_id); ?>' class='btn btn-danger'><i class='fas fa-trash-alt'> Confirmar borrado</i></a>
                    </div>
                </div>

        <?php
    }
    ?>

</div>

</body>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desatranques\app\views/eliminar.blade.php ENDPATH**/ ?>