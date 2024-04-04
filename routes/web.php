<?php

use App\Http\Controllers\FrontPageController;
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

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('front_home');
Route::get('/home', [FrontPageController::class,'index'])->name('front_home');
Route::get('/about', [FrontPageController::class,'about'])->name('front_about');
Route::get('/service', [FrontPageController::class,'service'])->name('front_service');
Route::get('/menu', [FrontPageController::class,'menu'])->name('front_menu');
Route::get('/reservation', [FrontPageController::class,'reservation'])->name('front_reservation');
Route::get('/testimonial', [FrontPageController::class,'testimonial'])->name('front_testimonial');
Route::get('/contact', [FrontPageController::class,'contact'])->name('front_contact');


