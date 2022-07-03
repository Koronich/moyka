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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Начало

Route::get('/', 'OrdersController@choose')->name('start');

// Профиль
Route::get('profile/{id}', 'OrdersController@profile')->name('profile');


// Клиент
Route::post('updateclientpost', 'ClientController@update')->name('updateclientpost');
Route::get('updateclient/{id}', 'ClientController@edit')->name('updateclient');
Route::get('newclient', 'ClientController@index')->name('newclient');
Route::post('newclientpost', 'ClientController@store')->name('newclientpost');
Route::post('find','ClientController@find')->name('find');


// Машина
Route::get('addcar/{id}', 'CarsController@add')->name('addcar');
Route::post('addcarpost', 'CarsController@store')->name('addcarpost');


// Заказ

Route::get('order/{id}/{car}', 'OrdersController@index')->name('order');
Route::post('makeorder', 'OrdersController@make')->name('makeorder');
Route::get('finishpost', 'OrdersController@finishpost')->name('finishpost');
Route::get('ordertable', 'OrdersController@ordertable')->name('ordertable');
Route::get('deleteorder/{id}', 'OrdersController@deleteorder')->name('deleteorder');

Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
