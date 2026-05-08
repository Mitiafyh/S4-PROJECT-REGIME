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
$routes->get('/Regime', 'RegimeController::index');
$routes->get('/ajoutRegime', 'RegimeController::ajoutForm');
$routes->post('/modifierRegime/(:num)', 'RegimeController::modifier/$1');
$routes->get('/supprimerRegime/(:num)', 'RegimeController::supprimer/$1');
$routes->post('/insertRegime', 'RegimeController::insert');    








// Noah
$routes->group('users', function($routes) {
    $routes->get('infoSante', 'UserController::infoSante');
    $routes->post('infoSante/validate', 'UserController::validateInfoSante');
    $routes->get('choix_objectif', 'UserController::choix_objectif');
    $routes->post('choix_objectif/validate', 'UserController::validateChoixObjectif');
    $routes->get('dashboard', 'DashboardController::index');
});