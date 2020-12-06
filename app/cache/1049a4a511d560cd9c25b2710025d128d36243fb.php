

<?php $__env->startSection('cuerpo'); ?>

<?php
// include_once MODEL_PATH . 'buscar.php';
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
                        <?php $__currentLoopData = $listaOperarios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operario): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value='<?php echo e($operario['nombre']); ?>'><?php echo e($operario['nombre']); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desatranques\app\views/buscar.blade.php ENDPATH**/ ?>