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
Auth::routes();

Route::get('/', 'ProductController@index');

Route::get('/create-product', 'ProductController@create');

Route::post('/save-product', 'ProductController@store');

Route::get('/product-reviews/{id}', 'ReviewController@show');

Route::post('/create-review/{id}', 'ReviewController@store');

Route::post('/delete-review/{id}', 'ReviewController@delete');

Route::get('/companies', 'CompanyController@index');

Route::get('/create-company', 'CompanyController@create');

Route::post('/save-company', 'CompanyController@store');

Route::get('/view-company/{id}', 'CompanyController@show');