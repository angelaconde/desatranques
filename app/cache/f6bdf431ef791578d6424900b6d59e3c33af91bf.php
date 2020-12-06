

<?php $__env->startSection('cuerpo'); ?>

<div class="container-fluid">

    <?php

        include_once MODEL_PATH . 'tareas.php';
        include_once MODEL_PATH . 'provincias.php';
        include_once HELPERS_PATH . 'vistas.php';

    ?>

        <div class="page-header text-center">
            <h3>Resultados</h3>
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
            while ($tarea = $resultado->fetch(PDO::FETCH_ASSOC)) {
                extract($tarea);
                $nombreProvincia = provCodANombre($provincia);
                $fechaFormateada = date("d/m/Y", strtotime($fecha_creacion));
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
                        <a href='tarea?tarea_id=<?php echo e($tarea_id); ?>' class='btn btn-primary'><i class='fas fa-file-alt'></i></a>
                        <a href='completar?tarea_id=<?php echo e($tarea_id); ?>' class='btn btn-success'><i class="fas fa-check-square"></i></a>
                        <a href='editar?tarea_id=<?php echo e($tarea_id); ?>' class='btn btn-info'><i class="fas fa-pen-square"></i></a>
                        <a href='borrar?tarea_id=<?php echo e($tarea_id); ?>' class='btn btn-danger'><i class='fas fa-trash-alt'></i></a>
                    </td>
                </tr>
        <?php
            }
        ?>
        </table>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desatranques\app\views/busqueda_resultado.blade.php ENDPATH**/ ?>