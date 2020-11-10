<?php

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

Route::get('/', 'HomeController@index');
Route::get('/view_order', 'OrdersController@view');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/', 'AppController');
Route::get('/order_transaction', 'OrdersController@transaction')->name('order_transaction');


Route::resource('items', 'ItemsController');
Route::resource('orders', 'OrdersController');

//Orders
Route::post('/orders/add', 'OrdersController@store');
Route::post('/orders/create', 'OrdersController@create');
Route::post('/orders/add', 'OrdersController@store');
Route::get('/orders/edit/{id}', 'OrdersController@edit');
Route::put('/orders/update/{id}', 'OrdersController@update');
Route::get('/orders/delete/{id}', 'OrdersController@destroy');

//Items
Route::post('/items/create', 'ItemsController@create');
Route::post('/items/add', 'ItemsController@store');
Route::get('/items/edit/{id}', 'ItemsController@edit');
Route::put('/items/update/{id}', 'ItemsController@update');
Route::get('/items/delete/{id}', 'ItemsController@destroy');

Route::get('/pay/{id}', 'OrdersController@payment')->name('order.payment');
Route::get('/payed/{id}', 'OrdersController@payed')->name('order.payed');

Route::post('/cart/add', 'CartController@store');
Route::get('/api_orders', 'OrdersController@api');
Route::delete('/cart/delete/{id}', 'CartController@destroy');

Route::delete('/orders/{id}', 'OrdersController@destroy');

//API Makanan dan Minuman
Route::prefix('Api')->group(function () {
    Route::get('/AllItems', 'ItemsController@ApiAllItems')->name('api.all_items'); //api makanan
    Route::get('/FoodItems', 'ItemsController@ApiFoodItems')->name('api.food');
    Route::get('/DrinkItems', 'ItemsController@ApiDrinkItems')->name('api.drink'); //api minuman
    Route::get('/Cart', 'CartController@index')->name('api.cart');
});
