<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix('v1')->group(function() {
    Route::apiResource('client', 'App\Http\Controllers\CarClientController');
    Route::apiResource('car', 'App\Http\Controllers\CarController');
    Route::apiResource('rent', 'App\Http\Controllers\CarRentController');
    Route::apiResource('brand', 'App\Http\Controllers\CarBrandController');
    Route::apiResource('model', 'App\Http\Controllers\CarModelController');
});

Route::group([

    'middleware' => 'api'
    //'prefix' => 'auth'

], function ($router) {
Route::post('login', 'App\Http\Controllers\AuthController@login');
Route::post('logout', 'App\Http\Controllers\AuthController@logout');
Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
Route::post('me', 'App\Http\Controllers\AuthController@me');
Route::post('onename', 'App\Http\Controllers\AuthController@onename');
//Route::get('me', 'App\Http\Controllers\AuthController@me');
});

//Route::group([ 'middleware' => 'api','prefix' => 'auth' ], function ($router) { });

//Route::post('login', 'App\Http\Controllers\AuthController@login');