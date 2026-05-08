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
$routes->get('/gestionSport', 'SportController::index');
$routes->get('/ajoutSport', 'SportController::ajoutForm');
$routes->post('/modifierSport/(:num)', 'SportController::modifier/$1');
$routes->get('/supprimerSport/(:num)', 'SportController::supprimer/$1');
$routes->post('/insertSport', 'SportController::insert');

// Admin
$routes->group('admin', function($routes) {
    $routes->get('dashboard', 'AdminController::dashboard');
    $routes->get('regimes', 'AdminController::regimes');
    $routes->get('codes', 'AdminController::codes');
    $routes->get('users', 'AdminController::users');
    $routes->get('sports', 'AdminController::sports');
    $routes->get('settings', 'AdminController::settings');
    $routes->post('settings', 'AdminController::updateSettings');
    $routes->post('users/update/(:num)', 'AdminController::updateUser/$1');
    $routes->post('codes/create', 'AdminController::createCode');
    $routes->get('codes/delete/(:num)', 'AdminController::deleteCode/$1');
});



// Noah
$routes->group('users', function($routes) {
    $routes->get('infoSante', 'UserController::infoSante');
    $routes->post('infoSante/validate', 'UserController::validateInfoSante');
    $routes->get('choix_objectif', 'UserController::choix_objectif');
    $routes->post('choix_objectif/validate', 'UserController::validateChoixObjectif');
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('program', 'ProgramController::index');
    $routes->post('program/buy', 'ProgramController::buyRegime');
    $routes->get('wallet', 'WalletController::index');
    $routes->post('wallet/promo', 'WalletController::applyPromoCode');
    $routes->post('wallet/gold', 'WalletController::activateGold');
    $routes->get('activities', 'ActivitiesController::index');
    $routes->get('objectives', 'ObjectivesController::index');
    $routes->post('objectives/save', 'ObjectivesController::saveObjective');
});