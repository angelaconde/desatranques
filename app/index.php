<?php

/**
 * Inicio de la aplicación
 * 
 * @author Angela Conde
 */

// INICIO DE SESION
session_start();

// RUTAS DE DIRECTORIOS
if (!defined('APP_PATH')) {
    define('APP_PATH', __DIR__ . '/');
    define('CTRL_PATH', __DIR__ . '/controllers/');
    define('MODEL_PATH', __DIR__ . '/models/');
    define('VIEW_PATH', __DIR__ . '/views/');
    define('HELPERS_PATH', __DIR__ . '/helpers/');
    define('CACHE_PATH', __DIR__ . '/cache/');
    define('VENDOR_PATH', __DIR__ . '../../vendor/');
}

// INCLUDES
require_once CTRL_PATH . 'tareas.php';
require_once CTRL_PATH . 'usuarios.php';
require_once VENDOR_PATH . 'autoload.php';

// SIMPLIFICACION DE NOMBRES DE INTERFACES
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

// URL DE LA APLICACION
define('BASE_URL', 'http://localhost/desatranques/app/index.php/');

// NUEVA INSTANCIA DE SLIM
$config['displayErrorDetails'] = true;
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

// COMPLETAR
$app->any('/completar', function (Request $request, Response $response, $args) {
    $response->getBody()->write( Tareas::getInstance()->completarTarea() );
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

// BUSCAR
$app->any('/buscar', function (Request $request, Response $response, $args){
    $response->getBody()->write (Tareas::getInstance()->buscarTarea());
    return $response;
});

// ARRANCAR
$app->run();