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
    return view('welcome');
});


Route::get('/products','ProductController@index')->name('products.index');
Route::post('/products/store','ProductController@store')->name('products.store');
Route::post('/products/edit','ProductController@update')->name('products.edit');
