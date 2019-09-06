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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/attributes', 'API\AttributesController@index');
Route::get('/attributes/{attribute}', 'API\AttributesController@show');
Route::middleware('auth:api')->post('/attributes/{attribute}', 'API\AttributesController@show');
Route::middleware('auth:api')->post('/attributes/{attribute}', 'API\AttributesController@update');
Route::middleware('auth:api')->delete('/attributes/{attribute}', 'API\AttributesController@destroy');

Route::middleware('auth:api')->post('/attributes/{attribute}/options', 'API\AttributeOptionsController@store');
Route::middleware('auth:api')->delete('/attributes/{attribute}/options/{option}', 'API\AttributeOptionsController@destroy');