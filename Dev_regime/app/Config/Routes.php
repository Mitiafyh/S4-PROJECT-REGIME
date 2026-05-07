<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Mitia
$routes->get('/login', 'LoginController::form');
$routes->post('/auth', 'LoginController::auth');
$routes->get('/loginAdmin', 'LoginController::formAdmin');
$routes->post('/authAdmin', 'LoginController::authAdmin');
$routes->get('/inscription', 'LoginController::inscriptionForm');
$routes->post('/register', 'LoginController::register');













// Noah
$routes->group('users', function($routes) {
    $routes->get('infoSante', 'UserController::infoSante');
    $routes->post('infoSante/validate', 'UserController::validateInfoSante');
    $routes->get('choix_objectif', 'UserController::choix_objectif');
    $routes->post('choix_objectif/validate', 'UserController::validateChoixObjectif');
});