<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => [
        config('backpack.base.web_middleware', 'web'),
        config('backpack.base.middleware_key', 'admin'),
    ],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::get('dashboard', 'StaffDashController@dashboard')->name('backpack.dashboard');

    // pregenerated CRUD route
    Route::crud('applicantgroup', 'ApplicantGroupCrudController');
    Route::crud('state', 'StateCrudController');
    Route::crud('application', 'ApplicationCrudController');
    Route::get('charts/application-status', 'Charts\ApplicationStatusChartController@response')->name('charts.application-status.index');
    Route::crud('application_contact', 'Application_contactCrudController');
}); // this should be the absolute last line of this file