<?php

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

  // show all vehicles
  $router->get('vehicles',  ['uses' => 'VehicleController@showAllvehicles']);

  // show one Vehicle
  $router->get('vehicles/{id}', ['uses' => 'VehicleController@showOneVehicle']);

  // list by categories
  $router->get('/category/{id}', ['uses' => 'VehicleController@showAllVehiclesByCategory']);

  // create
  $router->post('vehicles', ['uses' => 'VehicleController@create']);

  $router->post('category/{id}', ['uses' => 'VehicleController@addToCategory']);

  //delete
  $router->delete('vehicles/{id}', ['uses' => 'VehicleController@delete']);

  //update
  $router->put('vehicles/{id}', ['uses' => 'VehicleController@update']);
});
