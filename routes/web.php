<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes();
Route::get('/', function () {
    return view('auth.login');
});
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::get('/lang/{lang}','App\Http\Controllers\LangController@changeLang')->name('lang');
    Route::group([
        'prefix' => 'config',
    ], function () {
        Route::get('/master', 'App\Http\Controllers\Admin\Config\MasterController@index')->name('admin.config.master.index');
    });

    Route::group([
        'prefix' => 'system',
    ], function () {
        Route::get('/user', 'App\Http\Controllers\Admin\System\UserController@index')->name('admin.system.user.index');
        Route::get('/audit', 'App\Http\Controllers\Admin\System\AuditController@index')->name('admin.system.audit.index');
        Route::group([
            'prefix' => 'role',
        ], function () {
            Route::get('/', 'App\Http\Controllers\Admin\System\RoleController@index')->name('admin.system.role.index');
            Route::get('/create', 'App\Http\Controllers\Admin\System\RoleController@create')->name('admin.system.role.create');
            Route::post('/store', 'App\Http\Controllers\Admin\System\RoleController@store')->name('admin.system.role.store');
            Route::get('/edit/{id}', 'App\Http\Controllers\Admin\System\RoleController@edit')->name('admin.system.role.edit');
            Route::post('update/{id}', 'App\Http\Controllers\Admin\System\RoleController@update')->name('admin.system.role.update');
        });
    });

    Route::group([
        'prefix' => 'employee',
    ], function () {
        Route::get('/', 'App\Http\Controllers\Admin\EmployeeController@index')->name('admin.employee.index');
        Route::get('/create', 'App\Http\Controllers\Admin\EmployeeController@create')->name('admin.employee.create');
        Route::post('/store', 'App\Http\Controllers\Admin\EmployeeController@store')->name('admin.employee.store');
        Route::get('edit/{id}', 'App\Http\Controllers\Admin\EmployeeController@edit')->name('admin.employee.edit');
        Route::post('update/{id}', 'App\Http\Controllers\Admin\EmployeeController@update')->name('admin.employee.update');
        Route::get('/show/{id}', 'App\Http\Controllers\Admin\EmployeeController@show')->name('admin.employee.show');
    });

    Route::group([
        'prefix' => 'department',
    ], function () {
        Route::get('/', 'App\Http\Controllers\Admin\DepartmentController@index')->name('admin.department.index');
    });
});