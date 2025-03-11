<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group("api", function ($routes){

    $routes->post("register", "Register::index");
    $routes->post("login", "Login::index");
    $routes->post('warrior-types', 'WarriorTypeController::create', ['filter' => 'authFilter']);
    $routes->post('spells', 'SpellsController::create', ['filter' => 'authFilter']); 
    $routes->post('warrior', 'WarriorController::create', ['filter' => 'authFilter']); 
    $routes->post('races', 'RaceController::create', ['filter' => 'authFilter']); 
    $routes->post('powers', 'PowerController::create', ['filter' => 'authFilter']);
    $routes->post('warrior-power', 'WarriorPowerController::create', ['filter' => 'authFilter']); 
    $routes->post('warrior-spells', 'WarriorSpellsController::create', ['filter' => 'authFilter']); 
    $routes->post("jugador-status", "JugadorStatusController::create");

    $routes->get("users", "User::index", ['filter' => 'authFilter']);
    $routes->get('warrior-types', 'WarriorTypeController::index', ['filter' => 'authFilter']);
    $routes->get('races', 'RaceController::index', ['filter' => 'authFilter']);  
    $routes->get('powers', 'PowerController::index', ['filter' => 'authFilter']); 
    $routes->get('spells', 'SpellsController::index', ['filter' => 'authFilter']); 
    $routes->get('warrior', 'WarriorController::index', ['filter' => 'authFilter']); 
    $routes->get('warrior-power', 'WarriorPowerController::index', ['filter' => 'authFilter']); 
    $routes->get('warrior-spells', 'WarriorSpellsController::index', ['filter' => 'authFilter']); 
    $routes->get("jugador-status", "JugadorStatusController::index");

    $routes->put('warrior-type/update', 'WarriorTypeController::update');
    $routes->put('jugador-status/update', 'JugadorStatusController::update');

    $routes->delete('warrior-type/(:num)', 'WarriorTypeController::delete/$1', ['filter' => 'authFilter']);
    $routes->delete('races/(:num)', 'RaceController::delete/$1', ['filter' => 'authFilter']);
    $routes->delete('powers/(:num)', 'PowerController::delete/$1', ['filter' => 'authFilter']);
    $routes->delete('spells/(:num)', 'SpellsController::delete/$1', ['filter' => 'authFilter']);
    $routes->delete('warrior/(:num)', 'WarriorController::delete/$1', ['filter' => 'authFilter']);
    $routes->delete('warrior-power/(:num)', 'WarriorPowerController::delete/$1', ['filter' => 'authFilter']);
    $routes->delete('warrior-spells/(:num)', 'WarriorSpellsController::delete/$1', ['filter' => 'authFilter']);
    $routes->delete("jugador-status/(:num)", "JugadorStatusController::delete/$1");
});

