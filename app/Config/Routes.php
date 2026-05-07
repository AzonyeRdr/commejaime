<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'AuthController::inscriptionForm');
$routes->post('/', 'AuthController::inscrire');
