<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'api'], function () use ($router) {
    $router->get('leads',  ['uses' => 'LeadController@showAllLeads']);
    $router->post('leads/update/{id}', ['uses' => 'LeadController@update']);
//    $router->get('leads/accept/{id}', ['uses' => 'LeadController@accept']);
//    $router->get('leads/decline/{id}', ['uses' => 'LeadController@decline']);
});

