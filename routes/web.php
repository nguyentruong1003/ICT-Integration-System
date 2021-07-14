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

// Route::get('/home_users', function() {
//     return view('home');
// });

// Route::get('/admin', function () {
//     return view('admin/index');
// })->middleware('checkadmin::class');

// Route::get('/users_info', [App\Http\Controllers\Admin\AdminUsersController::class, 'index'])->middleware('checkadmin::class');

// Route::get('/admin/users_create',  [App\Http\Controllers\Admin\AdminUsersController::class, 'create'])->middleware('checkadmin::class');

// Route::get('/units_info', function () {
//     return view('admin/units_info');
// })->middleware('checkadmin::class');


Route::get('/', [App\Http\Controllers\LandingController::class, 'index']);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['web','auth']);
Route::get('/admin-panel', [App\Http\Controllers\AdminController::class, 'index'])->middleware(['web','auth']);

Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->middleware(['web','auth']);
Route::get('/users-create', [App\Http\Controllers\UsersController::class, 'create'])->middleware(['web','auth']);
Route::post('/users-store', [App\Http\Controllers\UsersController::class, 'store'])->middleware(['web','auth']);

Route::get('/users-update-{id}', [App\Http\Controllers\UsersController::class, 'edit'])->middleware(['web','auth']);
Route::get('/users-{id}', [App\Http\Controllers\UsersController::class, 'show'])->middleware(['web','auth']);
Route::put('/users-{id}', [App\Http\Controllers\UsersController::class, 'update'])->middleware(['web','auth']);
Route::delete('/users-{id}', [App\Http\Controllers\UsersController::class, 'destroy'])->middleware(['web','auth']);

Route::get('/units', [App\Http\Controllers\UnitsController::class, 'index'])->middleware(['web','auth']);
Route::get('/units-create', [App\Http\Controllers\UnitsController::class, 'create'])->middleware(['web','auth']);
Route::post('/units-store', [App\Http\Controllers\UnitsController::class, 'store'])->middleware(['web','auth']);

Route::get('/units-update-{id}', [App\Http\Controllers\UnitsController::class, 'edit'])->middleware(['web','auth']);
Route::get('/units-{id}', [App\Http\Controllers\UnitsController::class, 'show'])->middleware(['web','auth']);
Route::put('/units-{id}', [App\Http\Controllers\UnitsController::class, 'update'])->middleware(['web','auth']);
Route::delete('/units-{id}', [App\Http\Controllers\UnitsController::class, 'destroy'])->middleware(['web','auth']);

// Route::get('/units', [App\Http\Controllers\UnitsController::class, 'index'])->middleware(['web','auth']);
// Route::get('/units-{id}', [App\Http\Controllers\UnitsController::class, 'show'])->middleware(['web','auth']);
// Route::put('/units-{id}', [App\Http\Controllers\UnitsController::class, 'update'])->middleware(['web','auth']);
// Route::get('/units-create', [App\Http\Controllers\UnitsController::class, 'create'])->middleware(['web','auth']);
// Route::post('/units-store', [App\Http\Controllers\UnitsController::class, 'store'])->middleware(['web','auth']);
// Route::get('/units-update-{id}', [App\Http\Controllers\UnitsController::class, 'edit'])->middleware(['web','auth']);

Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'show'])->middleware(['web','auth']);
Route::get('/profile-edit', [App\Http\Controllers\ProfileController::class, 'edit'])->middleware(['web','auth']);
Route::put('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->middleware(['web','auth']);

Route::get('/search', [App\Http\Controllers\UsersController::class, 'search'])->name('search');
// Route::get('/search', [App\Http\Controllers\UsersController::class, 'search']);