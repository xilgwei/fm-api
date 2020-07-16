<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api',
], function ($api) {
    $api->group([], function ($api) {
        $api->post('register', 'AuthorizationController@store');
        $api->post('login', 'AuthorizationController@login');
        $api->get('refreshToken', 'AuthorizationController@refreshToken');

        $api->group([
            'middleware' => 'api.auth'
        ], function ($api) {
            $api->get('userInfo', 'UserController@info');
        });
    });
});
