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

/**
 * URL: /
 * Controller: Index
 * Method: homepage
 */
Route::get('/', "IndexController@homepage");

Route::get('/add', "ManageController@add");
Route::post('/add', "ManageController@add");

Route::get('/edit/{id}', "ManageController@edit");
Route::post('/edit/{id}', "ManageController@edit");

Route::get('/delete/{id}', "ManageController@delete");

