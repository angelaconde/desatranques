

<?php $__env->startSection('cuerpo'); ?>
<div class="col container fondo text-center p-3" style="height: 600px">
    <div class="card col-5 border-0 shadow mx-auto mt-5">
        <div class="card-body p-5">
            <h1 class="font-weight-light">Bienvenido, 
                <?php if(isset($usuario)): ?>
                <?php echo e($usuario); ?>.
                <?php else: ?> 
                Invitado.
            <?php endif; ?> 
            </h1>
            <h2 class="font-weight-light">Por favor selecciona una opción en el menú superior.</h2>
        </div>
    </div>
</div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desatranques\app\views/inicio.blade.php ENDPATH**/ ?>