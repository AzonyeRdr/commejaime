<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'AuthController::inscriptionForm');
$routes->post('/', 'AuthController::inscrire');
$routes->get('/login', 'AuthController::loginForm');
$routes->post('/login', 'AuthController::login');

//Route pour ceux qui sont connectés
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/index', 'Home::index');
    $routes->post('/envoyer-code-requete' , 'CodeController::demanderCode');
});

//Routes pour admin, (role=1)
$routes->group('admin', ['filter' => 'role:1'], function ($routes) {
    $routes->get('/', 'AdminController::index');
    $routes->get('codes', 'CodeController::liste');
    $routes->get('valider-code/(:num)', 'CodeController::validerCode/$1');
    $routes->get('refuser-code/(:num)', 'CodeController::refuserCode/$1');
});

//Routes pour gold, (role=2)
$routes->group('', ['filter' => 'role:2'], function ($routes) {});

$routes->get('/formInfoUser', 'InfoUserController::afficherFormulaireInfoUser');

$routes->post('/insererInfoUser', 'InfoUserController::insererInfoUser');


