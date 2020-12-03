

<?php $__env->startSection('cuerpo'); ?>

<?php
include_once MODEL_PATH . 'confirmar_borrado.php';
?>

<div class='alert alert-danger'>La tarea ha sido eliminada.</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('_template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\desatranques\app\views/confirmar_borrado.blade.php ENDPATH**/ ?>