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

// public routes
Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['verify' => true]);


// routes that require login


// route that only for verified users
Route::group(['middleware' => ['auth', 'verified']], function() {
  Route::get('/home', 'HomeController@index')->name('home');
});
