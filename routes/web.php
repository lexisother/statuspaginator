<?php

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

Route::middleware('auth.basic')
    ->prefix('/admin')
    ->group(function () {
        Route::redirect('/', '/admin/dashboard');

        Route::get('/dashboard', 'AdminController@showDashboard');
    });
