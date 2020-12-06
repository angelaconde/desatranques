

<?php $__env->startSection('cuerpo'); ?>

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
        <p>Nombre: <?php echo e($contacto); ?> | Teléfono: <?php echo e($telefono); ?> | Email: <?php echo e($email); ?></p>
    </div>
    <div>
        <h3 class="font-weight-light"> DATOS DE TAREA </h3>
        <p>Descripción: <?php echo e($descripcion); ?></p>
        <p>Dirección: <?php echo e($direccion); ?></p>
        <p>Población: <?php echo e($poblacion); ?> | CP: <?php echo e($cp); ?> | Provincia: <?php echo e($nombreProvincia); ?></p>
        <p>Fecha de creación: <?php echo e($fechaFormateada); ?></p>
        <p>Operario: <?php echo e($operario); ?> | Fecha de realización: <?php echo e($fecha_realizacion); ?></p>
        <p>Anotaciones anteriores: <?php echo e($anotaciones_anteriores); ?></p>
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
                <a href='<?php echo e(BASE_URL); ?>lista' class='btn btn-danger'>Cancelar</a>
            </div>
        </div>
    </form>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desatranques\app\views/completar.blade.php ENDPATH**/ ?>