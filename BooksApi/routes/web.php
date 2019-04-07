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

$router->group(['prefix' => 'books'], function () use ($router) {
    $router->get('/', 'BookController@index');
    $router->post('/', 'BookController@save');
    $router->get('/{id:[0-9]+}', 'BookController@get');
    $router->put('/{id:[0-9]+}', 'BookController@update');
    $router->patch('/{id:[0-9]+}', 'BookController@update');
    $router->delete('/{id:[0-9]+}', 'BookController@delete');
});
