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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/couponsstore', 'cartController@couponsstore')->name('getcoupon');

Route::post('/se', 'cartController@store')->name('storecart');
Route::get('/cart', 'cartController@index')->name('cart');
Route::post('/edit/{id}', 'cartController@edit')->name('editcart');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
