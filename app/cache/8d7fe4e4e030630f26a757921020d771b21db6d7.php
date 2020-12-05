<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo e(BASE_URL); ?>"><img src="../../assets/img/logo.png" class="img-responsive img-thumbnail" alt="Desatranques Jaén"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item"><a class="nav-link" href="<?php echo e(BASE_URL); ?>">INICIO</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>lista">LISTADO</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>crear">AÑADIR</a></li>
            </ul>

            <div class="btn-group">
                <a class="nav-link dropdown-toggle text-primary" href="#" id="usuarioDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-user-tie"></i> 
                    <span id="usuario">
                        <?php if(isset($_SESSION['usuario'])): ?>
                            <?php echo e($_SESSION['usuario']); ?> [<?php echo e($_SESSION['tipo']); ?>] (<?php echo e($_SESSION['fecha']); ?>)
                            <?php else: ?> 
                            Invitado
                        <?php endif; ?> 
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="usuarioDropdown">
                    <a id="cerrarSesion" class="dropdown-item" href="<?php echo e(BASE_URL); ?>logout">Cerrar sesión</a>
                </div>
            </div>
        </div>
    </div>
</nav><?php /**PATH C:\xampp\htdocs\desatranques\app\views/encabezado.blade.php ENDPATH**/ ?>