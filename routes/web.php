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

Route::prefix('admin')
        ->namespace('Admin')
        ->group(function () {
            //Routes Details Plan
            Route::put('plans/{url}/details/{idDetails}', 'DetailsPlanController@update')->name('details.plan.update');
            Route::get('plans/{url}/details/{idDetails}/edit', 'DetailsPlanController@edit')->name('details.plan.edit');
            Route::post('plans/{url}/details', 'DetailsPlanController@store')->name('details.plan.store');
            Route::get('plans/{url}/details/create', 'DetailsPlanController@create')->name('details.plan.create');
            Route::get('plans/{url}/details', 'DetailsPlanController@index')->name('details.plan.index');

            //Routes Plans
            Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
            Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
            Route::any('plans/search', 'PlanController@search')->name('plans.search');
            Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
            Route::get('plans/create/{url}', 'PlanController@show')->name('plans.show');
            Route::post('plans', 'PlanController@store')->name('plans.store');
            Route::get('plans/create', 'PlanController@create')->name('plans.create');
            Route::get('plans', 'PlanController@index')->name('plans.index');

            //Home Dashboard
            Route::get('/', 'PlanController@index')->name('admin.index');
});





Route::get('/', function () {
    return view('welcome');
});
