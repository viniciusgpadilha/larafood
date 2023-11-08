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

use App\Models\Client;

Route::get('teste', function() {
    $client = Client::first();

    $token = $client->createToken('token-teste');

    dd($token->plainTextToken);
});

Route::prefix('admin')
        ->namespace('Admin')
        ->middleware('auth')
        ->group(function () {
            //Routes Tables
            //Routes Roles x Users
            Route::get('users/{id}/role/{idRole}/detach', 'ACL\RoleUserController@detachRoleUser')->name('users.role.detach');
            Route::post('users/{id}/roles', 'ACL\RoleUserController@attachRolesUser')->name('users.roles.attach');
            Route::any('users/{id}/roles/create', 'ACL\RoleUserController@rolesAvailable')->name('users.roles.available');
            Route::get('users/{id}/roles', 'ACL\RoleUserController@roles')->name('users.roles');
            Route::get('roles/{id}/users', 'ACL\RoleUserController@users')->name('roles.users');

            //Routes Permissions x Roles
            Route::get('roles/{id}/permission/{idPermission}/detach', 'ACL\PermissionRoleController@detachPermissionsRole')->name('roles.permissions.detach');
            Route::post('roles/{id}/permissions', 'ACL\PermissionRoleController@attachPermissionsRole')->name('roles.permissions.attach');
            Route::any('roles/{id}/permissions/create', 'ACL\PermissionRoleController@permissionsAvailable')->name('roles.permissions.available');
            Route::get('roles/{id}/permissions', 'ACL\PermissionRoleController@permissions')->name('roles.permissions');
            Route::get('permissions/{id}/role', 'ACL\PermissionRoleController@roles')->name('permissions.roles');

            //Routes Roles
            Route::any('roles/search', 'ACL\RoleController@search')->name('roles.search');
            Route::resource('roles', 'ACL\RoleController');

            Route::get('tables/qrcode/{identify}', 'TableController@qrcode')->name('tables.qrcode');
            Route::any('tables/search', 'TableController@search')->name('tables.search');
            Route::resource('tables', 'TableController');

            //Product x Category
            Route::get('products/{id}/category/{idCategory}/detach', 'CategoryProductController@detachCategoryProduct')->name('products.category.detach');
            Route::post('products/{id}/categories', 'CategoryProductController@attachCategoriesProduct')->name('products.categories.attach');
            Route::any('products/{id}/categories/create', 'CategoryProductController@categoriesAvailable')->name('products.categories.available');
            Route::get('products/{id}/categories', 'CategoryProductController@categories')->name('products.categories');
            Route::get('categories/{id}/products', 'CategoryProductController@products')->name('categories.products');

            //Routes Products
            Route::any('products/search', 'ProductController@search')->name('products.search');
            Route::resource('products', 'ProductController');

            //Routes Categories
            Route::any('categories/search', 'CategoryController@search')->name('categories.search');
            Route::resource('categories', 'CategoryController');

            //Routes Users
            Route::any('users/search', 'UserController@search')->name('users.search');
            Route::resource('users', 'UserController');

            //Routes Plans x Profiles
            Route::get('plans/{id}/profile/{idProfile}/detach', 'ACL\PlanProfileController@detachPlansProfile')->name('plans.profiles.detach');
            Route::post('plans/{id}/profiles', 'ACL\PlanProfileController@attachPlansProfile')->name('plans.profiles.attach');
            Route::any('plans/{id}/profiles/create', 'ACL\PlanProfileController@profilesAvailable')->name('plans.profiles.available');
            Route::get('plans/{id}/profiles', 'ACL\PlanProfileController@profiles')->name('plans.profiles');
            Route::get('profiles/{id}/profile', 'ACL\PlanProfileController@plans')->name('profiles.plans');

            //Routes Permissions x Profiles
            Route::get('profiles/{id}/permission/{idPermission}/detach', 'ACL\PermissionProfileController@detachPermissionsProfile')->name('profiles.permissions.detach');
            Route::post('profiles/{id}/permissions', 'ACL\PermissionProfileController@attachPermissionsProfile')->name('profiles.permissions.attach');
            Route::any('profiles/{id}/permissions/create', 'ACL\PermissionProfileController@permissionsAvailable')->name('profiles.permissions.available');
            Route::get('profiles/{id}/permissions', 'ACL\PermissionProfileController@permissions')->name('profiles.permissions');
            Route::get('permissions/{id}/profile', 'ACL\PermissionProfileController@profiles')->name('permissions.profiles');

            //Routes Permissions
            Route::any('permissions/search', 'ACL\PermissionController@search')->name('permissions.search');
            Route::resource('permissions', 'ACL\PermissionController');

            //Routes Profiles
            Route::any('profiles/search', 'ACL\ProfileController@search')->name('profiles.search');
            Route::resource('profiles', 'ACL\ProfileController');

            /**
             * Routes Tenants
             */
            Route::any('tenants/search', 'TenantController@search')->name('tenants.search');
            Route::resource('tenants', 'TenantController');

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
            Route::get('/', 'DashboardController@home')->name('admin.home');
});

Route::get('/plan/{url}', 'Site\SiteController@plan')->name('plan.subscription');
Route::get('/', 'Site\SiteController@index')->name('site.home');


Auth::routes();


// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');
