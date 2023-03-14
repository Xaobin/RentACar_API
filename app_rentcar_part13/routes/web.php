<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//
Route::middleware('mycheck')->get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::get('/coming/{token?}', [App\Http\Controllers\HomeController::class, 'index'])->name('coming');

//Route::get('/brands', function() {
  //  return view('app.brands');
//})->name('brands')->middleware('auth');

Route::prefix('v1')->middleware('mycheck')->group(function() {
  
  Route::get('/brands', 'App\Http\Controllers\HomeController@brands')->name('brands');
});

