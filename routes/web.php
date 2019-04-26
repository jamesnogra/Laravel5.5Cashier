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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/pay/{plan}/{plan_id}', 'HomeController@pay');
Route::get('/cancel/{plan}/{process}', 'HomeController@cancel');
Route::get('/invoice/{invoice_id}', 'HomeController@invoice');
