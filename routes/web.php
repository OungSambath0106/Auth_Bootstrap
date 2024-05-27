<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MenuTypeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SettingController;
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
    Route::post('users/update_ishidden', [UserController::class, 'updateIshidden'])->name('users.update_ishidden');
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

    // (Menu)
    Route::resource('menus', App\Http\Controllers\MenuController::class);
    Route::post('menus/update_ishidden', [MenuController::class, 'updateIshidden'])->name('menus.update_ishidden');
    Route::get('menus/{menuId}/delete', [App\Http\Controllers\MenuController::class, 'destroy']);
    Route::get('menus/create', [MenuController::class, 'create'])
        ->name('menus.create')
        ->middleware('can:create menu');

    // (MenuType)
    Route::resource('menutypes', App\Http\Controllers\MenuTypeController::class);
    Route::get('menutypes/{menutypeId}/delete', [App\Http\Controllers\MenuTypeController::class, 'destroy']);
    Route::get('menutypes/create', [MenuTypeController::class, 'create'])
        ->name('menutypes.create')
        ->middleware('can:create menutype');

    // (Customer)
    Route::resource('customers', App\Http\Controllers\CustomerController::class);
    Route::post('customers/update_ishidden', [CustomerController::class, 'updateIshidden'])->name('customers.update_ishidden');
    Route::get('customers/{customerId}/delete', [App\Http\Controllers\CustomerController::class, 'destroy']);
    Route::get('customers/create', [CustomerController::class, 'create'])
        ->name('customers.create')
        ->middleware('can:create customer');

    // (Home Page)
    Route::get('/home', function () {
        return view('layouts.master');
    });

    // (Dashboard Page)
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])
        ->name('dashboard')
        ->middleware('role:super-admin|developer|admin');

    // (Order Page)
    Route::resource('/order', OrderController::class);
    Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order');
    Route::get('/order/{order}/edit', [OrderController::class, 'edit'])->name('order.edit');
    Route::post('checkout', [OrderController::class, 'checkout'])->name('checkout');

    // (Sale Page)
    Route::resource('/invoice', InvoiceController::class);
    Route::get('invoices/{invoiceId}/delete', [App\Http\Controllers\InvoiceController::class, 'destroy']);

    // (Settings Page)
    Route::get('/settings', [SettingController::class, 'index'])
        ->name('settings.index')
        ->middleware('role:super-admin|developer|admin');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
});
