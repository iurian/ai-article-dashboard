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

$router->group(['prefix' => 'api/users'], function () use ($router) {
    $router->get('/', 'UserController@index');
    $router->post('/', 'UserController@store');
    $router->get('/{id}', 'UserController@show');
    $router->put('/{id}', 'UserController@update');
    $router->delete('/{id}', 'UserController@destroy');
});

$router->group(['prefix' => 'api/articles'], function () use ($router) {
    $router->get('/', 'ArticleController@index');
    $router->post('/', 'ArticleController@store');
    $router->get('/{id}', 'ArticleController@show');
    $router->put('/{id}', 'UserController@update');
    $router->delete('/{id}', 'ArticleController@destroy');
});

// Handle preflight requests
$router->options('{any:.*}', function () {
    return response('', 200);
});
