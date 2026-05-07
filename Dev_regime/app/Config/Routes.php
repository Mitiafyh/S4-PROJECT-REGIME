<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Mitia
$routes->get('/', 'LoginController::login');


















// Noah
$routes->group('users', function($routes) {
    $routes->get('infoSante', 'UserController::infoSante');
    $routes->post('infoSante/validate', 'UserController::validateInfoSante');
    $routes->get('choix_objectif', 'UserController::choix_objectif');
});