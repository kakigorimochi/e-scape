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
| dear future devs, Route::post must be always after Route::get or else
| it will not work properly. -nikendozo
*/

Route::get('/', 'HomeController@home');
Route::get('/index', 'HomeController@home');
Route::get('/{user_type}', 'HomeController@index');
Route::get('/{user_type}/login', 'HomeController@login');
Route::get('/{user_type}/register', 'HomeController@register');
Route::prefix('commuter')->group(function () {
    Route::post('register_user', 'CommuterController@register');
});
Route::prefix('operator')->group(function () {
    Route::post('register_user', 'OperatorController@register');
});
// Route::post('/login', 'Auth\LoginController@login');
