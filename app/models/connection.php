<?php

include __DIR__ . '/../config.php';

$servername = SERVERNAME;
$db = DB;
$username = USERNAME;
$password = PASSWORD;

// INTENTA CONECTAR A LA BASE DE DATOS
try {
    $con = new PDO("mysql:host={$servername};dbname={$db}", $username, $password);
}
  
// MUESTRA ERROR SI LA CONEXION FALLA
catch(PDOException $exception){
    echo "Connection error: " . $exception->getMessage();
}