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

        Route::post('/users/create', 'AdminController@createUser');
    });
