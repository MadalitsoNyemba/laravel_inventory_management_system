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
Route::middleware('auth')->group( function(){


// routes for home
Route::get('/', 'ContentsController@index')->name('index');

// routes for products
Route::get('/products', 'ProductsController@index')->name('products');
Route::post('/add_product', 'ProductsController@add_product')->name('add_product');
Route::post('/edit_product', 'ProductsController@edit_product')->name('edit_product');
Route::post('/delete_product', 'ProductsController@delete_product')->name('delete_product');

// routes for categories
Route::get('/categories', 'CategoriesController@index')->name('categories');
Route::post('/add_category', 'CategoriesController@add_category')->name('add_category');
Route::post('/edit_category', 'CategoriesController@edit_category')->name('edit_category');


// routes for pos
Route::get('/pos', 'PosController@index')->name('pos');
Route::post('/stock_calculations', 'PosController@stock_calculations')->name('stock_calculations');
Route::get('/export', 'PosController@export')->name('export');
Route::get('/send_mail', 'PosController@send_mail')->name('send_mail');


// routes for report
Route::get('/report', 'ReportController@index')->name('report');
Route::get('/chart', 'ReportController@chart')->name('chart');

// routes for users
Route::get('/users', 'UsersController@index')->name('users');
Route::get('/history', 'UsersController@history')->name('history');
Route::get('/profile', 'UsersController@profile')->name('profile');
Route::post('/edit_profile', 'UsersController@edit_profile')->name('edit_profile');
Route::post('/edit_password', 'UsersController@edit_password')->name('edit_password');
Route::post('/admin_actions', 'UsersController@admin_actions')->name('admin_actions');
Route::post('/reverse_transaction', 'UsersController@reverse_transaction')->name('reverse_transaction');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
