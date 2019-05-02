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

Route::get('/products', 'ProductController@index');
Route::get('/products/add-product', 'ProductController@addProduct');
Route::post('/products/add-product', 'ProductController@postAddProduct');
Route::post('/products/add-to-cart', 'ProductController@postAddToCart');
Route::get('/products/shopping-cart', 'ProductController@shoppingCart');
Route::post('/products/delete-from-shopping-cart', 'ProductController@deleteFromCart');
Route::post('/products/update-shopping-cart-quantity', 'ProductController@updateShoppingCardRecordQuantity');