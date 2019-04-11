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

$router->get('/test', function () use ($router) {
    die('Base uri is: api' . '/v' . env('API_VERSION'));
});

$router->group(['middleware' => 'client.credentials'], function () use ($router) {

    $router->group(['prefix' => 'api' . '/v' . env('API_VERSION')], function () use ($router) {
        $router->group(['prefix' => 'authors'], function () use ($router) {
            $router->get('/', 'AuthorController@index');
            $router->post('/', 'AuthorController@save');
            $router->get('/{id:[0-9]+}', 'AuthorController@get');
            $router->put('/{id:[0-9]+}', 'AuthorController@update');
            $router->patch('/{id:[0-9]+}', 'AuthorController@update');
            $router->delete('/{id:[0-9]+}', 'AuthorController@delete');
        });

        $router->group(['prefix' => 'books'], function () use ($router) {
            $router->get('/', 'BookController@index');
            $router->post('/', 'BookController@save');
            $router->get('/{id:[0-9]+}', 'BookController@get');
            $router->put('/{id:[0-9]+}', 'BookController@update');
            $router->patch('/{id:[0-9]+}', 'BookController@update');
            $router->delete('/{id:[0-9]+}', 'BookController@delete');
        });
    });

});

