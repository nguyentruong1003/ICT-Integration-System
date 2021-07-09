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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home_users', function() {
    return view('home');
});

Route::get('/admin', function () {
    return view('admin/index');
})->middleware('checkadmin::class');

Route::get('/users_info', [App\Http\Controllers\Admin\AdminUsersController::class, 'index'])->middleware('checkadmin::class');

Route::get('/admin/users_create',  [App\Http\Controllers\Admin\AdminUsersController::class, 'create'])->middleware('checkadmin::class');

Route::get('/units_info', function () {
    return view('admin/units_info');
})->middleware('checkadmin::class');

