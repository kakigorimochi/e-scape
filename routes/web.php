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
Route::get('/commuter', 'CommuterController@index');
Route::get('/index', 'HomeController@home');
Route::get('/{user_type}/login', 'HomeController@login');
Route::get('/{user_type}/register', 'HomeController@register');
Route::get('/operator', 'OperatorController@index');
Route::get('/logout', 'Auth\LoginController@logout');
Route::prefix('commuter')->group(function () {
    Route::get('e-wallet', 'CommuterController@e_wallet');
    Route::get('index', 'CommuterController@home');
    Route::get('journey_qr', 'CommuterController@journey_qr');
    Route::get('pay_journey', 'CommuterController@pay_journey');
    Route::get('single-journey-ticket', 'CommuterController@single_journey_ticket');
    Route::post('add_wallet_balance', 'CommuterController@add_wallet_balance');
    Route::post('cancel_journey', 'CommuterController@cancel_journey');
    Route::post('journey_payment', 'CommuterController@journey_payment');
    Route::post('register_user', 'CommuterController@register');
    Route::post('submit_journey', 'CommuterController@submit_journey');
});
Route::prefix('operator')->group(function () {
    Route::get('index', 'OperatorController@home');
    Route::post('register_user', 'OperatorController@register');
});
Route::post('/login', 'Auth\LoginController@custom_login');
