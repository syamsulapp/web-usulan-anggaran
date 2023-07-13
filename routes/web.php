<?php

use App\Http\Controllers\SuperadminController;
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
    return redirect()->route('login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('/profile/submit', [App\Http\Controllers\HomeController::class, 'profileSubmit'])->name('profile.submit');
Route::get('/superadmin', [SuperadminController::class, 'index'])->name('index');
Route::get('/admin', [SuperadminController::class, 'index'])->name('index');
Auth::routes();

// Rute untuk superadmin
Route::middleware('superadmin')->group(function () {
    Route::prefix('guest')->group(function () {
        Route::get('dashboard', function () {
            return redirect()->route('home');
        });
    });
});

// Rute untuk admin
Route::middleware('admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', function () {
            return redirect()->route('home');
        });
    });
});

// Rute untuk pengguna
Route::middleware('user')->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('dashboard', function () {
            return redirect()->route('home');
        });
    });
});
