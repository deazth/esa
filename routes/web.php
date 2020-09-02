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

Route::get('setlocale/{locale}', function ($locale) {
  if (in_array($locale, \Config::get('app.locales'))) {
    session(['locale' => $locale]);
  }
  return redirect()->back();
})->name('user.lang');

// routes that require login
Route::group(['middleware' => ['auth']], function() {

  // web APIs
  Route::get('/webapi/getappcontact', 'WebApiController@GetApplicantContacts')->name('wa.appcontact');
});

// Route::get('/dashboard', 'StaffDashController@dashboard')->name('staff.dashboard');

// route that only for verified users
Route::group(['middleware' => ['auth', 'verified']], function() {
  Route::get('/home', 'HomeController@index')->name('home');

  // ESA applications
  Route::get('/esa/apply', 'ApplicantController@showform')->name('user.apply.form');
  Route::post('/esa/create', 'ApplicantController@create')->name('user.apply.create');
  Route::post('/esa/update', 'ApplicantController@update')->name('user.apply.update');
  Route::get('/esa/details/{uuid}', 'ApplicantController@details')->name('user.apply.details');
  Route::get('/esa/submit/{uuid}', 'ApplicantController@submit')->name('user.apply.submit');
  Route::post('/esa/contact/add', 'ApplicantController@addcontact')->name('user.contact.add');
  Route::post('/esa/contact/del', 'ApplicantController@delcontact')->name('user.contact.del');

});
