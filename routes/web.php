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

Route::get('/', function () {
    return view('pages.index');
});

Route::resource('/products', 'ProductController');
Route::post('/prices/{product_id}', 'PriceController@store');
Route::get('/prices/{id}/{product_id}/edit', 'PriceController@edit');
Route::put('/prices/{id}/{product_id}', 'PriceController@update');
Route::delete('/prices/{id}/{product_id}', 'PriceController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
