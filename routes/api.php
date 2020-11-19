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
/*Route::middleware('auth_restful_api')->prefix('/v1')->namespace('Api\v1\\')->group(function () {
  Route::post('/orders/',  'OrdersController@Add');
});*/

Route::group([
  'prefix' => '/v1',
  'namespace' => 'Api\v1\\',
  'middleware' => ['auth_restful_api'],
], function () {
  Route::post('/orders/add/',  'OrdersController@Add');
});

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/
