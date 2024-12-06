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

use Illuminate\Support\Facades\Route;

Route::middleware(['auth.user'])->group(function () {
    Route::get('/', 'ImageController@showImages');
    Route::post('/image', 'ImageController@store');
    Route::get('/image', 'ImageController@showStoreImage');
});

Route::get('/user', 'UserController@registerUser');
Route::post('/user', 'UserController@store');
Route::get('/login', 'Auth\AuthController@showLoginForm');
Route::post('/login', 'Auth\AuthController@login');
Route::post('/logout', 'Auth\AuthController@logout');


