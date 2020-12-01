<?php

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


//
// SLIM
//

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

//
// RUTAS DE LA APLICACION
//

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

// PUT EDITAR
$app->put('/edit', function (Request $request, Response $response, $args) {
    $response->getBody()->write( Tareas::getInstance()->Edit() );
    return $response;
});

// GET BORRAR
$app->get('/del', function (Request $request, Response $response, $args) {
    $response->getBody()->write( Tareas::getInstance()->Del() );
    return $response;
});

// GET PAGINA 1
$app->get('/pag1', function (Request $request, Response $response, $args) {
    $response->getBody()->write( Tareas::getInstance()->Pag1() );
    return $response;
});

// ARRANCAR
$app->run();