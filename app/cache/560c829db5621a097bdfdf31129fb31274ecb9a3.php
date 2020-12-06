<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desatranques Jaén - Login</title>
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
</head>

<body>
    <div class="container-fluid">
        <form method="POST" class="col-3 mx-auto text-center">
            <img class="img-fluid m-3" src="../../assets/img/logo.png">
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="usuario" placeholder="Usuario" autofocus="autofocus">
            </div>
            <div class="form-group">           
                <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
            </div>
            <button type="submit" class="btn btn-primary btn-block" name="submit" value="submit">Iniciar sesión</button>
            <?php if($error != ''): ?>
                <div class="alert alert-danger"><?php echo e($error); ?></div>
            <?php endif; ?>
            <div class="container">
            <small class="form-text text-muted">
                Usuarios de prueba:<br>
                angela (administrativo) 1111<br>
                jose (administrativo) 1234<br>
                pepe (operario) 1234<br>
                juan (operario) 1234
            </small>
            </div>
            </div>
        </form>
    </div>

    <!-- BOOTSTRAP -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>

</html><?php /**PATH C:\xampp\htdocs\desatranques\app\views/login.blade.php ENDPATH**/ ?>