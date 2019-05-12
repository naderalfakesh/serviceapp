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

Route::get('/view/{any}',  'mainController@index')->where('any','.*');
//Route::get('/{any}',  'mainController@index')->where('any','.*');

Route::apiResources([
    '/api/product' => 'ProductControllerApi'
    // ,'posts' => 'ServiceController'
]);