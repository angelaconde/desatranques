<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- FONTAWESOME -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <title>Instalador</title>
</head>

<body>
    <div clas="col container text-center p-3" style="height: 600px">
        <div class="card col-6 border-0 shadow mx-auto mt-5">
            <div class="card-body p-5 text-center">
                <h2 class="font-weight-light">Este instalador creará la base de datos "desatranques" y las tablas "usuarios",
                    "provincias" y "tareas", necesarias para el correcto funcionamiento de la aplicación.</h2>
                    <div class="text-center pt-3">
                <form action="" method="post">
                    <input type="submit" name="instalar" value="INSTALAR" class="btn btn-primary btn-lg">
                </form>
            </div>
            </div>
        </div>
    </div>
    </div>
    </div>


</body>

</html>

<?php

require_once '../app/config.php';
extract($db_info);

if ($_POST) {
    try {
        $con = new PDO("mysql:host=$db_host", $db_user, $db_pass);
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DROP DATABASE IF EXISTS desatranques";
        $con->exec($sql);
        $sql = "CREATE DATABASE IF NOT EXISTS desatranques";
        $con->exec($sql);
        $sql = "USE desatranques";
        $con->exec($sql);
        $sql = file_get_contents('bd.sql');
        $con->exec($sql);
        header("Location: ../app/index.php/");
    } catch (PDOException $e) {
        die("DB ERROR: " . $e->getMessage());
    }
}

?>