<?php

use App\Http\Middleware\EnsureAdmin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', 'DashboardController@index');
Route::get('/sites/{id}', 'DashboardController@showSite');
Route::get('/sites/{id}/plugins', 'DashboardController@showPlugins');

Route::middleware(['auth.basic', EnsureAdmin::class])
    ->prefix('/admin')
    ->group(function () {
        Route::redirect('/', '/admin/users');

        Route::get('/users', 'AdminController@showUsers')->name('admin.users');
        Route::get('/users/{id}', 'AdminController@showUser')->name('admin.users');
        Route::get('/roles', 'AdminController@showRoles')->name('admin.roles');

        Route::get('/sites', 'AdminController@showSites')->name('admin.sites');
        Route::get('/sites/create', 'SiteController@showCreate')->name('admin.sites');

        Route::post('/users/create', 'UserController@create');
        Route::patch('/users/edit/{id}', 'UserController@edit');
        Route::post('/users/delete/{id}', 'UserController@delete');

        Route::post('/roles/create', 'RoleController@create');
        Route::post('/roles/edit', 'RoleController@edit');
        Route::post('/roles/delete', 'RoleController@delete');

        Route::post('/sites/create', 'SiteController@create');
    });
