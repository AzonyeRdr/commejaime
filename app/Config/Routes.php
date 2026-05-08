<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('admin', ['filter' => 'role:1'], function ($routes) {
    $routes->get(
        '/',
        'AdminController::index'
    );
});

$routes->get('/', 'AuthController::inscriptionForm');
$routes->post('/', 'AuthController::inscrire');
$routes->get('/login', 'AuthController::loginForm');
$routes->post('/login', 'AuthController::login');
$routes->get('/index', 'Home::index');
