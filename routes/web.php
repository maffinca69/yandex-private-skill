<?php

/** @var Router $router */

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

use Laravel\Lumen\Routing\Router;

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix' => 'v1.0'], static function (Router $router) {
    $router->head('', fn() => http_response_code(200));

    $router->group(['prefix' => 'user'], static function (Router $router) {
        $router->post('unlink', 'UserController@unlink');

        $router->group(['prefix' => 'devices'], static function (Router $router) {
            $router->get('/', 'UserDevicesController@getDevices');
            $router->post('query', 'UserDevicesController@getStateDevices');
            $router->post('action', 'UserDevicesController@changeState');
        });
    });
});

$router->get('auth', 'UserOAuthController@oauth');
$router->post('auth', 'UserOAuthController@oauth');
$router->get('get-token', 'UserOAuthController@getToken');
$router->post('get-token', 'UserOAuthController@getToken');
$router->get('refresh-token', 'UserOAuthController@refreshToken');
$router->post('refresh-token', 'UserOAuthController@refreshToken');
