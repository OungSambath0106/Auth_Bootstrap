<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();


// Route::group(['middleware' => ['role:super-admin|admin']], function () {
Route::group(['middleware' => ['isAdmin']], function () {
    // For Spatie Permission 
    // (Permission)
    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    // (Role)
    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    // (User)
    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

    // (Menu)
    Route::resource('menus', App\Http\Controllers\MenuController::class);
    Route::get('menus/{menuId}/delete', [App\Http\Controllers\MenuController::class, 'destroy']);

    // (Customer)
    Route::resource('customers', App\Http\Controllers\CustomerController::class);
    Route::get('customers/{customerId}/delete', [App\Http\Controllers\CustomerController::class, 'destroy']);

    // (Home Page)
    Route::get('/home', function () {
        return view('layouts.master');
    });

    // (Dashboard Page)
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('dashboard');
});


Route::get('hidding_user', [UserController::class, 'hidding_user'])->name('hidding_user');
