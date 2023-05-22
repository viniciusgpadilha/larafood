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
            //Routes Permissions x Profiles
            Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionsProfile')->name('profiles.permissions.detach');
            Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
            Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
            Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
            Route::get('permissionss/{id}/profile', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');

            //Routes Permissions
            Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
            Route::resource('permissions', 'ACL\PermissionController');

            //Routes Profiles
            Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
            Route::resource('profiles', 'ACL\ProfileController');

            //Routes Details Plan
            Route::get('plans/{url}/details/create', 'DetailsPlanController@create')->name('details.plan.create');
            Route::delete('plans/{url}/details/{idDetails}', 'DetailsPlanController@destroy')->name('details.plan.destroy');
            Route::get('plans/{url}/details/{idDetails}', 'DetailsPlanController@show')->name('details.plan.show');
            Route::put('plans/{url}/details/{idDetails}', 'DetailsPlanController@update')->name('details.plan.update');
            Route::get('plans/{url}/details/{idDetails}/edit', 'DetailsPlanController@edit')->name('details.plan.edit');
            Route::post('plans/{url}/details', 'DetailsPlanController@store')->name('details.plan.store');
            Route::get('plans/{url}/details', 'DetailsPlanController@index')->name('details.plan.index');

            //Routes Plans
            Route::get('plans/create', 'PlanController@create')->name('plans.create');
            Route::put('plans/{url}', 'PlanController@update')->name('plans.update');
            Route::get('plans/{url}/edit', 'PlanController@edit')->name('plans.edit');
            Route::any('plans/search', 'PlanController@search')->name('plans.search');
            Route::delete('plans/{url}', 'PlanController@destroy')->name('plans.destroy');
            Route::get('plans/{url}', 'PlanController@show')->name('plans.show');
            Route::post('plans', 'PlanController@store')->name('plans.store');
            
            Route::get('plans', 'PlanController@index')->name('plans.index');

            //Home Dashboard
            Route::get('/', 'PlanController@index')->name('admin.index');
});





Route::get('/', function () {
    return view('welcome');
});
