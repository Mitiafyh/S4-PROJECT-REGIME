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
    














// Noah
