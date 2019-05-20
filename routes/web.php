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
use App\http\Resources\companyResource;
use App\company;

Route::get('/view/{any}',  'mainController@index')->where('any','.*');
Route::get('/', function (){return redirect('/view/home');});
Route::get('/view', function (){return redirect('/view/home');});

Route::get('/api/company/all', function () {
    return companyResource::collection(company::all());
});
Route::apiResources([
    '/api/product' => 'ProductControllerApi',
    '/api/company' => 'companyControllerApi',
    '/api/contact' => 'contactControllerApi'
    // ,'posts' => 'ServiceController'
]);
