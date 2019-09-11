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

Auth::routes([ 'register' => false ]);

// Route::get('/{any}', function () {
//     return view('welcome');
// })->where('any', '.*');

Route::get('/', 'PagesController@orderform');
Route::get('/thankyou', 'PagesController@thankyou');

Route::get('/orders', 'OrdersController@index')->name('orders');
Route::get('/orders/{order}', 'OrdersController@show')->name('order');

Route::get('/attributes', 'AttributesController@index')->name('attributes');
Route::post('/attributes', 'AttributesController@store')->name('attributes_store');

Route::get('/settings', 'SettingsController@index')->name('settings');

