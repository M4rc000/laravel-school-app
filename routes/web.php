<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GoogleController;

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
    return redirect('/admin');
});

Route::middleware(['guest'])->group(function (){
    Route::get('/auth', [AuthController::class, 'index'])->name('login');
    Route::get('/auth/register', [AuthController::class, 'register']);
    Route::get('/forgot-password', [AuthController::class, 'forgot_password']);
    Route::get('/verify-otp', [AuthController::class, 'verify_otp']);
    Route::post('/register', [AuthController::class, 'store']);
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::post('/check_email_forgot_password', [AuthController::class, 'check_email_forgot_password']);
    Route::post('/verification-sendOTP', [AuthController::class, 'verifysendOTP']);
    Route::post('/save-new-password', [AuthController::class, 'saveNewPassword']);
});

Route::middleware(['auth', 'verified'])->group(function (){
    Route::get('/admin', function(){
        return redirect('/admin/dashboard');
    });
    Route::get('/admin/dashboard', [HomeController::class, 'index']);
    Route::get('/admin/manage-user', [HomeController::class, 'manage_user']);
    Route::get('/admin/manage-menu', [HomeController::class, 'manage_menu']);
    Route::get('/admin/manage-submenu', [HomeController::class, 'manage_submenu']);
    Route::get('/auth/logout', [AuthController::class, 'logout']);
    
    Route::get('/user/profile', [HomeController::class, 'profile']);
    Route::get('/user/settings', [HomeController::class, 'settings']);

    // GET ALL SOURCES
    Route::get('/manage-menu/menus/all', [HomeController::class, 'menus_all']);
    Route::get('/manage-user/users/all', [HomeController::class, 'users_all']);
});


// GOOGLE AUTH
Route::controller(GoogleController::class)->group(function(){
    Route::get('auth/google', 'redirectToGoogle')->name('auth.google');
    Route::get('auth/google/callback', 'handleGoogleCallback');
});