<?php

session_start();

// RUTAS DE DIRECTORIOS
if (!defined('APP_PATH')) {
    define('APP_PATH', __DIR__ . '/');
    define('CTRL_PATH', __DIR__ . '/controllers/');
    define('MODEL_PATH', __DIR__ . '/models/');
    define('VIEW_PATH', __DIR__ . '/views/');
    define('HELPERS_PATH', __DIR__ . '/helpers/');
    define('CACHE_PATH', __DIR__ . '/cache/');
}

// INCLUDES
// include (HELPERS_PATH.'vistas.php');
include (CTRL_PATH.'tareas.php');
include (CTRL_PATH.'usuarios.php');

// SIMPLIFICACION DE NOMBRES DE INTERFACES
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// REQUERIR COMPONENTES
require __DIR__ .  '../../vendor/autoload.php';

// MOSTRAR ERRORES DETALLADOS
$config['displayErrorDetails'] = true;

// URL DE LA APLICACION
define('BASE_URL', 'http://localhost/desatranques/app/index.php/');

// NUEVA INSTANCIA DE SLIM
$app = new \Slim\App(['settings' => $config]);

// LOGIN
$app->any('/login', function (Request $request, Response $response, $args) {
    $response->getBody()->write( Usuario::getInstance()->login() );
    return $response;
});

// LOGOUT
$app->any('/logout', function (Request $request, Response $response, $args) {
    $response->getBody()->write( Usuario::getInstance()->logout() );
    return $response;
});

// GET PRINCIPAL
$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write( Tareas::getInstance()->Inicio() );
    return $response;
});

// GET LISTA
$app->get('/lista', function (Request $request, Response $response, $args) {
    $response->getBody()->write( Tareas::getInstance()->Listar() );
    return $response;
});

// GET UNA TAREA
$app->get('/tarea', function (Request $request, Response $response, $args) {
    $response->getBody()->write( Tareas::getInstance()->verTarea() );
    return $response;
});

// POST AÑADIR
$app->post('/crear', function (Request $request, Response $response, $args) {
    $response->getBody()->write( Tareas::getInstance()->Add() );
    return $response;
});

// GET AÑADIR
$app->get('/crear', function (Request $request, Response $response, $args) {
    $response->getBody()->write( Tareas::getInstance()->Add() );
    return $response;
});

// EDITAR
$app->any('/editar', function (Request $request, Response $response, $args) {
    $response->getBody()->write( Tareas::getInstance()->editarTarea() );
    return $response;
});

// BORRAR
$app->get('/borrar', function (Request $request, Response $response, $args) {
    $response->getBody()->write( Tareas::getInstance()->Del() );
    return $response;
});

// CONFIRMAR BORRAR
$app->any('/confirmar_borrado', function (Request $request, Response $response, $args){
    $response->getBody()->write (Tareas::getInstance()->confDel());
    return $response;
});

// ARRANCAR
$app->run();